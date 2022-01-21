<?php

class User{

    public function get_data($id){//retrieves user data using the $id

    $query = "select * from users where user_id = $id limit 1"; //no need for '' because it's numerical

        $DB = new Database();
        $result = $DB->read($query); //read from db


        if($result){//if there's a result
            $row = $result[0]; //result returns an array of rows by default so [0] means only one record
            return $row;


        }else{
            return false; // if there's no obtained result
        }
    }

    
    public function get_user($id){ //for getting an array of row (1)

        $query= "select posts.*,users.l_name as last_name , users.f_name as first_name, users.profile_image, users.cover_image, users.gender
        from posts
        LEFT JOIN users ON posts.user_id = users.user_id
          where posts.user_id = '$id' limit 1"; 
        $DB = new Database(); //instantiate db class
        $result = $DB->read($query);
       
        if($result){
            return $result[0]; //only on array of row
        }else{
            return false;
        }

    }

    public function get_friends($id){ //for friends //I added  the profile_image and user_id
      $query= "select users.l_name as last_name , users.f_name as first_name  , users.profile_image, users.cover_image, users.user_id, users.profile_image, users.gender
        from users
       
          where users.user_id != '$id' "; //get all 

       // $query = "select * from posts where user_id != '$id'";

        $DB = new Database(); //instantiate db class
        $result = $DB->read($query);
       
        if($result){
            return $result; //get all
        }else{
            return false;
        }

    }
    

    //for followers 
    
    public function get_following($id,$type){

        $DB= new Database;
        $type = addslashes($type);

        if(is_numeric($id)){ //check if it's numeric for security purposes
           
            //get following details
            $sql = "select following from likes where type='$type' && content_id = '$id' limit 1"; // increment likes column by one
            $result = $DB->read($sql); //read data
         
            if(is_array($result)){//if result is array then table already exists
               
                $following = json_decode($result[0]['following'],true); //putting true - turns into an array not an object
                return $following;
            }
        }
      
      //  print_r($sql);die;
      return false;
    }

    public function follow_user($id,$type,$heypal_userid){

       // if($type == "post"){
            $DB= new Database;
            
            $sql = "select following from likes where type='$type' && content_id = '$heypal_userid' limit 1"; // increment likes column by one
            $result = $DB->read($sql); //read data
          
            if(is_array($result)){//if result is array then table already exists

                //first array and find likes
                $likes = json_decode($result[0]['following'],true); //putting true - turns into an array not an object
                if(is_null($likes)){
                    $user_ids = array_column([], "user_id");  //array column function - create new array from existing array

                }else{
                    $user_ids = array_column($likes, "user_id");  //array column function - create new array from existing array

                }
               
                if(!in_array($id, $user_ids)){ //if user id is not inside

                    $arr["user_id"] = $id; //create an array
                    $arr["date"] = date("Y-m-d H:i:s"); //Time and day the post was liked
    
                    $likes[] = $arr;

                    //convert it into a string because we can't save an array into the db only the string
                    $likes_string = json_encode($likes); //json - favascript object notation - a way of converting an array into a string
                    
                    //insert like
                    $sql = "update likes set following = '$likes_string' where type='$type' && content_id = '$heypal_userid' limit 1";
                    $DB->save($sql); //save data
                   

                }else{//if user already like, then she can unlike
                    
                    $key = array_search($id,$user_ids);
                    unset($likes[$key]); //unset like
                    
                     $likes_string = json_encode($likes);
                     $sql = "update likes set following = '$likes_string' where type='$type' && content_id = '$heypal_userid' limit 1";
                     $DB->save($sql); //save data
 
                }

                
            }else{//if not then create table from scratch
                $arr["user_id"] = $id; //create an array
                $arr["date"] = date("Y-m-d H:i:s"); //Time and day the post was liked

                $arr2[] = $arr;
                //convert it into a string because we can't save an array into the db only the string
                //an array inside an array
                $following = json_encode($arr2); //json - favascript object notation - a way of converting an array into a string
                
                //iinsert like
                $sql = "insert into likes (type,content_id,following) values ('$type','$heypal_userid','$following')"; 
                $DB->save($sql); //save data
                
                 
            }
            
        //}
       
    }
}
?>
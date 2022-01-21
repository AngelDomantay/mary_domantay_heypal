<?php

class Post{
    private $error = "";

    public function create_post($user_id, $data, $files){ //pass data and user_id from user 
        
        //verify the data
        if(!empty($data['post']) || !empty($files['file']['name']) || isset($data['is_profile_image']) || isset($data['is_cover_image'])){ //if it's not empty
           
            $myimage = "";
            $has_image = 0;
            $is_cover_image = 0; 
            $is_profile_image = 0; 

            if(isset($data['is_profile_image']) || isset($data['is_cover_image'])){ //from db > post table
             
                //for posting 
                $myimage = $files;
                $has_image = 1; 

                if(isset($data['is_cover_image'])){

                    $is_cover_image = 1; //update value to 1 if cover image exists
                }
               
                if(isset($data['is_profile_image'])){

                    $is_profile_image = 1; //update value to 1 if profile image exists
                }

            }else{
          
                if(!empty($files['file']['name'])){
                 
                    $folder = "uploads/" . $user_id . "/" ; //becomes a folder

                    if(!file_exists($folder)){ //if folder does not exist
                        mkdir($folder,0777,true); //create a folder with file permissons
                        file_put_contents($folder . "index.php", ""); //automatically creates a new file naming index.php fpr security reasons
                    }

                    //if successful
                    $image_class= new Image();
                    $myimage = $folder . $image_class->generate_filename(15) . ".jpg"; //image class > generate filename function > length is 15
                    move_uploaded_file($_FILES['file']['tmp_name'], $myimage); //source and destination
                    
                    $image_class->resize_image($myimage,$myimage,1500,1500); //call crop_image function

                    $has_image = 1;
                }
            }

            $post = "";
            if(isset($data['post'])){
            
                $post = addslashes($data['post']);
              
            }
           
            $post_id= $this->create_post_id();
           
            //additional for comment
            $parent = 0;
            $DB = new Database();

            if(isset($data['parent']) && is_numeric($data['parent'])){ //check if it's numeric for security

                $parent = $data['parent'];

                //increment number of comments 
                $sql = "update posts set comments = comments + 1 where post_id = '$parent' limit 1 ";
                $DB->save($sql); 
            }

            $query = "insert into posts (user_id,post_id,post,image,has_image,is_profile_image,is_cover_image,parent) 
            values ('$user_id','$post_id','$post','$myimage',$has_image,$is_profile_image,$is_cover_image,$parent)";
            
            $DB->save($query);  


        }else{
           //print_r($data);
            return $this->error .= "Please type something to post! <br>";
        }

        return $this->error;
    }

    //for editing post
    public function edit_post($data, $files){ //pass data and user_id from user 
        
      print_r($data);

        //verify the data
        if(!empty($data['post']) || !empty($files['file']['name'])){ //if it's post or file name is not empty
            $myimage = "";
            $has_image = 0;

                if(!empty($files['file']['name'])){

                    $folder = "uploads/" . $data['user_id'] . "/" ; //becomes a folder //originally userid

                    if(!file_exists($folder)){ //if folder does not exits
                        mkdir($folder,0777,true); //create a folder with file permissons

                        //automatically creates a new file naming index.php fpr security reasons
                        file_put_contents($folder . "index.php", ""); 
                    }


                    //if successful
                    $image_class= new Image();
                    $myimage = $folder . $image_class->generate_filename(15) . ".jpg"; //image class > generate filename function > length is 15
                    move_uploaded_file($_FILES['file']['tmp_name'], $myimage); //source and destination
                    
                    $image_class->resize_image($myimage,$myimage,1500,1500); //call crop_image function

                    $has_image = 1;
                }
            

            $post = "";
            if(isset($data['post'])){

                $post = addslashes($data['post']); //addslashes for security
            }
           
            $post_id= addslashes($data['post_id']); //add slashes for security

            if($has_image){
                $query = "update posts set post = '$post', image = '$myimage' where post_id = '$post_id' limit 1"; //update current post with image
            }else{ 
                $query = "update posts set post = '$post' where post_id = '$post_id' limit 1"; //update current post with text only  
            }
            $DB = new Database(); //instantitate DB class
            $DB->save($query);  //Save to db

        }else{
            return $this->error .= "Please type something to post! <br>";
        }

        return $this->error;
    }



    public function get_posts($id){ //for retreiving posts

        //post will be displayed the latest
        $query = "select posts.*,users.gender,users.l_name as last_name , users.f_name as first_name 
        from posts
        LEFT JOIN users ON posts.user_id = users.user_id where parent = 0 and posts.user_id = '$id' 
        order by id desc limit 50";

        $DB = new Database();
        $result = $DB->read($query);

        if($result){
            return $result; //return the result
        }else{

            return false;
        }
    }

    public function get_comments($id){ //for comments

        //no limit one because we want to retrieve as many as possible
        //post will be displayed the latest
        /*$query = "select posts.*,users.gender,users.l_name as last_name , users.f_name as first_name 
        from posts
        LEFT JOIN users ON posts.user_id = users.user_id where posts.user_id = '$id' 
        order by id desc ";*/

        $query = "select posts.*,users.gender,users.l_name as last_name , users.f_name as first_name,
        users.profile_image 
        from posts
        LEFT JOIN users ON posts.user_id = users.user_id where posts.parent = '$id'
        order by id desc limit 50";
        $DB = new Database();
        $result = $DB->read($query);

        if($result){
            return $result; //return the result
        }else{

            return false;
        }
    }

    public function get_one_post($post_id){ //for retreiving posts

        //for security purposes
        if(!is_numeric($post_id)){ //if post_id is not numeric
            return false; //exit function
        }

       $query = "select posts.*,users.gender,users.l_name as last_name , users.f_name as first_name 
        from posts
        LEFT JOIN users ON posts.user_id = users.user_id where posts.post_id = '$post_id' 
        limit 1 ";

        $DB = new Database();
        $result = $DB->read($query);

        if($result){
           
            return $result[0]; //return one result
        }else{

            return false;
        }
    }

    private function create_post_id() {
        //generate number userid = max of 19 numbers
        $length = rand(4,19); //create a var, using the rand function - generates number between 4-19 digits in length
        $number = ""; //will be the user id

        for($i=0; $i < $length; $i++ ){ //as long as the condition is true, add another one to i
            $new_rand = rand(0,9); //create a new number
            $number = $number . $new_rand;
        }
        return $number;
    }

    public function delete_post($post_id){ //for deleting a post, 

        //for security purposes
       if(!is_numeric($post_id)){ //if post_id is not numeric
            return false; //exit function
        }

        $DB = new Database();
        $sql = "select parent from posts where post_id = '$post_id' limit 1";
        $result = $DB->read($sql);

        if(is_array($result)){//if result is an array

            //subtract comment
            if($result[0]['parent'] > 0){ //if it's greater than zero; put zero beside result because it returns an array

                $parent = $result[0]['parent'];

                //increase number of comments 
                $sql = "update posts set comments = comments - 1 where post_id = '$parent' limit 1 ";
                $DB->save($sql); 
                }
        }
        $query = "delete from posts where post_id = '$post_id' limit 1"; //detele post if post_id is equals to the db

        $DB->save($query); //save changes

    }

    
    public function i_own_post($post_id, $heypal_userid){ //if you own the pos; add session as parameter

        //for security purposes
       if(!is_numeric($post_id)){ //if post_id is not numeric
            return false; //exit function
        }

     /*  $query = "delete posts.*,users.gender, users.l_name as last_name , users.f_name as first_name 
        from posts
        LEFT JOIN users ON posts.user_id = users.user_id where posts.user_id = '$post_id' 
        limit 1 ";*/

        $query = "select * from posts where post_id = '$post_id' limit 1"; 

        $DB = new Database();
        $result = $DB->read($query); //return result 

        if(is_array($result)){ //if result is array
            if($result[0]['user_id'] == $heypal_userid){ //if two compared values are the same
                return true; //means you own the post
            }
        }

        return false;
    }

    public function get_likes($id,$type){

        $DB= new Database;
        $type = addslashes($type);

        if(is_numeric($id)){ //check if it's numeric for security purposes
           
            //get like details
            $sql = "select likes from likes where type='$type' && content_id = '$id' limit 1"; // increment likes column by one
            $result = $DB->read($sql); //read data
         
            if(is_array($result)){//if result is array then table already exists
               
                $likes = json_decode($result[0]['likes'],true); //putting true - turns into an array not an object
                return $likes;
            }
        }
      
      //  print_r($sql);die;
      return false;
    }

    public function like_post($id,$type,$heypal_userid){

            $DB= new Database;
            
            $sql = "select likes from likes where type='$type' && content_id = '$id' limit 1"; // increment likes column by one
            $result = $DB->read($sql); //read data
          
            if(is_array($result)){//if result is array then table already exists

                //first array and find likes
                $likes = json_decode($result[0]['likes'],true); //putting true - turns into an array not an object

                $user_ids = array_column($likes, "user_id");  //array column function - create new array from existing array
                
                
                if(!in_array($heypal_userid, $user_ids)){ //if user id is not inside

                    $arr["user_id"] = $heypal_userid; //create an array
                    $arr["date"] = date("Y-m-d H:i:s"); //Time and day the post was liked
    
                    $likes[] = $arr;

                    //convert it into a string because we can't save an array into the db only the string
                    $likes_string = json_encode($likes); //json - favascript object notation - a way of converting an array into a string
                    
                    //insert like
                    $sql = "update likes set likes = '$likes_string' where type='$type' && content_id = '$id' limit 1";
                    $DB->save($sql); //save data
                   
                    
                    //increment the right table - likes column
                     $sql = "update {$type}S set likes = likes + 1  where {$type}_id = '$id' limit 1"; // increment likes column by one
                     $DB->save($sql); //save data

                }else{//if user already like, then she can unlike
                    
                    $key = array_search($heypal_userid,$user_ids);
                    unset($likes[$key]); //unset like
                    
                     $likes_string = json_encode($likes);
                     $sql = "update likes set likes = '$likes_string' where type='$type' && content_id = '$id' limit 1";
                     $DB->save($sql); //save data

                      //decrease likes column in right table
                      $sql = "update {$type}s set likes = likes - 1  where {$type}_id = '$id' limit 1"; // increment likes column by one
                      $DB->save($sql); //save data
                }

                
            }else{//if not then create table from scratch
                $arr["user_id"] = $heypal_userid; //create an array
                $arr["date"] = date("Y-m-d H:i:s"); //Time and day the post was liked

                $arr2[] = $arr;
                //convert it into a string because we can't save an array into the db only the string
                //an array inside an array
                $likes = json_encode($arr2); //json - favascript object notation - a way of converting an array into a string
                
                //iinsert like
                $sql = "insert into likes (type,content_id,likes) values ('$type','$id','$likes')"; 
                $DB->save($sql); //save data
                
                 //increment the right table - likes column
                 $sql = "update {$type}s set likes = likes + 1  where {$type}_id = '$id' limit 1"; // increment likes column by one
                 $DB->save($sql); //save data
               
                 
            }
            
       
    }

}

?>
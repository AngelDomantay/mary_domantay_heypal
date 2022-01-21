<?php //no need to close since there's no html

Class Settings {

    public function get_settings($id){ //pass id

        $DB = new Database();
        $sql = "select * from users where user_id = '$id' limit 1"; 
       // print_r($sql);
        $row= $DB->read($sql); //store result in row variable

        if(is_array($row)){ //if arrays

            return $row[0]; //return one array
        }
    }

    public function save_settings($data,$id){

        $DB = new Database();
         
        $password = $data['password'];

        if(strlen($password) < 30){ //if length of pass is less than 30

            if($data['password']==$data['password2']){ //if pass 1 = pass 2
                $data['password'] = hash("sha1", $password); //encrypt new pass

            }else{ //remove pass if pass 1 and 2 is not equal

                unset($data['password']);
            }
           
        }
        unset($data['password2']);

        $sql = "update users set ";
        foreach($data as $key => $value){

            $sql .= $key . "='" . $value. "',";
        }
        
        $sql = trim($sql,","); //trim commas
        
        $sql .= " where user_id = '$id' limit 1";
        $DB->save($sql);
    }
    
}



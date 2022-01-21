<?php

class Signup{

   
    private $error = ""; //for error

    public function evaluate($data){ //evaluates $data that is an array; info comes from $_POST

        //runs through each item one at a time, shows its key and value
        //EX: gender = key, male = value
        //var_dump($data);
       
        foreach($data as $key => $value){ //checking array

            if(empty($value)){ //if value is empty...
                $this->error = $this->error . $key . " is empty! <br>" ; //prints error
            }

            //user data validation
            if($key == "email"){ //if key is equal to email...
               //regular expressions for email
               if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $value)){ //checks to see if value does not match in ""
                    $this->error = $this->error . "Invalid email adress. Please use a real email address." ; //prints error
               }

            }

            if($key == "password" ){
                if ($data['password2']!= $value) { //if value is numeric
                    $this->error = $this->error . " The password does not match <br>" ; //prints error
               }
            }
        
            if($key == "f_name"){ //if key is equal to f_name...

                if (is_numeric($value)) { //if value is numeric
                     $this->error = $this->error . " The first name can't be a number <br>" ; //prints error
                }

                if   (strstr($value, " ")) { //if value has and empty space
                     $this->error = $this->error . " The first name can't have spaces <br>" ; //prints error
                }

              
             }
            if($key == "l_name"){ //if key is equal to l_name...
              
               if (is_numeric($value)){ //if value is numeric
                    $this->error = $this->error . " The last name can't be a number <br>" ; //prints error
               }

               if   (strstr($value, " ")) { //if value has and empty space
                $this->error = $this->error . " The last name can't have spaces <br>" ; //prints error
           }
            }

        }

        
        if($this->error == ""){//if error is empty, then...

            $this->create_user($data);//call user function
        }else{
            return $this->error;
        }
    }

    public function checkUrl($url){

    }
    public function create_user($data){//saves data

        $f_name = addslashes(ucfirst($data['f_name']));
        $l_name = addslashes(ucfirst($data['l_name']));
        $gender = $data['gender'];
        $email = addslashes($data['email']);
        $password = $data['password'];

        $password = hash("sha1", $password);
        //create
        //url address should be in small letter= combines first & last name of user
        $url_address = strtolower($f_name) . "." . strtolower($l_name); 
        $user_id = $this->create_user_id(); //calls the private function responsible for generating user id

        $query = "insert into users (user_id, f_name, l_name, gender, email, password, url_address) 
        values ('$user_id', '$f_name', '$l_name', '$gender', '$email', '$password', '$url_address')";

        $DB = new Database(); //calling the db class
       $datass=  $DB->save($query); //saves data

        //limit email to one usage only
        $query = "select * from users where $_POST[email] = :email limit 1)";
        $arr = array();
        $arr['email'] = $data['email'];
        $check = $DB->read($query,$arr);

        if(is_array($check)){
            $this->error .= "That email is alreay in use. <br>";}
    }

    private function create_user_id() {
        //generate number userid = max of 19 numbers
        $length = rand(4,19); //create a var, using the rand function - generates number between 4-19 digits in length
        $number = ""; //will be the user id

        for($i=0; $i < $length; $i++ ){ //as long as the condition is true, add another one to i
            $new_rand = rand(0,9); //create a new number
            $number = $number . $new_rand;
        }
        return $number;
    }

}
?>
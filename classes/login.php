<?php

class Login
{
    private $error = "";

    public function evaluate($data)
    { //saves data

        //escaping string
        //add slash before the single quotation mark or any special character
        //improves security
        $email = addslashes($data['email']); //to protect from an attack - addslashes() function
        $password = addslashes($data['password']); //to protect from an attack - addslashes() function
        
        $query = "select * from users where email = '$email' limit 1"; //return one row; 
        //echo $query;die; //to check error temporarily
        /*echo '<pre>';
        echo $query;  //print query temporarily
        echo '</pre>';*/

       // $password = hash('sha1',$password);
        $DB = new Database(); //calling the db class
        $result = $DB->read($query); //reads data
       
        if ($result) {

            //checks one by one to mitigate risk of sql attack
            $row = $result[0];
            
            //hash the entered password, and see if it matches the hashed password in the database
            if ($this->hash_text($password)==$row['password']) { 

                //create session 
                //global variable is available in whatever page the user is 
                $_SESSION['heypal_userid'] = $row['user_id']; //creates memory location named userid (can also be a number)

            } else {
                $this->error .= "Wrong email or password. <br>";
            }
        } else {
            $this->error .= "Wrong email or password. <br>";
        }
        return $this->error;
    }

    //for hashing password
    private function hash_text($text){
        $text = hash("sha1", $text); //hash version of same text
        return $text;
    }

    public function check_login($id)
    { //check if user is logged in

        if ( is_numeric($id)) { //if id is numeric
            //read from DB
            $query = "select * from users where user_id = '$id' limit 1"; //return one row;
            $DB = new Database(); //calling the db class
            $result = $DB->read($query); //reads data

            if ($result) { //if user is found

                $user_data = $result[0]; //result is an array of row, so select only one 
                return $user_data;
            }else {
                header("Location: login_page.php"); //redirect page
                die;
            }

            //if id is set, and it is numeric (to avoid malicious software
             
            } else { //if id is not numeric, redirect user to login page
                header("Location: login_page.php"); //redirect page
                die;
            }
    }
}

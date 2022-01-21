<?php

//profile.php originally 
Class Profile { //include in autoload.php

    function get_profile($id){


        $id = addslashes($id); //addslashes - look for special characters and escape all those
        //escaping - tells special char as part of a string  therefore any sql injection will return as false
        $DB = new Database();
        $query = "select * from users where user_id = '$id' limit 1"; //match value of user_id to $id
        return $DB->read($query);
       
       
    }
}
<?php
include("classes/autoload.php");

   /* $login = new Login(); //added this one
    $user_data = $login->check_login($SESSION['heypal_userid']); //ADDED THIS ONE*/

if(isset($_SERVER['HTTP_REFER'])){
    $return_to = $_SERVER['HTTP_REFERER'];
  
}else{
    $return_to = "index.php";
}
$return_to = $_SERVER['HTTP_REFERER'];

    if(isset($_GET['type']) && isset($_GET['id'])){ //if both exist

        if(is_numeric($_GET['id'])){


            $allowed[] = 'post'; //white listing = selecting what is allowed and not banning things
            $allowed[] = 'user'; 
            $allowed[] = 'comment'; 

            if(in_array($_GET['type'], $allowed)){ //needle= whatever type, haystack = what is allowed

                $post = new Post(); //instantiate the post class
                $user_class = new User(); //instantiate the post class

                $post->like_post($_GET['id'],$_GET['type'],$_SESSION['heypal_userid']); //create a method

                if($_GET['type'] == "user"){

                    $user_class->follow_user($_GET['id'],$_GET['type'],$_SESSION['heypal_userid']); //create a method

                }
            }
        }
  
    }

header("Location: " . $return_to);
die;
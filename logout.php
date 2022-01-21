<?php
session_start();

if(isset($_SESSION['heypal_userid'])){ 

    $_SESSION['heypal_userid'] = NULL; //empty /remove value
    unset($_SESSION['heypal_userid']);//logout
}

header("Location: login_page.php"); //redirect to login page
die;
?>
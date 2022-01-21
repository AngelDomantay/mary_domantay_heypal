<?php

session_start(); //Added***

include_once 'classes/db2.php';
if (isset($_POST['save'])) 
{
  $email = $_POST['email'];
  $pas= $_POST['password'];
  $pass = md5($pas);
  //$sql = "SELECT * FROM users WHERE email='$email' && password='$pass'";
  $sql = mysqli_query($conn, "SELECT * FROM users WHERE email='$email' && password='$pass'");
  $row = mysqli_fetch_array($sql);

  if(is_array($row)) //if email is correct
  {
    $_SESSION["email"] = $row['email'];
    $_SESSION["password"] = $row['pass'];
  }
  else
  {
     echo "Invalid information";  
  }
}else
{
  echo "Invalid data";  

}


<?php

 $conn=mysqli_connect("localhost", "root", "", "domantay_mary_db"); 

 //test code can be removed afterwards
 if(!$conn) //CREATED VARIABLE FOR DB
 {
     die("Connection failed".mysqli_connect_error());

 }else{

     //echo "database connected successfuly";
 }
?>
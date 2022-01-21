<?php
	
include_once 'classes/db2.php';
if($_POST['password'] == $_POST['confirm'])
{
if (isset($_POST['save'])) 
{
  $email = $_POST['email'];
  $sql = "SELECT * FROM users WHERE email='$email'";
  $res = mysqli_query($conn, $sql);
 
  if(mysqli_num_rows($res) > 0)
  {
    echo "The email you've entered is already taken.";  
  }
  else
  {
     
	 $f_name = $_POST['first_name'];
	 $l_name = $_POST['last_name'];
	 
	 $email = $_POST['email'];
	 $pas= $_POST['password'];
	 $pass = md5($pas);  
	 
	 $sql = "INSERT INTO users (f_name,l_name,email,password)
	 VALUES ('$f_name','$l_name','$email','$pass')";
	
	if (mysqli_query($conn, $sql)) 
	 {
		//echo "Congrats! You now have a new account!";
		header("Location: login.php"); //proceed to login page
		die; //end here
	 } 
	 else
		 {
		echo "Error: " . $sql . " " . mysqli_error($conn);
	 }
	 mysqli_close($conn);
}
 
}
  
}
else{
	
	echo "password should be the same";
	
}

 
	 
?>

<?php
include "reg.php";
?>

<?php

include_once 'db.php';

if (isset($_POST['save'])) 
{
  $email = $_POST['email'];
  $pas= $_POST['password'];
  $pass =  hash("sha1", $pas); //hashed password
  $sql = "SELECT * FROM users WHERE email='$email' && password='$pass'";
  $res = mysqli_query($conn, $sql);
 
  if(mysqli_num_rows($res) > 0)
  {
	   $email= $_POST['email'];
	   $pas= $_POST['newp_word'];
	   $pass = hash("sha1", $pas);  //var = the new password
	 
mysqli_query($conn,"UPDATE users set password='$pass' where email='$email'");

require_once 'PHPMailer/PHPMailerAutoload.php'; 
  // creates object
  $mail = new PHPMailer;//(true); 
  
   $eemail      = strip_tags($_POST['email']);
 // $subject = strip_tags('Password Changed');
   $text_message    = "Hello";      
   $p  = strip_tags($_POST['newp_word']);
 try
   {
    $mail->IsSMTP(true); 
   // $mail->isHTML(true);
    $mail->SMTPDebug  = 0;                     
    $mail->SMTPAuth   = true;                  
    $mail->SMTPSecure = "tls";                 
    $mail->Host       = "smtp.gmail.com";      
    $mail->Port        = '587';             
    $mail->AddAddress($eemail);
    $mail->Username   ="test@hgschool.co.uk";  
    $mail->Password   ="123456789r";            
    $mail->SetFrom('test@hgschool.co.uk','Do not Reply');
    $mail->AddReplyTo("test@hgschool.co.uk","helllo5");
    //$mail->Subject    = "Password Changed";
    $mail->Body    ="Your new password is: " .$p;
    $mail->AltBody    =  $p;
     
    if($mail->Send())
    {
     
     $msg = "Hi, Your mail is successfully sent to".$eemail." ";
     
    }
   }
   catch(phpmailerException $ex)
   {
    $msg = "<div class='alert alert-warning'>".$ex->errorMessage()."</div>";
   }
   

echo "password changed successfully and sent mail to your inbox....=>".$eemail;
	
header("Location:login_page.php");
}
else
{

  echo "Invalid password. Please enter your current password correctly.";
	
}

}









<?php 

include("classes/autoload.php");

//to check if in a page the user is log in or not 
$login = new Login(); //log in class
$user_data = $login->check_login($_SESSION['heypal_userid']);

$USER = $user_data;

//when user's go back to profile, the profile page belongs to the user, not the friends
if (isset($_GET['id']) && is_numeric($_GET['id'])) { //if id is set and is also a number - white listing

    //create another class to collect the wanted data
    $profile = new Profile();
    $profile_data = $profile->get_profile($_GET['id']); //in the profile class, call get_profile function and retrieve id info using the $_GET

    if (is_array($profile_data)) { //if data is array

        $user_data = $profile_data[0]; //transfer data here
    }
}

$USER = $user_data;

//when user's go back to profile, the profile page belongs to the user, not the friends
if (isset($_GET['id']) && is_numeric($_GET['id'])) { //if id is set and is also a number - white listing

    //create another class to collect the wanted data
    $profile = new Profile();
    $profile_data = $profile->get_profile($_GET['id']); //in the profile class, call get_profile function and retrieve id info using the $_GET

    if (is_array($profile_data)) { //if data is array

        $user_data = $profile_data[0]; //transfer data here
    }
}

$Post = new Post();
$ROW = false;
$ERROR = "";
if(isset($_GET['id'])){ //if id is set

    
    //$mypost = $Post->get_one_post($_GET['id']); 
    $ROW = $Post->get_one_post($_GET['id']); 


}else{
  
    $ERROR = "No image was found."; //print error
}
 
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Single Post</title>
</head>


<body style="background:#1B1E21;">

    <?php include 'nav.php'; ?>
    <!--Links nav bar-->

  

    <div class="container-fluid">
        <!--Classes from bootstrap-->
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8 pt-5 px-5 pb-4 my-5 " style="background:#3D4144; border-radius:20px;">

                     <h2  style="color:#999">Full Image</h2><br>
                 
                         <?php
                            $user = new User();
                            $image_class = new Image();

                            if(is_array($ROW)){//if it's an array

                                echo "<img src = '$ROW[image]' style = 'width:100%;'/>";
                              
                            }
                                          
                         ?>
             </div>
             <div class="col-md-2">Hi!</div>
         </div>
    </div>



</body>

</html>
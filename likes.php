
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
$likes = false;
$ERROR = "";
if(isset($_GET['id']) && ($_GET['type'])){ //if id is set

    $likes = $Post->get_likes($_GET['id'],($_GET['type'])); //store result in likes var

}else{
  
    $ERROR = "No information was found."; //print error
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>People who liked</title>
</head>


<body style="background:#1B1E21;">

    <?php include 'nav.php'; ?>
    <!--Links nav bar-->

    <div class="container-fluid" style="color:#999;">
        <!--Classes from bootstrap-->
        <div class="row">
        
            <div class="col-md-12 pt-5 px-5 pb-4">

                <div class="container-fluid pt-4 pb-4 ">

                     <h2 style="text-align:center;">People who liked the post</h2><br>
                 
                         <?php
                        
                            $user = new User();
                            $image_class = new Image();

                            if(is_array($likes)){//if it's an array

                                foreach ($likes as $row){
                                   
                                $FRIEND_ROW = $user->get_user($row['user_id']);
                                include("friend.php");
                                }
                            }
                                          
                         ?>

                 </div>
             </div>
         </div>
    </div>



</body>

</html>
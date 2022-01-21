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

//posting starts here
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $post = new Post(); //instantiate post class
    $id = $_SESSION['heypal_userid'];
    $result = $post->create_post($id, $_POST, $_FILES);

    //print_r($_POST); 
    //die;
    if ($result == "") { //if result is empty

        //redirect page to refresh the page so the post won't be doubled
        header("Location:single_post.php?id=$_GET[id]");
        die;
    } else { //if there's an error

        echo "The following errors occured. ";
        echo "$result";
    }
}

$Post = new Post();
$ROW = false;
$ERROR = "";
if (isset($_GET['id'])) { //if id is set

    $ROW = $Post->get_one_post($_GET['id']); //store result in likes var

} else {

    $ERROR = "No post was found."; //print error
}


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Single Post | HeyPal</title>
</head>


<?php include 'nav.php'; ?>
        <!--Links nav bar-->
<body style="background:#1B1E21; color:#999;">

<style>
    .row{
        --bs-gutter-x: 0;
    }
</style>
    
    <div class="row mt-5 mb-5 " style="margin-left:25%; margin-right:25%;">

            <h2>Hey, <?php echo $user_data['f_name'] . " " . $user_data['l_name'] ?></h2>
            <h2 class="pb-3">Do you want to comment on this post?</h2>

            <?php

            $user = new User();
            $image_class = new Image();

            if (is_array($ROW)) { //if it's an array

                $ROW_USER = $user->get_user($ROW['user_id']);
               
                include("post_profile.php"); //for the single post
            }
            ?>
            <div class="row px-5 m-0 mt-5 pt-5 " style="background:#3D4144; color:#999; border-radius:20px;">
                <!--For posting-->
                <form method="post" enctype="multipart/form-data" > 
                    <!--multipart form is important-->
                    <textarea name="post" class="form-control form-control-lg" placeholder="Post a comment." style="background:#2e3032; color:white;"> </textarea>
                    <!--Choose file here-->
                    <input type="hidden" name="parent" value="<?php echo $ROW['post_id']?>"> <!--Not seen by the user-->
                    <div class="row mt-3">
                                <input type="file" name="file" style="color:white;" class="pb-2"> 
                                <input class="btn px-4" style="color:white; background:#FF9340" id="post_button" type="submit" value="Post">
                            </div>
                    <br>
                </form>
            </div>
                <?php
                    $comments = $Post->get_comments($ROW['post_id']);

                    if(is_array($comments)){ //if it's an array

                        foreach($comments as $COMMENT){ //just the value
                            //$ROW_USER = $user->get_user($COMMENT['userid']);
                            include("comment.php");
                        }
                    }
                ?>

         </div>
   
</body>

</html>
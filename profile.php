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


//posting starts here
if ($_SERVER['REQUEST_METHOD'] == "POST") {


    if (isset($_POST['f_name'])) {

        $settings_class = new Settings();
        $settings_class->save_settings($_POST, $_SESSION['heypal_userid']);
    } else {
        $post = new Post(); //instantiate post class
        $id = $_SESSION['heypal_userid'];
        $result = $post->create_post($id, $_POST, $_FILES);

        //print_r($_POST); 
        //die;
        if ($result == "") { //if result is empty

            //redirect page to refresh the page so the post won't be doubled
            header("Location:profile.php");
            die;
        } else { //if there's an error

            echo "The following errors occured. ";
            echo "$result";
        }
    }
}

//even if we don't post, the previous post should be retrieved
//collect post 
$post = new Post(); //instantiate post class
//$id = $_SESSION['heypal_userid'];
$id = $user_data['user_id'];

$posts = $post->get_posts($id); //new function - get_post inside classes/post.php

//collect friends
$user = new User(); //instantiate post class
//$id = $_SESSION['heypal_userid'];

$friends = $user->get_following($user_data['user_id'], "user"); //new function - get_post inside pclasses/post.php //originally get_friends($id)

//new image class
$image_class = new Image();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
</head>

<body style="background:#1B1E21;">

    <!--Navigation-->
    <?php include 'nav.php'; ?>

    <!--COVER IMAGE-->
    <div style=" position:relative; text-align:center; color:white;">

        <?php
        $image = "images/placeholder_header.jpg";
        if (file_exists($user_data['cover_image'])) { //if file exists
            $image = $image_class->get_thumb_cover($user_data['cover_image']); //change image path
        }
        ?>
      <img src=<?php echo $image ?> id="cover_image" style="width:100%; height:300px">
      

      
        <div style="text-align:center; position:absolute; top: 50%; left:50%; transform:translate(-50%, -50%);">
            <!--NAME-->
            <a href="profile.php?id=<?php echo $user_data['user_id'] ?>" style="text-decoration:none;">

                <h3 class="pb-2" style="font-size:2em; text-transform: uppercase; letter-spacing: 0.2em; color:#FF9340"><?php echo $user_data['f_name'] . " " . $user_data['l_name'] ?></h3>
            </a>

            <!--For follow--->
            <?php
                $mylikes = ""; //empty string
                if ($user_data['likes'] > 0) { //if likes is greater than 0
                    $mylikes = "(" . $user_data['likes'] . " Followers)";
                } else {
                }
            ?>
             <a href="like.php?type=user&id=<?php echo $user_data['user_id'] ?>">
                  <input id="post_button" type="button" value="Follow <?php echo $mylikes ?>" class="btn btn-outline-light">
             </a>
           
            <!--Change Image/Cover-->
            <div class="container mt-3" style="text-align:center;">
                <a style="text-decoration:none; color:white; text-align:center; " href="change_profile_image.php?change=profile"> Change Image </a> |
                <a style="text-decoration:none; color:white; text-align:center;" href="change_profile_image.php?change=cover"> Change Cover </a>
            </div>

        </div>
  
    </div>



    <!--Links-->
    <div class="row" style="justify-content:center; text-align:center;">

        <div class="col"></div>
        <div class="col-md-2"><a href="index.php"><button type="button" class="btn btn-dark" style="width:100%; border-radius: 0 !important;">Timeline</button></a></div>
        <div class="col-md-2"><a href="profile.php?section=about&id=<?php echo $user_data['user_id'] ?>"><button type="button" class="btn btn-dark" style="width:100%; border-radius: 0 !important;">About</button></a></div>
        <div class="col-md-2"><a href="profile.php?section=photos&id=<?php echo $user_data['user_id'] ?>"><button type="button" class="btn btn-dark" style="width:100%; border-radius: 0 !important;">Photos</button></a></div>
        <div class="col-md-2"><a href="profile.php?section=following&id=<?php echo $user_data['user_id'] ?>"><button type="button" class="btn btn-dark" style="width:100%; border-radius: 0 !important;">Following</button></a></div>
        <div class="col-md-2"><a href="profile.php?section=followers&id=<?php echo $user_data['user_id'] ?>"><button type="button" class="btn btn-dark" style="width:100%; border-radius: 0 !important;">Followers</button></a></div>

        <?php
        // if you own the profile visited
        if ($user_data['user_id'] == $_SESSION['heypal_userid']) { //if user id = session is
            echo '<div class="col-md-2"><a href="profile.php?section=settings&id=' . $user_data['user_id'] . '"><button type="button" class="btn btn-dark" style="width:100%; border-radius: 0 !important;">Edit Profile</button></a></div>';
        }

        ?>
        <div class="col"></div>

    </div>

 
    <style>
        .row {
            --bs-gutter-x: 0rem;
        }
    </style>

    <?php
    $section = "default";
    if (isset($_GET['section'])) {

        $section = $_GET['section'];
    }

    if ($section == "default") {

        include("profile_content_default.php");
    } else if ($section == "photos") {

        include("profile_content_photos.php");
    } else if ($section == "followers") {

        include("profile_content_followers.php");
    } else if ($section == "following") {

        include("profile_content_following.php");
    } else if ($section == "settings") {

        include("profile_content_settings.php");
    } else if ($section == "about") {

        include("profile_content_about.php");
    }
    ?>

</body>

</html>
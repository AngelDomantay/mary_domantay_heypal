<?php

include("classes/autoload.php");

//to check if in a page the user is logged in or not 
$login = new Login(); //log in class
$user_data = $login->check_login($_SESSION['heypal_userid']);

//I added this personally****************
$USER = $user_data;

//when the user goes back to profile, the profile page belongs to the user, not the friends
if (isset($_GET['id']) && is_numeric($_GET['id'])) { //if id is set and is also a number - white listing

    //create another class to collect the wanted data
    $profile = new Profile();
    $profile_data = $profile->get_profile($_GET['id']); //in the profile class, call get_profile function and retrieve id info using the $_GET

    if (is_array($profile_data)) { //if data is array

        $user_data = $profile_data[0]; //transfer data here
    }

    //FOR POSTING

    //posting starts here
    if ($_SERVER['REQUEST_METHOD'] == "POST") {

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

//posting starts here
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $post = new Post(); //instantiate post class
    $id = $_SESSION['heypal_userid'];


    $result = $post->create_post($id, $_POST, $_FILES);

    if ($result == "") { //if result is empty

        //redirect page to refresh the page so the post won't be doubled
        header("Location:index.php");
        die;
    } else { //if there's an error

        echo "The following errors occured. ";
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

$friends = $user->get_friends($id); //new function - get_post inside pclasses/post.php

//new image class
$image_class = new Image();
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style_card.css">
    <title>Home</title>
</head>

<style>
    h1 {
        color: #999;
    }

    h2 {
        color: #999;
    }
</style>

<body>

    <?php include 'nav.php'; ?>
    <!--Links nav bar-->

    <div class="container-fluid" style="background:#1B1E21;">
        <!--Classes from bootstrap-->
        <div class="row">

            <!--For friends-->
            <div class="col-md-2 pt-5 px-5 pb-5">
                <!--<h2>Visit</h2>-->
                <h2 style="text-align:center;">Suggested</h2>
                <h1 style="text-align:center;">Pals</h1>

                <div class="row mt-4">
                    <?php
                    if ($friends) {
                        //var_dump($friends);
                        foreach ($friends as $FRIEND_ROW) {

                            $user = new User(); //instantiate a user class
                            include("friend.php"); //containes data of friends  
                        }
                    } ?>

                </div>

            </div>

            <div class="col-md-6 pt-5 px-5 pb-4">

                <h2>Hey, <?php echo $user_data['f_name'] . " " . $user_data['l_name'] ?></h2>
                <h1 class="pb-3">What's Up?</h1>

                <div class="container-fluid pt-4 pb-4">

                    <div class="row py-4 px-3" style="background:#3D4144; border-radius:20px;">

                        <div class="col-md-2">
                            <div class="container m-0 p-0 mb-2">
                                <!--displaying profile image-->
                                <?php
                                $image = "images/user_female.jpg"; //display female placeholder by default
                                if ($user_data['gender'] == "Male") { //if male 
                                    $image = "images/user_male.jpg"; //display male placeholder by default
                                }

                                if (file_exists($user_data['profile_image'])) { //if file exists
                                    $image = $image_class->get_thumb_profile($user_data['profile_image']); //change image path
                                }
                                ?>

                                <!--print user image-->
                                <a href="profile.php">
                                    <img src=<?php echo $image ?> id="profile_pic" style="width: 70px; height:70px; border-radius:50%;">
                                </a>
                            </div>
                        </div>

                        <div class="col-md">

                            <!-- <textarea placeholder = "Have a story to share?"></textarea>-->
                            <!-- <input class="form-control form-control-lg" type="text" placeholder="Have a story to share?">-->
                            <!--- <input class = "btn btn-dark px-4 " type = "submit" value="Post">-->

                            <!-- Trigger/Open The Modal for post -->
                            <!---<div class="row temp mt-3 mb-4">
                                <button id="btn_post" class="btn btn-outline-dark">
                                    <h3> Have a story to share? </h3>
                                </button>
                            </div>

                            The Modal pop-up for posting: text, photos & videos -->
                            <!--For posting-->

                            <style>
                                .fileUpload {
                                    position: relative;
                                    overflow: hidden;
                                    margin: 10px;
                                }

                                .fileUpload input.upload {
                                    position: absolute;
                                    top: 0;
                                    right: 0;
                                    margin: 0;
                                    padding: 0;
                                    font-size: 20px;
                                    cursor: pointer;
                                    opacity: 0;
                                    filter: alpha(opacity=0);
                                }
                            </style>

                            <form method="post" enctype="multipart/form-data">
                                <!--multipart form is important-->
                                <textarea name="post" class="form-control form-control-lg" placeholder="Got something to share?" style="background:#2e3032; color:white;"> </textarea>
                                <!--Choose file here-->
                                <div class="row mt-3">
                                    <input type="file" name="file" style="color:white;" class="pb-2">
                                    <input class="btn px-4" style="color:white; background:#FF9340" id="post_button" type="submit" value="Post">
                                </div>
                            </form>

                        </div>
                    </div>

                    <!--For posting-->
                    <div class="row mt-4">
                        <?php

                        $DB = new Database();
                        $user_class = new User(); //Instantiate User class to get followers
                        $image_class = new Image(); //Instantiate User class to get followers
                        $followers = $user_class->get_following($_SESSION['heypal_userid'], "user"); //get_followers function

                        $follower_ids = false;
                        if (is_array($followers)) { //if array is found

                            $follower_ids = array_column($followers, "user_id"); //input is followers, column to be accessed is user_id
                            $follower_ids = implode("','", $follower_ids); //implode gets an array, gets all values and connects them together to make a string
                            //example outcome: "name1','name1',' " this needs inverted comma at the start and end
                        }

                        if ($follower_ids) { //if true
                            $myuserid = $_SESSION['heypal_userid'];
                            $sql = "select * from posts where parent = 0 and user_id = '$myuserid' || user_id in('" . $follower_ids . "') order by id desc limit 50"; //added inverted comma at the beginning and end
                            $posts = $DB->read($sql);
                        }


                        if (isset($posts) && $posts) {
                            foreach ($posts as $ROW) {
                                $user = new User(); //instantiate a user class
                                $ROW_USER = $user->get_user($ROW['user_id']); //get get_user function value from  user.php //originall this was comment out
                                include("post_profile.php"); //containes data of post   
                            }
                        }


                        /*  $DB = new Database(); //temp for posting MAYBE POSSIBLE FOR SUGSGETIONS IF ELSE

                                $user_class = new User();
                                $image_class = new Image();
                            
                                $followers = $user_class->get_friends($_SESSION['heypal_userid'],"user");

                                $follower_ids = false;

                                if(is_array($followers)){
                                    $follower_ids = array_column($followers, "user_id"); //get id of friends
                                    $follower_ids =implode("','",$follower_ids); //gets array, gets all values, connect together to make a string


                                }

                                if($follower_ids){
                                    $sql = "select * from posts where user_id in('" .$follower_ids. "') order by id desc limit 100";
                                    $posts = $DB->read($sql);
                                }
                               
                                if(isset($posts) && $posts){

                                    foreach ($posts as $ROW){
                                        $user = new User();
                                        $ROW_USER= $user->get_user($ROW['user_id']);
                                        include("post_profile.php");
                                    }
                                  
                                }*/

                        ?>
                    </div>

                </div>
            </div>
            <div class="col-md-4 pt-5 px-4 pb-5">

                <h1 class="pt-4"> Visit Pages</h1>

                <!--Cards-->
                <div class="row">
                    <div class="col-6 col-md-6 mt-3 ">
                        <!-- flip-card-container -->
                        <div class="flip-card-container" style="--hue: 220">
                            <div class="flip-card">

                                <div class="card-front">
                                    <figure>
                                        <div class="img-bg"></div>
                                        <img src="https://images.unsplash.com/photo-1486162928267-e6274cb3106f?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=500&q=60" alt="Visit Page" style="width:100%; height:100%;">
                                        <figcaption>My Profile</figcaption>
                                    </figure>

                                </div>

                                <div class="card-back">
                                    <figure>
                                        <div class="img-bg"></div>
                                        <img src="https://images.unsplash.com/photo-1486162928267-e6274cb3106f?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=500&q=60" alt="Visit Page" style="width:100%; height:100%;">
                                    </figure>

                                    <a href="profile.php"><button>Visit</button></a>

                                    <div class="design-container">
                                        <span class="design design--1"></span>
                                        <span class="design design--2"></span>
                                        <span class="design design--3"></span>
                                        <span class="design design--4"></span>
                                        <span class="design design--5"></span>
                                        <span class="design design--6"></span>
                                        <span class="design design--7"></span>
                                        <span class="design design--8"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-6 col-md-6 mt-3">
                        <!-- flip-card-container -->
                        <div class="flip-card-container" style="--hue: 220">
                            <div class="flip-card">

                                <div class="card-front">
                                    <figure>
                                        <div class="img-bg"></div>
                                        <img src="https://images.unsplash.com/photo-1486162928267-e6274cb3106f?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=500&q=60" alt="Visit Page" style="width:100%; height:100%;">
                                        <figcaption>My Photos</figcaption>
                                    </figure>

                                </div>

                                <div class="card-back">
                                    <figure>
                                        <div class="img-bg"></div>
                                        <img src="https://images.unsplash.com/photo-1486162928267-e6274cb3106f?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=500&q=60" alt="Visit Page" style="width:100%; height:100%;">
                                    </figure>

                                    <a href="profile.php?section=photos&id=<?php echo $user_data['user_id'] ?>"><button>Visit</button></a>

                                    <div class="design-container">
                                        <span class="design design--1"></span>
                                        <span class="design design--2"></span>
                                        <span class="design design--3"></span>
                                        <span class="design design--4"></span>
                                        <span class="design design--5"></span>
                                        <span class="design design--6"></span>
                                        <span class="design design--7"></span>
                                        <span class="design design--8"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!--Cards-->
                <div class="row">
                    <div class="col-6 col-md-6 mt-2 ">
                        <!-- flip-card-container -->
                        <div class="flip-card-container" style="--hue: 220">
                            <div class="flip-card">

                                <div class="card-front">
                                    <figure>
                                        <div class="img-bg"></div>
                                        <img src="https://images.unsplash.com/photo-1486162928267-e6274cb3106f?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=500&q=60" alt="Visit Page" style="width:100%; height:100%;">
                                        <figcaption>Following</figcaption>
                                    </figure>

                                </div>

                                <div class="card-back">
                                    <figure>
                                        <div class="img-bg"></div>
                                        <img src="https://images.unsplash.com/photo-1486162928267-e6274cb3106f?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=500&q=60" alt="Visit Page" style="width:100%; height:100%;">
                                    </figure>

                                    <a href="profile.php?section=following&id=<?php echo $user_data['user_id'] ?>"> <button>Visit</button></a>

                                    <div class="design-container">
                                        <span class="design design--1"></span>
                                        <span class="design design--2"></span>
                                        <span class="design design--3"></span>
                                        <span class="design design--4"></span>
                                        <span class="design design--5"></span>
                                        <span class="design design--6"></span>
                                        <span class="design design--7"></span>
                                        <span class="design design--8"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <style>
                        .row {
                            --bs-gutter-x: 0;
                        }
                    </style>

                    <div class="col-6 col-md-6 mt-2">
                        <!-- flip-card-container -->
                        <div class="flip-card-container" style="--hue: 220">
                            <div class="flip-card">

                                <div class="card-front">
                                    <figure>
                                        <div class="img-bg"></div>
                                        <img src="https://images.unsplash.com/photo-1486162928267-e6274cb3106f?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=500&q=60" alt="Visit Page" style="width:100%; height:100%;">
                                        <figcaption>Edit Profile</figcaption>
                                    </figure>

                                </div>

                                <div class="card-back">
                                    <figure>
                                        <div class="img-bg"></div>
                                        <img src="https://images.unsplash.com/photo-1486162928267-e6274cb3106f?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=500&q=60" alt="Visit Page" style="width:100%; height:100%;">
                                    </figure>

                                    <?php
                                    if ($user_data['user_id'] == $_SESSION['heypal_userid']) {

                                        echo '<a href="profile.php?section=settings&id=' . $user_data['user_id'] . '"> <button>Visit</button></a>';
                                    }
                                    ?>


                                    <div class="design-container">
                                        <span class="design design--1"></span>
                                        <span class="design design--2"></span>
                                        <span class="design design--3"></span>
                                        <span class="design design--4"></span>
                                        <span class="design design--5"></span>
                                        <span class="design design--6"></span>
                                        <span class="design design--7"></span>
                                        <span class="design design--8"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>



</body>

</html>
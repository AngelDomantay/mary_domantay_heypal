<?php

session_start();

include("classes/db2.php");
include("classes/signup.php");
include("classes/login.php");
include("classes/user.php");
include("classes/post.php");
include("classes/image_crop.php");

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

if($_SERVER['REQUEST_METHOD'] =="POST"){


    if(isset($_FILES['file']['name']) && $_FILES['file']['name'] != ""){ //if file has value and is not empty


        //FOR SECURITY 
        if($_FILES['file']['type'] == "image/jpeg"){ //if the file type is in jpeg format

            $allowed_size = (1024 * 1024) * 7; //in 1,048,576 x 7 = mb = allowed size for image
            if($_FILES['file']['size'] < $allowed_size){ //if file size is less than the allowed size


                $folder = "uploads/" . $user_data['user_id'] . "/" ; //becomes a folder

                if(!file_exists($folder)){ //if folder does not exits
                    mkdir($folder,0777,true); //create a folder with file permissons
                }

                //if successful

                $image = new Image(); //instantiate image class

                $filename = $folder . $image->generate_filename(15) . ".jpg"; //image class > generate filename function > length is 15
                move_uploaded_file($_FILES['file']['tmp_name'], $filename); //source and destination
                
                $change = "profile";
                    //check for mode
                    if(isset($_GET['change'])){ //if change memory location is set
                        $change = $_GET['change'];
                    }

                //crop image

                if($change == "cover"){

                    if(file_exists($user_data['cover_image'])){
                        unlink($user_data['cover_image']); //delete old file images that are no longer needed
                    }

                    $image->resize_image($filename,$filename,1500,1500); //call crop_image function

                }else{

                    if(file_exists($user_data['profile_image'])){
                        unlink($user_data['profile_image']); //delete old file images that are no longer needed
                    }
                    $image->resize_image($filename,$filename,1500,1500); //call crop_image function
                }

                if(file_exists($filename)){ //if the file already exists
        
                    //created query 
                    //change value of profile image to value of $filename(string in '') variable
                    //row to be stored will depend which user_id is active
                    $user_id = $user_data['user_id']; //$user_data contains row of current user

                    //URL Query strings
                    if($change == "cover"){ //set to cover image
                        //limit 1 = stops the search after the first id is found
                        //update users table, set cover_iamge to be equal to the filename where user_id = $user_id value
                        $query = "update users set cover_image = '$filename' where user_id = '$user_id' limit 1"; 
                        $_POST['is_cover_image'] = 1;

                    }else{ //set to profile image
                        //update users table, set profile_iamge to be equal to the filename where user_id = $user_id value
                        $query = "update users set profile_image = '$filename' where user_id = '$user_id' limit 1"; 
                        $_POST['is_profile_image'] = 1;
                    }

                    $DB = new Database();
                    $DB->save($query); //save here

                    //display profile picture poste; create post
                    $post = new Post(); //instantiate post class
                
                    $post->create_post($user_id, $_POST,$filename);

                    header(("Location: profile.php")); //if successful, redirect to profile.php pages
                    die;
                }
            }else{
                echo "Only images of size 3 MB or lower are allowed.";
            }
        }else{
            echo "Only images of JPEG format are allowed.";
        }

    }else{
        //style the error statement
        echo "Please add a valid image!";
    }
  
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Profile Image</title>
</head>

<?php include 'nav.php'; ?>
<body style="background:#1B1E21; color:#999; text-align:center;">


    <!--Links nav bar-->

    <div class="container-fluid my-5">
        <!--Classes from bootstrap-->

                <h2>Hey, <?php echo $user_data['f_name'] . " " . $user_data['l_name'] ?></h2>
                <h4 class="pb-3">Do you want to change your image?</h4>

                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6 " style="background:#2e3032; border-radius:20px;">
                            <!-- For uploading images -->
                            <form method = "post" enctype="multipart/form-data">
                                
                                <h4 class="mt-3">Current image</h4>
                               <?php
                                //for previous profile pic
                                 //check for mode
                                 if(isset($_GET['change']) && $_GET['change']== "cover"){ //if change memory location is set
                                    
                                    $change = "cover";
                                    echo "<img src = '$user_data[cover_image]' style ='max-width:500px'>";

                                 }else{ //for profile image

                                    echo "<img src = '$user_data[profile_image]' style ='max-width:500px'>";
                                 }

                               ?>
                                </br>
                                <div class="mt-3 mb-5">  
                                <input type="file" name="file">
                                <input id="post_button" type="submit" value="Change" class="btn" style="background:#FF9340; color:white;"><br>
                                </div>
                               
                            </form>
                        </div>
                        <div class="col-md-3"></div>
                    </div>
                
           
           
     
    </div>



</body>

</html>
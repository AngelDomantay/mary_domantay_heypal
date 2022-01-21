
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

$Post = new Post(); //instantiating post class

$ERROR = "";
if(isset($_GET['id'])){ //if id is set

    $ROW = $Post->get_one_post($_GET['id']); //the row is equal to what value is returned in the function parameter
   
    if(!$ROW){ //row is not returned
        
       $ERROR = "No such post was found."; //print error
        //print_r($_GET['id']);
       // var_dump($_GET['id']);
    }else{
        if($ROW['user_id'] != $_SESSION['heypal_userid']){ //if user_id is not equal to the session
            $ERROR = "Access denied. Only the owner of the profile can delete this file.";
        }
    }

}else{
  
    $ERROR = "No such post was found."; //print error
}


    if(isset($_SERVER['HTTP_REFERER']) && !strstr($_SERVER['HTTP_REFERER'],"edit.php")){

        $_SESSION['return_to'] = $_SERVER['HTTP_REFERER'];
    }

    if($_SERVER['REQUEST_METHOD'] =="POST"){
        
        $Post->edit_post($_POST,$_FILES);
        header("Location: ".$_SESSION['return_to']); //redirect user to the profile page
        die;
    }
  
/*}*/

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete</title>
</head>


<body style="background:#1B1E21; color:#999;">

    <?php include 'nav.php'; ?>
    <!--Links nav bar-->

  

    <div class="container-fluid mb-5">
        <!--Classes from bootstrap-->
        <div class="row">
            <div class="col-md-3 ">
               
            </div>
            <div class="col-md-6 pt-5 px-5 pb-4 ">

                <h2>Hey, <?php echo $user_data['f_name'] . " " . $user_data['l_name']?></h2>
                <h4 class="pb-3">Do you want to edit this post?</h4>

                <div class="container-fluid pt-4 pb-4" style="background:#3D4144; border-radius:20px;">


                        <!--Post deletion-->

                            <h2>Edit Post</h2><br>
                            <form method = "post" enctype="multipart/form-data">
                                    <?php
                                        if($ERROR != ""){ //if error is not equal to empty
                                            echo $ERROR;

                                        }else{ 
                                          
                                             echo ' 
                                                <textarea name="post" class="form-control form-control-lg " placeholder="Got something to share?" style="background:#2e3032; color:white;">' .$ROW['post'] .'</textarea>
                                                </br>
                                                <input type="file" name="file"> ';
                                            echo "<input type = 'hidden' name='post_id' value= '$ROW[post_id]'>"; 
                                            echo "<input class='btn px-4' id ='post_button' type = 'submit' value='Save' style='color:white; background:#FF9340;'>"; 

                                            if (file_exists($ROW['image'])) {
                                                $image_class = new Image();
                                                $post_image = $image_class->get_thumb_post($ROW['image']);
                                                echo "<br><div><img src = '$post_image' style = 'width:100%; height:100%; margin-top:1em;' ;></div>";
                                           
                                            }
                                          
                                        }
                                    ?>
                                        
                            </form>


                </div>
            </div>
            <div class="col-md-3 pt-5 px-5 pb-5 "> </div>
        </div>
    </div>



</body>

</html>
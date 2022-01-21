
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

//to go back to the same place where you went 
if(isset($_SERVER['HTTP_REFERER']) && !strstr($_SERVER['HTTP_REFERER'],"delete.php")){

    $_SESSION['return_to'] = $_SERVER['HTTP_REFERER'];
}


$ERROR = "";
if(isset($_GET['id'])){ //if id is set

    $ROW = $Post->get_one_post($_GET['id']); //the row is equal to what value is returned in the function parameter
   
    if(!$ROW){ //row is not returned
        
       $ERROR = "No such post was found."; //print error
        
    }else{
        if($ROW['user_id'] != $_SESSION['heypal_userid']){ //if user_id is not equal to the session
            $ERROR = "Access denied. Only the owner of the profile can delete this file.";
        }
    }

}else{
  
    $ERROR = "No such post was found."; //print error
}


if($_SERVER['REQUEST_METHOD'] == "GET"){
    //delete post
    $Post->delete_post($_GET['id']); //call the delete post method from the post class
    header("Location: ".$_SESSION['return_to']); //redirect user to the profile page
   die; //end code here
}else{
    echo"No file was found";
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete</title>
</head>


<body>

    <?php include 'nav.php'; ?>
    <!--Links nav bar-->

  

    <div class="container-fluid">
        <!--Classes from bootstrap-->
        <div class="row">
            <div class="col-md-2 temp">
                <h1>Hello</h1>
            </div>
            <div class="col-md-6 pt-5 px-5 pb-4 temp">

                <h2>Hey, <?php echo $user_data['f_name'] . " " . $user_data['l_name']?></h2>
                <h1 class="pb-3">What's Up?</h1>

                <div class="container-fluid pt-4 pb-4 temp">

                    <div class="row temp">
                        <div class="col-md-2 temp"></div>

                        <!--Post deletion-->
                        <div class="col-md temp">

                            <h2>Delete Post</h2><br>
                            <form method = "post" >
                 
                                    <?php

                                        if($ERROR != ""){ //if error is not equal to empty
                                            echo $ERROR;

                                        }else{  
                                            echo "Are you sure you want to delete this post? <br>";
                                            $user = new User();
                                            $ROW = $user->get_user($ROW['user_id']);

                                           //to var_dump($ROW); die;
                                           include("post_delete.php");

                                            echo "<input type = 'hidden' name='post_id' value= '$ROW[post_id]'>"; 
                                            echo "<input id ='post_button' type = 'submit' value='Delete'>"; 
                                        }
                                          
                                    ?>
                                        
                            </form>
                            
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-md-4 pt-5 px-5 pb-5 temp"> </div>
        </div>
    </div>



</body>

</html>
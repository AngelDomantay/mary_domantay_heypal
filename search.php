
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



    // search feature
    if(isset($_GET['find'])){

        $find = addslashes($_GET['find']);
        //% means look for any characters before the actual word im looking for
        // instead of = we use 'like'
        $sql = "select * from users where f_name like '%$find%' || l_name like '%$find%' limit 30"; //display max of 30
        $DB = new Database();
        $results = $DB->read($sql);
    }else{
        echo"No results were found.";
    }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search</title>
</head>


<body style="background:#1B1E21;">

    <?php include 'nav.php'; ?>
    <!--Links nav bar-->

    <div class="container-fluid">
        <!--Classes from bootstrap-->
        <div class="row">

                <h2 class="mt-4" style="text-align:center; color:#999;"><?php echo $user_data['f_name'] . " " . $user_data['l_name'] . "'s recent searches"?></h2>

                <div class="container-fluid pt-4 pb-4 ">

                 
                         <?php
                        
                            $user = new User();
                            $image_class = new Image();

                            if(is_array($results)){//if it's an array

                                foreach ($results as $row){
                                   
                                $FRIEND_ROW = $user->get_user($row['user_id']);
                                include("friend.php");
                                }

                            }else{
                                echo "No results were found.";
                            }
                                          
                         ?>

                 </div>
            
         </div>
    </div>



</body>

</html>
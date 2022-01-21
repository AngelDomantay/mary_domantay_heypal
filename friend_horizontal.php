<!--user.php  = friend.php-->

<div>
    <?php
    $image = "images/user_female.jpg"; //image is female by default

    if ($FRIEND_ROW['gender'] == 'Male') { //if gender is equal to male
        $image =  "images/user_male.jpg"; //print image
    }

    if (file_exists($FRIEND_ROW['profile_image'])) {
        $image = $image_class->get_thumb_profile($FRIEND_ROW['profile_image']);
    }
    ?>

    <!--Goes to friend's profile when link is clicked-->

        <div class="container">
             <!--print friend's image-->
            <img src=<?php echo $image ?> style="width: 100px; height:100px; border-radius: 20px; display:block; margin-left:auto; margin-right:auto; margin-top:auto; margin-bottom:auto;"> 

            <a style="text-decoration:none;" href="profile.php?id=<?php echo $FRIEND_ROW['user_id']; ?>">   <!--add url query string - insert friend's user id-->
            <!--print friend's first and last name-->
            <h4 style="text-align:center;"> <?php echo $FRIEND_ROW['first_name'] . "<br>" . $FRIEND_ROW['last_name']; ?></h4>
            </a>
            <br>
        </div>


</div>
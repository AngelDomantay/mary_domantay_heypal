

    <div class="row mt-5 ">
        <div class="col-md-2"></div>

        <!--For Profile-->
        <div class="col-md-6">
            <div class="row py-4" style="background:#2e3032; border-radius:20px;">
                <div class="col-md-3 ">
                    <!--display profile image-->
                    <?php
                    $image = "images/user_female.jpg"; //display female placeholder by default
                    if ($user_data['gender'] == "Male") { //if male 
                        $image = "images/user_male.jpg";
                    }

                    if (file_exists($user_data['profile_image'])) { //if file exists
                        $image = $image_class->get_thumb_profile($user_data['profile_image']); //change image path
                    }
                    ?>
                    <!--print user image-->
                    <a href="profile.php">
                        <img src=<?php echo $image ?> id="profile_pic" class = "mt-3 " style="width: 100px; height:100px; display:block; margin-left:auto; margin-right:auto; margin-top:auto; margin-bottom:auto; border-radius:50%;">
                    </a>
                </div>
                <div class="col-md-9" style="padding-right:2em;">
                    <div class="row pb-2" style ="color:white; font-size:1.2em; ">
                        <!--Display User Name-->
                        <?php echo $user_data['f_name'] . " " . $user_data['l_name'] ?>

                    </div>
                    <div class="row">
                        <!--For posting-->
                        <form method="post" enctype="multipart/form-data">
                            <!--multipart form is important-->
                            <textarea name="post" class="form-control form-control-lg" placeholder="Got something to share?" style="background:#2e3032; color:white;"> </textarea>
                            <!--Choose file here-->
                            <div class="row mt-3">
                                <input type="file" name="file" style="color:white;" class="pb-2"> 
                                <input class="btn px-4" style="color:white; background:#FF9340" id="post_button" type="submit" value="Post">
                            </div>
                            
                            <br>
                        </form>
                    </div>
                </div>
            </div>

            <!--displaying profile posts-->
            <div class="row mt-4">

                <!--Display user posts-->
                <?php
                if ($posts) {
                    foreach ($posts as $ROW) {
                        $user = new User(); //instantiate a user class
                        $ROW_USER = $user->get_user($ROW['user_id']); //get get_user function value from  user.php //originall this was comment out
                        include("post_profile.php"); //containes data of post   
                    }
                }
                ?>
            </div>

        </div>
        <div class="col-md-2 ">
            <!--For friends-->
            <div class="row py-3 mx-3" style="text-align: center; color:white; background:#2e3032; border-radius:20px;">
                <h1 class="pt-3" style="font-size: 1.5em;"> Following</h1>
          
                <div class="row mt-4 ">
                    <?php
                    if ($friends) {
                        //var_dump($friends);
                        foreach ($friends as $friend) {

                            $user = new User(); //instantiate a user class
                            $FRIEND_ROW = $user->get_user($friend['user_id']);
                            include("friend.php"); //containes data of friends  
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="col-md-2"></div>

    </div>
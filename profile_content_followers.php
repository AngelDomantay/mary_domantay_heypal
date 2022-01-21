


<div class="row mt-5" style="display:block; text-align:center; color:white;">
    <?php

        $image_class = new Image();
        $post_class = new Post();
        $user_class = new User();

        $followers = $post_class->get_likes($user_data['user_id'], "user"); //user_data is an array, accesssing user_id, the type is "user"

        //to make sure if result is returned
        if(is_array( $followers)){ //if there's an array withing an array

            //loop through it
            foreach( $followers as $follower){

                $FRIEND_ROW = $user_class->get_user($follower['user_id']);
                 include("friend.php"); //originally user.php
            }
         
        }else{//f there's no array

            echo "No followers to be displayed.";
        }

    ?>
</div>
<!--for posting on profile-->

    <div class="row p-0 m-0 mt-4 px-3 py-3" style="background:#3D4144; border-radius:20px;">
        <div class="col-md-1 ">
            <?php
            $image = "images/user_female.jpg"; //image is female by default

            if ($ROW_USER['gender'] == 'Male') { //if gender is equal to male
                $image =  "images/user_male.jpg"; //print image

            }

            //if user has profile image then display image
            //if file exists regardless of what data is in there
            if (file_exists($user_data['profile_image'])) { //originally it should supposed to be $row instead of $user_data

                $image = $image_class->get_thumb_profile($COMMENT['profile_image']);
            }
            //print_r($image); //temp
            ?>
            <img src=<?php echo $image ?> style="width: 40px; height:40px; border-radius:20px; ">
            <!--print user image-->
        </div>

        <div class="col-md-11 mb-2">
            <!--User has updated her profile or cover image-->
            <div>
                <?php
                echo "<a href = 'profile.php?=$COMMENT[user_id]' style='color:white; text-decoration:none;'>"; //when link is clicked - go to user's profile
                echo htmlspecialchars($COMMENT['first_name']) . " " . htmlspecialchars($COMMENT['last_name']);
                echo "</a>";

                if ($COMMENT['is_profile_image']) { //if it's equal to one or true

                    $pronoun = "his";
                    if ($ROW_USER['gender'] == "Female") {

                        $pronoun = "her";
                        echo "<span style = 'font-weight:normal; color:#aaa;'> has updated $pronoun profile image. </span>";
                    }
                }

                if ($COMMENT['is_cover_image']) { //if it's equal to one or true

                    $pronoun = "his";
                    if ($ROW_USER['gender'] == "Female") {

                        $pronoun = "her";
                        echo "<span style = 'font-weight:normal; color:#aaa;'> has updated $pronoun cover image. </span>";
                    }
                }

                ?>
            </div>

            <div>

                <h3 style="font-size:14px; color: #999;"> <?php echo $COMMENT['date'] ?> </h3>
                <!--print date-->

                <!--Html escaping for security - treat values in post column db as normal texts and not code or special characters-->
                <?php echo htmlspecialchars($COMMENT['post']) ?> <br>
                <!--print post sentence-->
                
            </div>
        </div>
        
   

<div class="container ">
    <?php //post image
        if (file_exists($COMMENT['image'])) {
            $post_image = $image_class->get_thumb_post($COMMENT['image']);
            echo "<img src = '$post_image' style = 'width:100%; height:400px;>";
        }
    ?>  




<!--Only show this part when the post is owned by the user-->
<?php
    $post = new Post();

    if($post->i_own_post($COMMENT['post_id'],$_SESSION['heypal_userid'])){

        echo"
        <a href='edit.php'> </a> 
        <a href='delete.php?id=$COMMENT[post_id]' style='color:#999; text-decoration:none'> Delete </a> 
        
        <a href='edit.php?id=$COMMENT[post_id]' style='color:#999; text-decoration:none'> Edit </a>
        ";  
    }

?> 

<?php //Likes

    $i_liked = false;

    if(isset($_SESSION['heypal_userid'])){ //is session user id is set

            $DB = new Database(); //initalised database

            // increment likes column by one
            $sql = "select likes from likes where type='post' && content_id = '$COMMENT[post_id] limit 1"; 
            $result = $DB->read($sql); //read data

            if(is_array($result)){//if result is array then table already exists

                //first array and find likes
                $likes = json_decode($result[0]['likes'],true); //putting true - turns into an array not an object

                $user_ids = array_column($likes, "user_id");  //array column function - create new array from existing array
                
                if(in_array($_SESSION['heypal_userid'], $user_ids)){ //if user id is inside
                    $i_liked = true;
                }
             }
    }

    if($COMMENT['likes'] > 0){ //if likes is greater than zero
        echo "<br/>";
        echo "<a href = 'likes.php?type=post&id=$COMMENT[post_id]' style='text-decoration:none;'> "; //print result

        if($COMMENT['likes'] == 1){ //if there's only one like

            if($i_liked){ //print you liked the post
                echo "<div style='text-align:left; text-decoration:none; color:#999;'> You liked this post. </div>";
            }else{ //print another person liked the post
                echo "<div style='text-align:left; text-decoration:none; color:#999;'> 1 person liked this post. </div>";
            }
           
        }else{

            if($i_liked){

                $text = "others";
                if($COMMENT['likes'] - 1 == 1){
                    $TEXT="other";
                }
                echo "<div style='text-align:left; text-decoration:none; color:#999;'> You and " . ($COMMENT['likes'] -1) . " text liked this post. </div>";
            }else{
                echo "<div style='text-align:left; text-decoration:none; color:#999;'>" . $COMMENT['likes'] . " people liked this post. </div>";
            }
            
        }

        echo "</a>";

    }     

?>

<?php //viewing full page
    if($COMMENT['has_image']){
        echo " <a href = 'image_view.php?id=$COMMENT[post_id]'  style='color:#999; text-decoration:none' >";
        echo " View Full Image ";
        echo "</a>";
    }
?>

<!--Likes-->
<?php //by default do not display num of likes if it's equals to zero
    $likes = "";
    $likes = ($COMMENT['likes'] > 0) ? "(" .$COMMENT['likes']. ")" : "" ; //if row likes is greater than 0 (true), display num of likes; if false display an empty string
?>

<a href="like.php?type=post&id=<?php echo $COMMENT['post_id']?>" style="text-decoration:none;  color:#999;"><?php echo $likes?>Like</a> 

<!--Comments-->
<a href="single_post.php?id=<?php echo $COMMENT['post_id']?>" style="text-decoration:none; color:#999;"> Reply</a>
   
</div>
</div>
<br/>
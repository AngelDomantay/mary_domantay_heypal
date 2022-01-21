<!--for posting on profile-->
<div style="background:#3D4144; border-radius:20px; margin-bottom:1.5em;">
    <div class="row m-0 px-3 pt-4"  >
        <div class="col-md-1 ">
            <?php
            $image = "images/user_female.jpg"; //image is female by default

            if ($ROW_USER['gender'] == 'Male') { //if gender is equal to male
                $image =  "images/user_male.jpg"; //print image

            }

            //if user has profile image then display image
            //if file exists regardless of what data is in there
            if (file_exists($user_data['profile_image'])) { //originally it should supposed to be $row instead of $user_data

                $image = $image_class->get_thumb_profile($user_data['profile_image']);
            }
          
            ?>
            <img src=<?php echo $image ?> style="width: 40px; height:40px; border-radius:20px; ">
            <!--print user image-->
        </div>

        <div class="col-md-11 mb-2 ">
            <!--User has updated her profile or cover image-->
            <div style="color:white;">
                <?php
          
                echo htmlspecialchars($ROW_USER['first_name']) . " " . htmlspecialchars($ROW_USER['last_name']);
          
                if ($ROW['is_profile_image']) { //if it's equal to one or true

                    $pronoun = "his";
                    if ($ROW_USER['gender'] == "Female") {

                        $pronoun = "her";
                        echo "<span style = 'font-weight:normal; color:#aaa;'> has updated $pronoun profile image. </span>";
                    }
                }

                if ($ROW['is_cover_image']) { //if it's equal to one or true

                    $pronoun = "his";
                    if ($ROW_USER['gender'] == "Female") {

                        $pronoun = "her";
                        echo "<span style = 'font-weight:normal; color:#aaa;'> has updated $pronoun cover image. </span>";
                    }
                }

                ?>
            </div>

            <div>

                <!--Access the time function directly from class folders instead of instantiating class-->
                <h3 style="font-size:14px; color: #999;"> <?php echo Time::get_time($ROW['date']) ?> </h3>
                <!--print date-->

                <!--Html escaping for security - treat values in post column db as normal texts and not code or special characters-->
                 <h3 style="font-size:16px; color: white;"> <?php echo htmlspecialchars($ROW['post']) ?> <br> </h3>
                <!--print post sentence-->
                
            </div>
        </div>
        
    </div>

<div class="container mb-2 px-3">

        <?php //post image
            if (file_exists($ROW['image'])) {
                $post_image = $image_class->get_thumb_post($ROW['image']);
                echo "<img src = '$post_image' style = 'width:100%; height:400px; '>";
            }
        ?>  
<div class="w-100">


<div class="d-flex justify-content-between">
    
<div class="">

    <!--Likes-->
    <?php //by default do not display num of likes if it's equals to zero
        $likes = "";
        $likes = ($ROW['likes'] > 0) ? "(" .$ROW['likes']. ")" : "" ; //if row likes is greater than 0 (true), display num of likes; if false display an empty string
    ?>

        <a href="like.php?type=post&id=<?php echo $ROW['post_id']?>" style="text-decoration:none; color:#999"><?php echo $likes?>Like</a> 

    <!--Comments-->
    <?php
        $comments = "";
        //  echo "here";die;
        if($ROW['comments'] > 0){
            
            $comments = "(" . $ROW['comments']. ")";
        }

    ?>
    <a href="single_post.php?id=<?php echo $ROW['post_id']?>" style="text-decoration:none; color:#999"> <?php echo $comments?>Comment</a>
  
</div>
<div>
     <!---Delete and edit-->
     <?php
            
            $post = new Post();

            if($post->i_own_post($ROW['post_id'],$_SESSION['heypal_userid'])){

                echo"
                    <a class='float-right ' href='delete.php?id=$ROW[post_id]'  style='text-decoration:none; color:#999;'> Delete </a>  
                    <a class='float-right ' href='edit.php?id=$ROW[post_id]'  style='text-decoration:none;  color:#999;'> Edit </a> 
                    ";  
            }

            ?> 
    <!--Only show this part when the post is owned by the user-->

</div>
</div>


<?php //Likes

    $i_liked = false;

    if(isset($_SESSION['heypal_userid'])){

            $DB = new Database();

            $sql = "select likes from likes where type='post' && content_id = '$ROW[post_id] limit 1"; // increment likes column by one
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

    if($ROW['likes'] > 0){ //if likes is greater than zero
       
        echo "<a href = 'likes.php?type=post&id=$ROW[post_id]' style='text-decoration:none;  color:#999;'>";

        if($ROW['likes'] == 1){ //if there's only one like

            if($i_liked){ //you liked the post
                echo "<div style='text-align:left; color:#999;'>You liked this post. </div>";
            }else{ //another person liked the post
                echo "<div style='  text-align:left;'> 1 person liked this post.</div>";
            }
           
        }else{

            if($i_liked){

                $text = "others";
                if($ROW['likes'] - 1 == 1){
                    $TEXT="other";
                }
                echo "<div style='text-align:left;'> You and " . ($ROW['likes'] -1) . " text liked this post. </div>";
            }else{
                echo "<div style='text-align:left;'>" . $ROW['likes'] . " people liked this post. </div>";
            }
            
        }

        echo "</a>";

    }     

?>


</div>

 



<?php //viewing full page
    if($ROW['has_image']){
        echo " <a href = 'image_view.php?id=$ROW[post_id]' style='text-decoration:none; color:#999;'>";
        echo " View Full Image ";
        echo "</a>";
    }
?>
   
        
</div>
<br/>
</div>


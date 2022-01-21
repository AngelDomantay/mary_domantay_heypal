<!--for posting on profile-->
<div>

    <div> 
        <?php
            $image = "images/user_female.jpg"; //image is female by default

            if($ROW['gender'] == 'Male'){ //if gender is equal to male
                $image =  "images/user_male.jpg"; //print image
               
            }
           
            $image_class = new Image(); //instantiatie Image class
            //if user has profile image then display image
            //if file exists regardless of what data is in there
            if(file_exists($user_data['profile_image'])){ //originally it should supposed to be $row instead of $user_data
              
                $image = $image_class->get_thumb_profile($user_data['profile_image']);
               
            } 
           
        ?>
        <img src = <?php echo $image?> style ="width: 5%; height:5%;"> <!--print user image-->
        
    <div>
      
      
     <?php 
             echo htmlspecialchars($ROW['first_name']) . " " . htmlspecialchars($ROW['last_name']);

             if($ROW['is_profile_image']){ //if it's equal to one or true

                $pronoun = "his";
                if($ROW['gender'] == "Female"){

                    $pronoun = "her";
                    echo "<span style = 'font-weight:normal; color:#aaa;'> has updated $pronoun profile image. </span>" ;
                } 
             }

             if($ROW['is_cover_image']){ //if it's equal to one or true

                $pronoun = "his";
                if($ROW['gender'] == "Female"){

                    $pronoun = "her";
                    echo "<span style = 'font-weight:normal; color:#aaa;'> has updated $pronoun cover image. </span>" ;
                } 
             }
        
        ?>

        <br>
        <!--Html escaping for security - treat values in post column db as normal texts and not code or special characters-->
        <?php  echo htmlspecialchars($ROW['post']) ?><!--print post sentence-->
        <br>
    
        <!--post image--->
        <?php  if(file_exists($ROW['image'])){

            $post_image = $image_class->get_thumb_post($ROW['image']);
            echo " <img src = '$post_image' style = 'width:50%; height:500px;'>";
        }?>
    
    
    </div>

</div>
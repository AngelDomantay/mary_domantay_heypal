


<div class="row pt-5 pb-5 px-4" style="display:block; text-align:center; background:#1B1E21; color:#999; ">
    <?php

        $DB = new Database();

        //selectn all from posts table where has_image = 1, and it belongs to the current user, order by descendeing limit content tup tp 30
        $query = "select image, post_id from posts where has_image = 1 && user_id = $user_data[user_id] order by id desc limit 30";
        $images = $DB->read($query);

        $image_class = new Image();

        //to make sure if result is returned
        if(is_array($images)){ //if there's an array withing an array

            //loop through it
            foreach($images as $image_row){

                echo "<a href = 'single_post.php?id=$image_row[post_id]'>";
                echo "<img src = ' " . $image_class->get_thumb_post($image_row['image']) . " ' style = 'width:25%; padding:4px; border-radius:5%;'>";
                echo "</a>";
            }
         
        }else{//f there's no array

            echo "No images were found.";
        }

    ?>
</div>

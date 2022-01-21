<?php

class Image {

    public function generate_filename($length){

        $array = array(0,1,2,3,4,5,6,7,8,9,
        'a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');

        $text = ""; //set to empty

        for($x = 0; $x < $length; $x++){ //everytime it loops, generate a random num or char
            $random = rand(0,61); //rand function plus the total num of element in array
            $text = $array[$random];
        }

        return $text;
    }

    public function crop_image($original_file_name,$cropped_file_name,$max_width,$max_height){
  
        //first resize image to the wanted pixels

        if(file_exists($original_file_name)){

            $original_image = imagecreatefromjpeg($original_file_name); //create an image resource for original file
            //image resource - put image inside computer memory so each pixels can be accessed

            $original_width = imagesx($original_image); //getting orgiinal width of resource
            $original_height = imagesy($original_image); //getting orgiinal width of resource

            if($original_height > $original_width){// if height is greater than width...

                //make width equal to max width; whatever side is taller will be cut
                $ratio = $max_width / $original_width; //reduction ratio

                $new_width = $max_width;
                $new_height = $original_height * $ratio;

            }else{ //when width is greater

                //reduction ratio = divide max height by original height
                $ratio = $max_height / $original_height; 

                $new_height = $max_height;
                $new_width = $original_width * $ratio; //new width = original width multiplied by ratio
            }
        }

   
        if($max_width != $max_height){ //adjust incase max width and height are different

            if($max_height > $max_width){ //if max height is greater than max width
                
                if($max_height > $new_height){  //if max height is greater than new height

                    $adjustment = ($max_height / $new_height); //adjustment = max height divided by new height
                }else{

                    $adjustment = ($new_height / $max_height); //adjustment = new height divided by max height
                }

                $new_width = $new_width * $adjustment; //new width = product of new width and adjustment
                $new_height = $new_height * $adjustment; //new height = product of new height and adjustment

            }else{//if max height is less than max width
                
                    if($max_width> $new_width){ //if max width is greater than new width

                         $adjustment = ($max_width / $new_width ); //adjustment = quotient of max width and new width

                    }else{ //if max width is less than new width

                         $adjustment = ($new_width  / $max_width ); //adjustment = quotient of new width and max width
                     }

                $new_width = $new_width * $adjustment; //new width = product of new width and adjustment
                $new_height = $new_height * $adjustment; //new height = product of new height and adjustment
                /* }*/
                
                
           }
        }

        //resize image 
        $new_image = imagecreatetruecolor($new_width, $new_height); //create new resource
        imagecopyresampled($new_image, $original_image, 0, 0, 0, 0, $new_width, $new_height, $original_width, $original_height);
        //imagecopyresampled(dst_image, src_image, dst_x, dst_y, src_x, src_y, dst_w, dst_h, src_w, src_h);

        imagedestroy($original_image); //destroy image resource to limit amount of memory used

        if($max_width != $max_height){ //for images width diff height and width measurements

            if($max_width > $max_height) {

                $diff = ($new_height - $max_height);
                
                if($diff < 0){ //means value is negative
                    $diff = $diff * -1; //multiply it by negative one to make it positive
                }
                $y = round($diff / 2); 
                $x = 0; 

            }else{ 
                
                $diff = ($new_width - $max_height);

                if($diff < 0){ //means value is negative
                    $diff = $diff * -1; //multiply it by negative one to make it positive
                }
                $x = round($diff / 2); 
                $y = 0; 
            }

        }else{ //for square images

            if($new_height > $new_width) { //if new height is greater than new width

                $diff = ($new_height - $new_width);
                $y = round($diff / 2); //y axis value is equal to the rounded quotient of diff divided by 2
                $x = 0; //don't change anything in width

            }else{ //if width is bigger
                $diff = ($new_width - $new_height);
                $x = round($diff / 2); //x axis value is equal to the rounded quotient of diff divided by 2
                $y = 0; //don't change anything in width
            }
         }
        $new_cropped_image = imagecreatetruecolor($max_width, $max_height); //supplied by the user
        imagecopyresampled($new_cropped_image, $new_image, 0, 0, $x, $y, $max_width, $max_height, $max_width, $max_height);

        imagedestroy($new_image); //destroy the source image

        imagejpeg($new_cropped_image, $cropped_file_name,90);  //save image here

        imagedestroy($new_cropped_image); //destroy image since it's already saved in cropped_file_name
    }

    //resize the image
    public function resize_image($original_file_name,$resized_file_name,$max_width,$max_height){ //Iadded new with here not sure if it's alright
  
        //first resize image to the wanted pixels

        if(file_exists($original_file_name)){

            $original_image = imagecreatefromjpeg($original_file_name); //create an image resource for original file
            //image resource - put image inside computer memory so each pixels can be accessed

            $original_width = imagesx($original_image); //getting original width of resource
            $original_height = imagesy($original_image); //getting original width of resource

            if($original_height > $original_width){// if height is greater than width...

                //make width equal to max width; whatever side is taller will be cut
                $ratio = $max_width / $original_width; //reduction ratio

                $new_width = $max_width;
                $new_height = $original_height * $ratio;

            }else{ //when width is greater

                $ratio = $max_height / $original_height; //reduction ratio

                $new_height = $max_height;
                $new_width = $original_width * $ratio;
            }
        }

        //adjust incase max width and height are different
        if($max_width != $max_height){

            if($max_height > $new_height){
                
                if($max_height > $max_width){

                    $adjustment = ($max_height / $new_height);
                }else{

                    $adjustment = ($new_height / $max_height);
                }

                $new_width = $new_width * $adjustment;
                $new_height = $new_height * $adjustment;

            }else{
    
                if($max_width > $new_width){
                
                    if($max_height > $new_height){

                         $adjustment = ($max_width / $new_width );

                    }else{

                         $adjustment = ($new_width  / $max_width );
                     }

                $new_width = $new_width * $adjustment;
                $new_height = $new_height * $adjustment;
                 } 
           }
        }

        //resize image 
        $new_image = imagecreatetruecolor($new_width, $new_height); //create new resource
        imagecopyresampled($new_image, $original_image, 0, 0, 0, 0, $new_width, $new_height, $original_width, $original_height);
        //imagecopyresampled(dst_image, src_image, dst_x, dst_y, src_x, src_y, dst_w, dst_h, src_w, src_h);

        imagedestroy($original_image); //destroy image resource to limit amount of memory used

        imagejpeg($new_image, $resized_file_name,90);  //save image here

        imagedestroy($new_image); //destroy image since it's already saved in cropped_file_name
    }

    //create thumbnail for cover image
    public function get_thumb_cover($filename){

        $thumbnail = $filename . "_cover_thumb.jpg"; //add extended file name

        if(file_exists($thumbnail)){
            return $thumbnail;
        }

        $this->crop_image($filename,$thumbnail,1366,488); //us this-> - calling a function in the same class

        if(file_exists($thumbnail)){

            return $thumbnail;
        }else{
            return $filename;
        }
    }

     //create thumbnail for profile image
     public function get_thumb_profile($filename){

        $thumbnail = $filename . "_profile_thumb.jpg"; //add extended file name

        if(file_exists($thumbnail)){
            return $thumbnail;
        }

        $this->crop_image($filename,$thumbnail,600,600); //us this-> - calling a function in the same class

        if(file_exists($thumbnail)){

            return $thumbnail;
        }else{
            return $filename;
        }
    }

     //create thumbnail for post image
     public function get_thumb_post($filename){

        $thumbnail = $filename . "_post_thumb.jpg"; //add extended file name

        if(file_exists($thumbnail)){
            return $thumbnail;
        }

        $this->crop_image($filename,$thumbnail,600,600); //us this-> - calling a function in the same class

        if(file_exists($thumbnail)){

            return $thumbnail;
        }else{
            return $filename;
        }
    }
}
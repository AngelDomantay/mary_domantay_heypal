


<div class="container py-5"  style="text-align:center; background:#2e3032;">

      <!--For posting-->
      <form method="post" enctype="multipart/form-data">
            <!--multipart form is important-->
           
            <br>
        
    <?php

      $settings_class = new Settings();

      $settings = $settings_class->get_settings($_SESSION['heypal_userid']);

      if(is_array($settings)){

            echo "<h3 style='color:#999; font-size:1em; text-align:left;'>First Name </h3> ";
            echo "<input type = 'text' id='textbox' name='f_name' value='".htmlspecialchars($settings['f_name'])."' placeholder='First Name' style='background:#3e4144; color:white;'/>";

            echo "<h3 style='color:#999; font-size:1em; text-align:left; padding-top:1em;'>Last Name </h3> ";
            echo "<input type = 'text' id='textbox' name='l_name'   value='".htmlspecialchars($settings['l_name'])."' placeholder='Last Name' style='background:#3e4144; color:white;' />";
    
         
            echo "<h3 style='color:#999; font-size:1em; text-align:left; padding-top:1em;'>Gender </h3> ";
            echo "<select id = 'textbox' name ='email'  style='background:#3e4144; color:white;'>
    
                <option>".htmlspecialchars($settings['gender'])."</option>
                <option>Male</option>
                <option>Female</option>
    
                </select>";
      
            echo "<input type = 'text' id='textbox' name='email' placeholder='Email Address'  value='".htmlspecialchars($settings['email'])."'  style='background:#3e4144; color:white; margin-top:1em;' />";
            echo "<input type = 'password' id='textbox' name='password' placeholder='Password' value='".htmlspecialchars($settings['password'])."'  style='background:#3e4144; color:white; margin-top:1em;' />" . "<br>";
            echo "<input type = 'password' id='textbox' name='password2' placeholder='Password' value='".htmlspecialchars($settings['password'])."'  style='background:#3e4144; color:white; margin-top:1em;' />";

            echo "<br> <h3 style='color:#999; font-size:1em; text-align:left;'>About me: </h3> 
                     <textarea name='about' class='form-control form-control-lg' placeholder='What do you like to share about yourself?'  style='background:#3e4144; color:white;'>".htmlspecialchars($settings['about'])."</textarea>
                    ";
            echo  '</br>' . '<input class="btn btn-block px-5" id="post_button" type="submit" value="Post" style="background:#FF9340; color:white;">';
        }

    ?>

    </form>

</div>
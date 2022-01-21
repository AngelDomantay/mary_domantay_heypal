


<div class="container"  style="text-align:center;  background:#1B1E21; color:white;">

      <!--For posting-->
      <form method="post" enctype="multipart/form-data">
            <!--multipart form is important-->
           
            <br>
        
    <?php

      $settings_class = new Settings();

      $settings = $settings_class->get_settings($user_data['user_id']);

      if(is_array($settings)){
           
            echo "<br> <h1 style ='color:grey;'> About Me </h1><br>
                     <div class='form-control form-control-lg' placeholder='What do you like to share about yourself?' style = ' background:#1B1E21; color:white;'>".htmlspecialchars($settings['about'])."</div>
                    ";
           
        }

    ?>

    </form>

</div>
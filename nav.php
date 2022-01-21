<?php include 'bootstrap.php'; ?>

<?php 
      $corner_image = "images/user_female.jpg"; //display female placebholder
      if(isset($USER)){
        
        if(file_exists($USER['profile_image'])){

          $image_class = new Image();
          $corner_image = $image_class->get_thumb_profile($USER['profile_image']);
       
         }else{

            if($USER['gender'] == "Male"){ //if user is male
              $corner_image = "images/user_male.jpg"; //display male placeholder
            }
         }
      }
?>
   <style>

      li{
        padding-right:1.5em;
      }


    </style>
<link rel="stylesheet" href="style_home.css">

<style>

  h3{
    color:white;
  }
  h3:hover{
    color:black;
  }

</style>
<nav class="navbar navbar-expand-lg sticky-top navbar-light " style="background-color:#FF9340">
  <div class="container-fluid px-5" style="justify-content:left;  background-color:#FF9340">
    <a class="navbar-brand" href="index.php" style=" margin-right:1.5em; ">HeyPal</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
   
    <div class="collapse navbar-collapse "  id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <a href = "profile.php">  <img src = "<?php echo $corner_image?>" style ="width: 40px; border-radius:50%; margin-right:1.5em;"></a>
      
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="profile.php">Profile</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
           Settings
          </a>
          
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown" style="background:#3D4144;">
              <li><a class="dropdown-item" href="profile.php?section=photos&id=<?php echo $user_data['user_id'] ?>"><h3>My Photos</h3></a></li>
             <?php
               if ($user_data['user_id'] == $_SESSION['heypal_userid']) {
                 echo '<li><a class="dropdown-item" href="profile.php?section=settings&id=' . $user_data['user_id'] . '"><h3>Edit Profile<h3></a></li>';
               }
             ?>
              
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="logout.php"><h3>Logout</h3></a></li>
              <a >
          </ul>
        </li> 
      </ul>
      <!--Search Feature-->
      <form method = "get" action="search.php" class="d-flex"> <!--Memory locatio nis find can be similar to modal?-->
        <input class="form-control me-2" type="search" placeholder="Search for people" aria-label="Search" name="find">
        <button class="btn btn-outline-dark" type="submit" >Search</button>
      </form>
    </div>
  </div>
</nav>
  

<?php include 'bootstrap.php';?>
<?php
	include("classes/db2.php");
	include("classes/signup.php");

		//placeholders = empty by default
		//once user accidentally hit the submit button while still filling the other holders, values are retained
		$f_name = "";
		$l_name = "";
		$gender = "";
		$email = "";
	
	if($_SERVER['REQUEST_METHOD']=='POST') {//global post with array
	
		$signup = new Signup();	//instantiate sign up class
		$result = $signup->evaluate($_POST); //access evaluate function (with passed data) from signup class

		if($result != ""){ //if result is not empty
			echo "<div style ='text-align:center; font-size:12px;color:white;background-color:grey;'>";
			echo "The following errors occured <br> ";
			echo $result; //print the error
			echo "</div>";
			
		}else{ //it it's empty
			
			header("Location:login_page.php");//redirect to next page (placed before the HTML part)
			die; //end here
		}

	}
	$f_name = "";
	$l_name = "";
	$gender ="";
	$email = "";

?>

<!DOCTYPE html>
<html>
<link rel="stylesheet" href="style_reg.css"/>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap" rel="stylesheet">
<!--Fontawesomecdn-->
<script src="https://kit.fontawesome.com/aa15d9fa9e.js" crossorigin="anonymous"></script>
<head><title>Sign Up</title></head>

<style>
*{
	margin:0;
	padding:0;
}
h2{
	font-size:12px;
}

body{
	margin:0;
	padding:0;
}
i{
    color: rgba(0,0,0,0.5);
	transition: 0.5s;
	padding: 0 5px;
	user-select:none;
	cursor: default;
}

i:hover{
    color:orangered;
    text-shadow:0 0 120px orangered;
}

.box{
	position: relative;
	width: 100%;
	height: 100vh;
	background:#111;
	display:flex;
	flex-direction: column;
	overflow: hidden;
	background: linear-gradient(rgb(32,32,32),rgb(32,32,32));
	color:white;
}
.con1 {
	position: relative;
	top:-55%;
	width:100%;
	display:flex;
	padding: 10px 0;
	white-space: nowrap;
	font-size: 65px;
	transform:rotate(-30deg);
}
.con2 {
	position: relative;
	top:-55%;
	width:100%;
	display:flex;
	padding: 10px 0;
	white-space: nowrap;
	font-size: 65px;
	transform:rotate(-30deg);
}

.con1 > div {

	animation: animate1 80s linear infinite;
	animation-delay: -80s;
}
.con2 > div {

	animation: animate2 80s linear infinite;
	animation-delay: -40s;
}

@keyframes animate1{

	0%{
		transform: translatex(100%);
	}

	100%{
		transform: translatex(-100%);
	}
}

@keyframes animate2{

	0%{
		transform: translatex(0%);
	}

	100%{
		transform: translatex(-200%);
	}
}

.con1 > div {

	animation: animate3 80s linear infinite;
	animation-delay: -80s;
}
.con2 > div {

	animation: animate4 80s linear infinite;
	animation-delay: -40s;
}

@keyframes animate3{

	0%{
		transform: translatex(-100%);
	}

	100%{
		transform: translatex(100%);
	}
}

@keyframes animate4{

	0%{
		transform: translatex(-200%);
	}

	100%{
		transform: translatex(0%);
	}
}
</style>
  <body>
	  	<div class = "container-fluid">
		  <div class="row">
				<div class="col-md-6 col-sm-12 m-0 p-0">
						<div class = "box">
								<div class = "con1">
								<div> <?php include 'icons.php'?> <!--call file containing fontawesome icons--></div>	
								</div>
								<div class = "con2">
									<div> <?php include 'icons.php'?> <!--call file containing fontawesome icons--></div>	
								</div>
								<div class = "con1">
									<div> <?php include 'icons.php'?> <!--call file containing fontawesome icons--></div>	
								</div>
								<div class = "con2">
									<div> <?php include 'icons.php'?> <!--call file containing fontawesome icons--></div>	
								</div>
								<div class = "con1">
									<div> <?php include 'icons.php'?> <!--call file containing fontawesome icons--></div>	
								</div>
								<div class = "con2">
									<div> <?php include 'icons.php'?> <!--call file containing fontawesome icons--></div>	
								</div>
								<div class = "con1">
									<div> <?php include 'icons.php'?> <!--call file containing fontawesome icons--></div>	
								</div>
								<div class = "con2">
									<div> <?php include 'icons.php'?> <!--call file containing fontawesome icons--></div>	
								</div>
								<div class = "con1">
									<div> <?php include 'icons.php'?> <!--call file containing fontawesome icons--></div>	
								</div>
								<div class = "con2">
									<div> <?php include 'icons.php'?> <!--call file containing fontawesome icons--></div>	
								</div>
								<div class = "con1">
									<div> <?php include 'icons.php'?> <!--call file containing fontawesome icons--></div>	
								</div>
								<div class = "con2">
									<div> <?php include 'icons.php'?> <!--call file containing fontawesome icons--></div>	
								</div>
								<div class = "con1">
									<div> <?php include 'icons.php'?> <!--call file containing fontawesome icons--></div>	
								</div>
								<div class = "con2">
									<div> <?php include 'icons.php'?> <!--call file containing fontawesome icons--></div>	
								</div>
								<div class = "con1">
									<div> <?php include 'icons.php'?> <!--call file containing fontawesome icons--></div>	
								</div>
								<div class = "con2">
									<div> <?php include 'icons.php'?> <!--call file containing fontawesome icons--></div>	
								</div>
								<div class = "con1">
									<div> <?php include 'icons.php'?> <!--call file containing fontawesome icons--></div>	
								</div>
								<div class = "con2">
									<div> <?php include 'icons.php'?> <!--call file containing fontawesome icons--></div>	
								</div>
								<div class = "con1">
									<div> <?php include 'icons.php'?> <!--call file containing fontawesome icons--></div>	
								</div>
						</div>
						</div>
				<div class="col-md-6 col-sm-12 px-5 m-0">
					<div class ="container px-5 py-3 card">  
						<h1>Sign Up</h1>
						<form method="post" action=""> <!--action - in the same page-->
							<h2>First name:</h2>
							<input value="<?php echo $f_name?>" type="text" id ="text" placeholder="First name" name="f_name" required class='form-control mb-4' />
						
							<h2>Last name:</h2>
							<input value="<?php echo $l_name?>"type="text" id ="text" placeholder="Last name" name="l_name"  required class='form-control mb-4' />

							<h2>Gender</h2>
							<select id ="text" name="gender" required class='form-control mb-4'> 
								<option><?php echo $gender?></option>
								<option>Male</option>
								<option>Female</option>
							</select>
							<!--required class='form-control mb-4'-->
							<h2>Email Id:</h2>
							<input value="<?php echo $email?>" type="email" id="text" placeholder="Email" name="email" required class='form-control mb-4' />
					
							<h2>Password:</h2>
							<input type="password" id="text" placeholder="Password" name="password" required class='form-control mb-4'/>
							
							<h2>Confirm Password:</h2>
							<input type="password" id="text" placeholder="Confirm password" name="password2"  required class='form-control mb-4'/>
							
							<input type="submit" id ="button" class="btn btn-secondary btn-lg btn-block w-100 mt-4;" style="background-color:orangered; border:none;" name="save" value="Submit">
						</form>
						<a href="login_page.php">Login</a>
					</div>
				</div>
		  	</div>
		</div>
  </body>
</html>
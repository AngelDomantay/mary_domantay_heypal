
<?php include 'bootstrap.php';?>
<?php


session_start(); //starts session
	include("classes/db2.php"); //connects to database
	include("classes/login.php"); //signup page

		//placeholders = empty by default
		//once user accidentally hit the submit button while still filling the other holders, values are retained
		
		//$email = $_POST['email'];
	    //$password = $_POST['password'];

		
		$email = "";
	 	$password = "";
	
	if($_SERVER['REQUEST_METHOD']=='POST') {//global post with array
	
		$login = new Login();	//instantiate login calss 
		$result = $login->evaluate($_POST); //access evaluate function (with passed data) from signup class

		if($result != ""){ //if result is not empty
			echo "<div style ='text-align:center; font-size:12px;color:white;background-color:grey;'>";
			echo "The following errors occured <br> ";
			echo $result; //print the error
			echo "</div>";
			
		}else{ //it it's empty
			
			header("Location:index.php");//redirect to home page (placed before the HTML part)
			die; //end here
		}

	}

	$email = "";
	$password = "";

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="login.css">
	<!--Fontawesomecdn-->
	<script src="https://kit.fontawesome.com/aa15d9fa9e.js" crossorigin="anonymous"></script>
	<title>Login</title>
</head>
<style>
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

.grid-1{
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
.row1 {
	position: relative;
	top:-55%;
	width:100%;
	display:flex;
	padding: 10px 0;
	white-space: nowrap;
	font-size: 65px;
	transform:rotate(-30deg);
}
.row {
	position: relative;
	top:-55%;
	width:100%;
	display:flex;
	padding: 10px 0;
	white-space: nowrap;
	font-size: 65px;
	transform:rotate(-30deg);
}

.row1 > div {

	animation: animate1 80s linear infinite;
	animation-delay: -80s;
}
.row > div {

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

.row1 > div {

	animation: animate3 80s linear infinite;
	animation-delay: -80s;
}
.row2 > div {

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

	<div class="grid-box">
		<div class="grid-1">	
			<div class = "row1">
				<div> <?php include 'icons.php'?> <!--call file containing fontawesome icons--></div>	
			</div>
			<div class = "row">
				<div> <?php include 'icons.php'?> <!--call file containing fontawesome icons--></div>	
			</div>
			<div class = "row1">
				<div> <?php include 'icons.php'?> <!--call file containing fontawesome icons--></div>	
			</div>
			<div class = "row">
				<div> <?php include 'icons.php'?> <!--call file containing fontawesome icons--></div>	
			</div>
			<div class = "row1">
				<div> <?php include 'icons.php'?> <!--call file containing fontawesome icons--></div>	
			</div>
			<div class = "row">
				<div> <?php include 'icons.php'?> <!--call file containing fontawesome icons--></div>	
			</div>
			<div class = "row1">
				<div> <?php include 'icons.php'?> <!--call file containing fontawesome icons--></div>	
			</div>
			<div class = "row">
				<div> <?php include 'icons.php'?> <!--call file containing fontawesome icons--></div>	
			</div>
			<div class = "row1">
				<div> <?php include 'icons.php'?> <!--call file containing fontawesome icons--></div>	
			</div>
			<div class = "row">
				<div> <?php include 'icons.php'?> <!--call file containing fontawesome icons--></div>	
			</div>
			<div class = "row1">
				<div> <?php include 'icons.php'?> <!--call file containing fontawesome icons--></div>	
			</div>
			<div class = "row">
				<div> <?php include 'icons.php'?> <!--call file containing fontawesome icons--></div>	
			</div>
			<div class = "row1">
				<div> <?php include 'icons.php'?> <!--call file containing fontawesome icons--></div>	
			</div>
			<div class = "row">
				<div> <?php include 'icons.php'?> <!--call file containing fontawesome icons--></div>	
			</div>
			<div class = "row1">
				<div> <?php include 'icons.php'?> <!--call file containing fontawesome icons--></div>	
			</div>
			<div class = "row">
				<div> <?php include 'icons.php'?> <!--call file containing fontawesome icons--></div>	
			</div>
			<div class = "row1">
				<div> <?php include 'icons.php'?> <!--call file containing fontawesome icons--></div>	
			</div>
			<div class = "row">
				<div> <?php include 'icons.php'?> <!--call file containing fontawesome icons--></div>	
			</div>
			<div class = "row1">
				<div> <?php include 'icons.php'?> <!--call file containing fontawesome icons--></div>	
			</div>
		</div>
	
		<div class="card grid-2">

			<div class="card-body">
				<h2 class="pb-2 pt-4" style="font-weight:700;">HeyPal</h2>
				<h6 style="margin-bottom:3em; font-size:14px; color: grey; font-weight:300;">Welcome back! Please login to your account.</h6>
				<form method="post" action="">

					<div class="form-group mb-4">
						<label for="email">Email Address:</label>
						<input  name="email" value = "<?php echo $email?>" type="email" id='email' class='form-control' required /> 
					</div>

					<div class="form-group mb-4">
						<label for="password">Password:</label>
						<input value = "<?php echo $password?>" type="password" name="password" id='password' class='form-control' required />
					</div>

					<input type="submit" class="btn btn-secondary btn-lg btn-block w-100 mt-4;" style="background-color:orangered; border:none;" name="save" value="Submit">
					
				
				</form>
				<div class="mt-4">	
					<h6 style="display:inline;"><a href="reg.php" style="text-align:left">Sign Up</a>
					<a href="changepw.php" style="float:right">Change Password</a>	</h6>
				</div>
			
			</div>

		</div>
	</div>

</body>

</html>

<?php include 'bootstrap.php'; ?>
<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="login.css">
	<title>Login</title>
</head>

<body>

	<div class="grid-box">
		<div class="grid-1">
			<h1>Hey, Pal.</h1>
		</div>

		<div class="card grid-2">

			<div class="card-body">
				<h2 class="mb-4" style="font-weight:700;">Login</h2>
				<h6 style="margin-bottom:3em; font-size:14px; color: grey; font-weight:300;">Welcome back! Please login to your account.</h6>
				<form method="post" action="login_code.php">

					<div class="form-group mb-4">
						<label for="email">Email Address:</label>
						<input type="email" name="email" id='email' class='form-control' required />
					</div>

					<div class="form-group mb-4">
						<label for="password">Password:</label>
						<input type="password" name="password" id='password' class='form-control' required />
					</div>

					<input type="submit" class="btn btn-secondary btn-lg btn-block w-100 mt-4;" name="save" value="Submit">
					
					<label>
						<input type="checkbox" name="remember"> Remember me
					</label>
				</form>

				<a href="reg.php">Sign Up</a>
				<a href="changepw.php">Forgot Password</a>
			</div>

		</div>
	</div>
</body>

</html>
<?php
session_start();

if(isset($_SESSION['user'])){

	header('location:home.php');

}



?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?= ucfirst(basename($_SERVER['PHP_SELF'], '.php'));?> | TyaraApp</title>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css" integrity="sha512-9BwLAVqqt6oFdXohPLuNHxhx36BVj5uGSGmizkmGkgl3uMSgNalKc/smum+GJU/TTP0jy0+ruwC3xNAk3F759A==" crossorigin="anonymous" />
	<link rel="stylesheet" type="text/css" href="themes/css/style.css">
</head>
<body>


	<div class="container">

		<!--Start Login Page-->

		<div class="row justify-content-center wrapper" id="login-box">
			<div class="col-lg-10 my-auto">
				<div class="card-group myShadow">
					<div class="card rounded-left p-4" style="flex-grow:1.4;">
						<h1 class="text-center font-weight-bold text-primary">Sign In</h1>
						<hr class="my-3">
						<form action="#" method="POST" class="px-3" id="login-form">
							<div id="loginAlert"></div>
							<div class="input-group input-group-lg form-group">
								<div class="input-group-prepend">
									<span class="input-group-text rounded-0">
										<i class="far fa-envelope fa-lg"></i>
									</span>
								</div>
								<input type="email" name="email" id="email" class="form-control rounded-0" placeholder="E-Mail" required="required"
								value="<?php if(isset($_COOKIE['email'])){ echo $_COOKIE['email'];} ?>">
							</div>

							<div class="input-group input-group-lg form-group">
								<div class="input-group-prepend">
									<span class="input-group-text rounded-0">
										<i class="fas fa-key fa-lg"></i>
									</span>
								</div>
								<input type="password" name="password" id="password" class="form-control rounded-0" placeholder="Password" required="required" 
								value="<?php if(isset($_COOKIE['password'])){ echo $_COOKIE['password'];} ?>">
							</div>

							<div class="form-group">

								<div class="custom-control cust-checkbox float-left">
									<input type="checkbox" name="rem" class="custom-control-input" id="customCheck"
									<?php if(isset($_COOKIE['email'])){ echo "checked";} ?> >
									<label for="customCheck" class="custom-control-label">Remember Me</label>
								</div>

								<div class="forgot float-right">
									<a href="#" id="forgot-link">Forgot Password</a>
								</div>
								<div class="clearfix"></div>
							</div>

							<div class="form-group">	
								<input type="submit" value="Sign In" id="login-btn" class="btn btn-primary btn-lg btn-block myBtn">
							</div>
						</form>
					</div>
					<div class="card justify-content-center rounded-right myColor p-4">
						<h1 class="text-center font-weight-bold text-white"> Hello Friends!</h1>
						<hr class="my-3 bg-light myHr">
						<p class="text-center font-weight-bolder text-light lead"> Enter Your Personal Details And Start Your Journey Wtih Us</p>
						<button class="btn btn-outline-light btn-lg align-self-center font-weight-bolder mt-4 myLinkBtn" id="register-link"> Sign Up</button>
					</div>
				</div>
			</div>

		</div>


		<!-- End Login Page-->

		<!-- Start Signup Page-->

		<div class="row justify-content-center wrapper" id="register-box" style="display: none;">
			<div class="col-lg-10 my-auto">
				<div class="card-group myShadow">

					<div class="card justify-content-center rounded-left myColor p-4">
						<h1 class="text-center font-weight-bold text-white"> Welcome Back!</h1>
						<hr class="my-3 bg-light myHr">
						<p class="text-center font-weight-bolder text-light lead"> To Keep Connected With Us Please Login With Your Personal info.</p>
						<button class="btn btn-outline-light btn-lg align-self-center font-weight-bolder mt-4 myLinkBtn" id="login-link"> Sign In</button>
					</div>

					<div class="card rounded-right p-4" style="flex-grow:1.4;">
						<h1 class="text-center font-weight-bold text-primary">Create Account</h1>
						<hr class="my-3">
						<form action="#" method="POST" class="px-3" id="register-form">
							<div id="regAlert"></div>
							<div class="input-group input-group-lg form-group">
								<div class="input-group-prepend">
									<span class="input-group-text rounded-0">
										<i class="far fa-user fa-lg"></i>
									</span>
								</div>
								<input type="text" name="name" id="name" class="form-control rounded-0" placeholder="Full Name" required="required">
							</div>

							<div class="input-group input-group-lg form-group">
								<div class="input-group-prepend">
									<span class="input-group-text rounded-0">
										<i class="far fa-envelope fa-lg"></i>
									</span>
								</div>
								<input type="email" name="email" id="remail" class="form-control rounded-0" placeholder="E-Mail" required="required">
							</div>

							<div class="input-group input-group-lg form-group">
								<div class="input-group-prepend">
									<span class="input-group-text rounded-0">
										<i class="fas fa-key fa-lg"></i>
									</span>
								</div>
								<input type="password" name="password" id="rpassword" class="form-control rounded-0" placeholder="Password" required="required" minlength="5">
							</div>

							<div class="input-group input-group-lg form-group">
								<div class="input-group-prepend">
									<span class="input-group-text rounded-0">
										<i class="fas fa-key fa-lg"></i>
									</span>
								</div>
								<input type="password" name="cpassword" id="cpassword" class="form-control rounded-0" placeholder="Confirm Password" required="required" minlength="5">
							</div>
							<div class="form-group">
								<div id="passError" class="text-danger font-weight-bold"></div>
							</div>


							<div class="form-group">	
								<input type="submit" value="Sign Up" id="register-btn" class="btn btn-primary btn-lg btn-block myBtn">
							</div>
						</form>
					</div>

				</div>
			</div>

		</div>


		<!-- End Signup Page-->

		<!-- Start Forgot password Page-->

		<div class="row justify-content-center wrapper" id="forgot-box" style="display: none;">
			<div class="col-lg-10 my-auto">
				<div class="card-group myShadow">

					<div class="card justify-content-center rounded-left myColor p-4">
						<h1 class="text-center font-weight-bold text-white"> Reset Password</h1>
						<hr class="my-3 bg-light myHr">

						<button class="btn btn-outline-light btn-lg align-self-center font-weight-bolder mt-4 myLinkBtn" id="back-link"> Back </button>
					</div>

					<div class="card rounded-right p-4" style="flex-grow:1.4;">
						<h1 class="text-center font-weight-bold text-primary">Forgot Your Password</h1>
						<hr class="my-3">
						<p class="lead text-center text-secondary"> To reset your password,enter the registered e-mail adress and you will recieve a reset message!</p>
						<form action="#" method="POST" class="px-3" id="forgot-form">
							<div id="forgotAlert" ></div>
							<div class="input-group input-group-lg form-group">
								<div class="input-group-prepend">
									<span class="input-group-text rounded-0">
										<i class="far fa-envelope fa-lg"></i>
									</span>
								</div>
								<input type="email" name="email" id="femail" class="form-control rounded-0" placeholder="E-Mail" required="required">
							</div>




							<div class="form-group">	
								<input type="submit" value="Reset Password" id="forgot-btn" class="btn btn-primary btn-lg btn-block myBtn">
							</div>
						</form>
					</div>

				</div>
			</div>

		</div>




		<!-- End Forgot password Page-->
		<?php

		require_once('./includes/templates/footer.php');

		?>
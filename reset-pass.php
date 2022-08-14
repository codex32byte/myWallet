<?php
require_once('includes/templates/header.php'); 
require_once('themes/php/auth.php'); 

$user = new Auth();	
$mssg = '';
if(isset($_GET['email'])&& isset($_GET['token'])){

	$email = $user->test_input($_GET['email']);
	$token = $user->test_input($_GET['token']);

	$auth_user = $user->reset_pass_auth($email,$token);

	if($auth_user != null){

		if(isset($_POST['submit'])){

			$newpass = $_POST['pass'];
			$cnewpass = $_POST['cpass'];

			$hnewpass = password_hash($newpass, PASSWORD_DEFAULT);

			if($newpass == $cnewpass ){

				$user->update_new_pass($hnewpass,$email);

				$mssg = 'Passwrod Changed Success! <br> <a href="index.php">Login Here! </a>';


			}else{

				$mssg = 'Password Didnt Matched !';
			}


		}


	}else{
		
		
		header('location:index.php');
		exit();
	}

}else{
	
	header('location:index.php');
	exit();

}


?>

<div class="container">

	<!--Start Login Page-->

	<div class="row justify-content-center wrapper">
		<div class="col-lg-10 my-auto">
			<div class="card-group myShadow">

				<div class="card justify-content-center rounded-left myColor p-4">
					<h1 class="text-center font-weight-bold text-white"> Reset Your Password Here!</h1>
					
				</div>

				<div class="card rounded-right p-4" style="flex-grow:2;">
					<h1 class="text-center font-weight-bold text-primary">Enter New Password!</h1>
					<hr class="my-3">
					<form action="#" method="POST" class="px-3">
						<div class="text-center lead mb-2"><?php echo $mssg; ?></div>


						<div class="input-group input-group-lg form-group">
							<div class="input-group-prepend">
								<span class="input-group-text rounded-0">
									<i class="fas fa-key fa-lg"></i>
								</span>
							</div>
							<input type="password" name="pass" class="form-control rounded-0" placeholder="New Password" required="required" minlength="5">
						</div>


						<div class="input-group input-group-lg form-group">
							<div class="input-group-prepend">
								<span class="input-group-text rounded-0">
									<i class="fas fa-key fa-lg"></i>
								</span>
							</div>
							<input type="password" name="cpass" class="form-control rounded-0" placeholder="Confirm New Password" required="required" minlength="5">
						</div>



						<div class="form-group">	
							<input type="submit" value="Reset Password" name="submit" class="btn btn-primary btn-lg btn-block myBtn">
						</div>
					</form>
				</div>
				
			</div>
		</div>

	</div>































	<?php
	
	require_once('./includes/templates/footer.php');

	?>
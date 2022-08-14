<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';


$mail = new PHPMailer(true);


require_once 'auth.php';

$user = new Auth();

// Register Page
if(isset($_POST['action']) && $_POST['action'] == 'register'){
	// filtering inputs
	$name = $user->test_input($_POST['name']);
	$email = $user->test_input($_POST['email']);
	$pass = $user->test_input($_POST['password']);
	
	$hpass  = password_hash($pass, PASSWORD_DEFAULT);

	if($user->user_exist($email)){
		echo $user->showMessage('warning','This E-Mail is Already Registered!');


	}else{

		if($user->register($name,$email,$hpass)){
			echo 'register';
			$_SESSION['user'] = $email;

		}else{

			echo $user->showMessage('danger','Something Went wrong! try again later!!');
		}
	}

}

/// Login Page


if(isset($_POST['action']) && $_POST['action'] == 'login'){

	$email =  $user->test_input($_POST['email']);
	$pass = $user->test_input($_POST['password']);

	$LoggedInUser = $user->login($email);

	if ($LoggedInUser !=null ){




		if(password_verify($pass,  $LoggedInUser['password']) ){

			if(!empty($_POST['rem'])){

				setcookie("email",$email,time()+(30*24*60*60), '/');
				setcookie("password",$pass,time()+(30*24*60*60), '/');

			}else{

				setcookie("email","",1, '/');
				setcookie("password","",1, '/');


			}


			echo 'login';

			$_SESSION['user'] = $email;






		}else{ ## if password is wronng


			echo $user->showMessage('danger','Email / Passswrod is Incorrect1');




		}





	}else{ ## if email deleted or not found 

		echo $user->showMessage('danger','Email / Passswrod is Incorrect2');



	}



}

/// forgot Page


if(isset($_POST['action']) && $_POST['action'] == 'forgot'){

	$email = $user->test_input($_POST['email']);

	$user_found = $user->currentUser($email);


	if($user_found != null ){

		$token = uniqid();

		$token = str_shuffle($token);


		$user->forgot_password($token,$email);

		echo '<h3>Click The Below Link to reset your password <br><a href="http://localhost/user-system/reset-pass.php?email='.$email.
		'&token='.$token.' ">http://localhost/user-system/reset-pass.php?email='.$email.
		'&token='.$token.'</a><br>Regards<br>TyaraApp!</h3>';

		/*try {
		    //Server settings

		    $mail->isSMTP();                                            //Send using SMTP
		    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
		    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
		    $mail->Username   = 'mmmymailer@gmail.com';                    //SMTP username
		    $mail->Password   = 'gmailpassword';                               //SMTP password
		    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
		    $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

		    //Recipients
		    $mail->setFrom('mmmymailer@gmail.com', 'bb');
		    $mail->addAddress($email);     //Add a recipient

		    

		    //Content
		    $mail->isHTML(true);                                  //Set email format to HTML
		    $mail->Subject = 'Reset Password';
		    $mail->Body    = '<h3>Click The Below Link to reset your password <br><a href="http://localhost/user-system/reset-pass.php?email='.$email.
		    '&token='.$token.' ">http://localhost/user-system/reset-pass.php?email='.$email.
		    '&token='.$token.'</a><br>Regards<br>TyaraApp!</h3>';


		    $mail->send();
		    echo $user->showMessage('success','We Have Send You the reset link in your email, please check your e-mail!');
		} catch (Exception $e) {
			echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
		}


*/
	}else{
		echo $user->showMessage('danger','This Email is not registered!');
	}


}

?>
<?php
	include_once 'includes/db_connection.php';
	include_once 'includes/functions.php';
	 
	sec_session_start();

	$result = new stdClass();
	$result->false;		
	if (isset( $_POST['address'],$_POST['captcha_code'])){
		if (login_check($mysqli) == true){
			include_once 'securimage/securimage.php';
			$securimage = new Securimage();
			if ($securimage->check($_POST['captcha_code']) == false){
				$result->error = "The security code entered was incorrect. Try Again.";
			}
			else{
				

				require_once("mail/class.phpmailer.php");
			        $mail = new PHPMailer();
				$mail->IsSMTP();
				$mail->SMTPAuth = true;
				$mail->Host = 'smtp.gmail.com';
				$mail->Port = 465;
				$mail->SMTPSecure = 'ssl';
				$mail->Username = ADMINEMAIL;
				$body = "User_id: {$_SESSION['user_id']}\nAddress: {$_POST['address']}";
				$mail->SetFrom('rousojohn@gmail.com', "Eshop-User-{$_SESSIO['user_id']}");
				$mail->AddAddress(ADMINEMAIL, "");
				$mail->Subject = "New Order";
				$mail->MsgHTML($body);

				// Set the password
				$mail->Password = ADMINEMAILPASS;
				if (!$mail->Send()){
					$result->success = false;
					$result->error =  $mail->ErrorInfo;
				}
				else{
					$result->success = true;
					$result->msg = "Order Sent";
				}
			}
		}
		else{
			$result->error = "You are not authorized to confirm an order. Please Login first.";
		}
	}
	else{
		$result->error = "Invalid Request.";
	}
	echo json_encode($result);
	exit;
?>

<?php
	include_once 'includes/db_connection.php';
	include_once 'includes/functions.php';


	sec_session_start(); // Our custom secure way of starting a PHP session.

$result = new stdClass();
	

	if(isset($_SESSION['user_id'], $_POST['product_id'])){
		if ($stmt = $mysqli->prepare("insert into pendin_carts (`user_id`,`product_id`) values (?,?)")){
			//var_dump("asdasd");
			$stmt->bind_param('ii',$_SESSION['user_id'], $_POST['product_id']);
			 // Execute the prepared query.
			if (! $stmt->execute()){
				$result->success = false;
				$result->error = "Error adding product to cart";
			}
			else
				$result->success = true;
		}
	}
	else{
		$result->success = false;
		$result->error = "Invalid Request";
	}
	echo json_encode($result);
?>

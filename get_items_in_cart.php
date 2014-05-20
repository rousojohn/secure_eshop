<?php
	include_once 'includes/db_connection.php';
	include_once 'includes/functions.php';


	sec_session_start(); // Our custom secure way of starting a PHP session.

	$result = new stdClass();

	if (isset($_SESSION['user_id'])){
		if ($stmt=$mysqli->prepare("select p.id, p.descr, count(p.id) as qty, round(count(p.id) * p.price,2) as price
					from products as p
					inner join pendin_carts as c on p.id = c.product_id
					where c.user_id = ?
					group by p.id")){
			$stmt->bind_param('i', $_SESSION['user_id']);
			if (!$stmt->execute()){
				$result->success = false;
				$result->error = "Error retrieving cart list.";
				echo json_encode($result);
			}
			else{
				$result->success = true;
				$stmt->bind_result($product_id, $descr, $qty, $price);
				$count = 0;
				$result->html="";
				$result->rows = array();
				while($stmt->fetch()){
					$count += $price;
					$result->html .= "<p class='list-group-item list-group-item-info product'><span><bold>" .htmlentities($qty) .
					"</bold></span>&nbsp;&nbsp;". htmlentities($descr) ."<span class='badge'>" . htmlentities($price) . "&nbsp;&euro;</span></p>";
					$tmp = new stdClass();
					$tmp->descr = htmlentities($descr);
					$tmp->price = htmlentities($price);
					$tmp->qty = htmlentities($qty);
					array_push($result->rows, $tmp);
				}
				$result->total = $count;
			}	
		}
	}
	else{
		$result->success = false;
		$result->error = "Invalid Request";
	}
	
	echo json_encode($result);
?>

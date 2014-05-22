<?php
	include_once 'includes/db_connection.php';
	include_once 'includes/functions.php';

	sec_session_start(); // Our custom secure way of starting a PHP session.
if (isset($_GET['searchTerm'], $_SESSION['user_id'])){
	$result = array();
		if ($stmt = $mysqli->prepare("select p.id,p.descr, ROUND(p.`price`,2) as `price`, count(c.product_id) as qty
						from products as p
						left join pendin_carts as c on p.id=c.product_id and c.user_id=?
						where UPPER(p.descr) like UPPER(?)
						group by p.id")){

			// Bind "$user_id" to parameter. 
			$term = "%{$_GET['searchTerm']}%";
			$stmt->bind_param('is', $_SESSION['user_id'], $term);
			$stmt->execute();   // Execute the prepared query.
			$stmt->bind_result($product_id, $desc, $price, $qty);
			//$count = 0;
			while($stmt->fetch()){
				//$count += $qty;
				array_push($result,"<a href='#' class='list-group-item list-group-item-info product' product_id='" .htmlentities($product_id) . "'>" . htmlentities($desc) ." - | - ". htmlentities($price) . " <span class='glyphicon glyphicon-euro'></span> <span class='badge'>" . htmlentities($qty) . "</span></a>");
			}
			//array_push($result, $count);
		}
		else{
			array_push($result,"<div class='alert alert-danger alert-dismissable'>
		  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
			<p>Error. Could not retrieve data.</p>
		</div>");
		}
		if ($stmt = $mysqli->prepare("select count(`id`) from `pendin_carts` where `user_id`=?")){
			$stmt->bind_param('i', $_SESSION['user_id']);
			$stmt->execute();
			$stmt->bind_result($count);
			$stmt->fetch();
			array_push($result, $count);
		}
		else{
			array_push($result,"<div class='alert alert-danger alert-dismissable'>
		  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
			<p>Error. Could not retrieve data.</p>
		</div>");
		}
}
else{
array_push($result,"<div class='alert alert-danger alert-dismissable'>
  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
	<p>Error. Invalid Request.</p>
</div>");
}
	
		echo json_encode($result);


?>

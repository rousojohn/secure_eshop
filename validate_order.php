<?php
	include_once 'includes/db_connection.php';
	include_once 'includes/functions.php';
	 
	sec_session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Secure Login: Validation Page</title>
<link rel="stylesheet" href="css/bootstrap.min.css" />
	<script src="js/jquery-1.11.0.min.js" ></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/validatePage.js"></script>
    </head>
    <body>

        <?php if (login_check($mysqli) == true) : ?>
	<div class="well well-lg">
		<h3>Order will be delivered to: <span class="label label-default"><?php echo htmlentities($_GET['address']); ?></span></h3>
	</div>
	<div class="table-responsive">
		<table class="table table-condensed table-hover table-striped">
			<thead>
				<tr>
					<th>#</th>
					<th>Description</th>
					<th>Quantity</th>
					<th>Price <span class="glyphicon glyphicon-euro"></span></th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>

		<div class="panel panel-default">
			<div class="panel-body">
				<img id="captcha" src="securimage/securimage_show.php" alt="CAPTCHA Image" />
				<input type="text" name="captcha_code" id="captcha_code" size="10" maxlength="6" />
				<a id="captchaChange" href="#">[ Different Image ]</a>

				<button id="confirmBtn" type="button" class="btn btn-primary">Confirm</button>&nbsp;&nbsp;
			</div>
		</div>

	</div>
	 <?php else : ?>
		<div class="alert alert-danger alert-dismissable">
		  <button id="dismissBtn" type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<p id="errorText">You are not authorized to access this page. Please Login</p>
		</div>
        <?php endif; ?>


<!--/* END OF PRODUCT LIST */ -->


    </body>
</html>

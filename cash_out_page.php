<?php
	include_once 'includes/db_connection.php';
	include_once 'includes/functions.php';
	 
	sec_session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Secure Login: Cash Out Page</title>
<link rel="stylesheet" href="css/bootstrap.min.css" />
	<script src="js/jquery-1.11.0.min.js" ></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/cashOut.js"></script>
    </head>
    <body>

<?php if (login_check($mysqli) == true) : ?>
<!--/* items in cart */-->
	<div class="list-group"></div>
	
<!--/* end of list */-->
	<div class="alert alert-warning">
		<p>Total Cost: <span id="total"><bold></bold></span></p>
	</div>

	<div class="container">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<div class="form-inline" ccept-charset="UTF-8" role="form" autocomplete="on">
					<div class="form-group">
						<label class="sr-only" for="address">Address</label>
						<input type="text" class="form-control" id="address" placeholder="Enter Address" />
					</div>
					<a id="submitBtn" class="btn btn-default" data-toggle="modal" data-target="#modal">Order</a>
				</div>
			</div>
		</div>
	</div>
<!--

form gia address
submit / cancel button 
onSubmit -> modal page gia confirmation (captcha???)



-->
<?php else : ?>
	<div class="alert alert-danger alert-dismissable">
	  <button id="dismissBtn" type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<p>You are not authorized to access this page. Please Login</p>
	</div>
<?php endif; ?>
	<div id="modal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content"></div>
		</div>
	</div>
    </body>
</html>

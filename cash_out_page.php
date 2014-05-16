<?php
	include_once 'includes/db_connection.php';
	include_once 'includes/functions.php';
	 
	sec_session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Secure Login: Protected Page</title>
<link rel="stylesheet" href="css/bootstrap.min.css" />
	<script src="js/jquery-1.11.0.min.js" ></script>
	<script src="js/bootstrap.min.js"></script>
    </head>
    <body>

<?php if (login_check($mysqli) == true) : ?>
<!--

div gia lista 
ajax gia data listas

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
	<div id="modal" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-sm">
			<div class="modal-content"></div>
		</div>
	</div>
    </body>
</html>

<?php
	include_once 'includes/db_connection.php';
	include_once 'includes/functions.php';
	 
	sec_session_start();
	 
	if (login_check($mysqli) == true) {
	    $logged = 'in';
	} else {
	    $logged = 'out';
	}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Secure Login: Log In</title>
        <link rel="stylesheet" href="css/bootstrap.min.css" />
	<script src="js/jquery-1.11.0.min.js" ></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/sha512.js"></script>
	<script src="js/myScript.js"></script>
    </head>
    <body>
        <?php
        if (isset($_GET['error'])) {
	?>
	<div class="alert alert-danger alert-dismissable">
	  <button id="dismissBtn" type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<p>Error Logging In!</p>
	</div>
	<?php
        }
        ?> 
	<div class="container">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Welcome
							<span id="loading" class="glyphicon glyphicon-refresh hidden pull-right"></span>
						</h3>
					</div>
					<div class="panel-body">
						<form id="loginForm" name="loginForm" accept-charset="UTF-8" role="form" autocomplete="on" action="includes/login.php" method="post">
							<fieldset>
								<div class="form-group">
									<input class="form-control" placeholder="Username" id="username" name="username" type="text" />
								</div>
								<div class="form-group">
									<input class="form-control" placeholder="Password" id="password" name="password" type="password" />
								</div>
								<input class="btn btn-lg btn-success btn-block" type="button" value="Login" id="submitBtn" />
							</fieldset>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
    </body>
</html>

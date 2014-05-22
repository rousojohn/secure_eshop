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
	<script src="js/listProductsScript.js"></script>
    </head>
    <body>

        <?php if (login_check($mysqli) == true) : ?>
<!--/* NAVBAR WITH SEARCH */-->
	<nav class="navbar navbar-default" role="navigation">
	  <div class="container-fluid">
	    <!-- Brand and toggle get grouped for better mobile display -->
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
		<span class="sr-only">Toggle navigation</span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
	      </button>
	      <p class="navbar-brand" >Secure Eshop</a>
	    </div>

	    <!-- Collect the nav links, forms, and other content for toggling -->
	    
	      <div class="navbar-form navbar-left" role="search">
		<div class="form-group">
		  <input id="searchTxt" type="text" class="form-control" placeholder="Search">
		</div>
		<button id="submitBtn" class="btn btn-default">Search</button>
	      </div>
	      <ul class="nav navbar-nav navbar-right">
		<li class="dropdown">
		  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo htmlentities($_SESSION['username']); ?> <b class="caret"></b></a>
		  <ul class="dropdown-menu">
		    <li><a href="cash_out_page.php"  id="cashOutLnk">Cash Out</a></li>
		    <li class="divider"></li>
		    <li><a href="#" id="logoutLnk">Logout</a></li>
		  </ul>
		</li>
	      </ul>
	    </div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
	</nav>
<!--/* END OF NAVBAR */-->
	<div class="well">
		<p>Results for search of term: <span class="label label-default"></span></p>
	</div>
<!--/* PRODUCT LIST */ -->
		<div class="list-group"></div>
<div id="modal" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-sm">
			<div class="modal-content"></div>
		</div>
	</div>
<!--/* SOMETHING LIKE FOOTER (SHOWING TOTAL ITEMS IN CART) */-->
	<div class="alert alert-success">
		<p><span id="totalItems"><bold></bold></span> items have been added to your cart.</p>
	</div>
<!-- /* END OF FOOTER */-->
        <?php else : ?>
		<div class="alert alert-danger alert-dismissable">
		  <button id="dismissBtn" type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<p id="errorText">You are not authorized to access this page. Please Login</p>
		</div>
        <?php endif; ?>


<!--/* END OF PRODUCT LIST */ -->


    </body>
</html>

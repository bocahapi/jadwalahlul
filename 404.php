<?php
include 'functions.php';
?>
<!DOCTYPE html>
<html>
	<head>
	<title>404 Not Found</title>
	<meta name="viewport" content="width=device-width">
	<link rel="stylesheet" href="<?php echo $css;?>main-login.css"/>
	<script type="text/javascript" src="<?php echo $js;?>jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo $js;?>modernizr.js"></script>
	<script type="text/javascript" src="<?php echo $js;?>bootstrap.min.js"></script>
	</head>
<body class="bg-page not-found">
<div class="container">
	<div class="row">
		<div class="col-md-12 not-found-content">
			<h1 class="title-not-found" >404 Error !!!</h1>
			<hr/>
			 <small><b><i>Halaman yang anda minta</i></b></small>	 Tidak Ada !!!
			<hr/>
			<p>
				<a href="<?php echo $BASE_URL;?>" class="btn btn-primary"> Go Back</a>
			</p>
		</div>
	</div>
</div>
</body>
</html>
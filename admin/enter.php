<?php
require_once('connectdb.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="robots" content="index, follow" />
<meta name="description" content="Aplikasi Untuk Perancangan Jadwal Terpadu UMS Sesuai Dengan Request Dosen." />
<meta name="copyright" content="Copyright 2014. Universitas Muhammadiyah Surakarta. All Rights Reserved." />
	<title>Halaman Login Aplikasi</title>
		<link rel="shortcut icon" href="/includes/img/favicon.ico" type="image/icon" />
	<meta name="viewport" content="width=device-width">
	<link rel="stylesheet" href="<?php echo $css;?>main-login.css"/>
	<script type="text/javascript" src="<?php echo $jquery_script;?>"></script>
	<script type="text/javascript" src="<?php echo $js;?>modernizr.js"></script>
	<script type="text/javascript" src="<?php echo $js;?>bootstrap.min.js"></script>
	</head>

<body class="bg-login">
<div class="back">
	<div class="error">
	<h1>Sedang Error</h1>
	</div>
</div>

	<div class="form-login">
		<div class="row">
			<div class="formlogin col-xs-12 col-md-12">
			<h1 class="title"><div class="logo"></div></h1>
			<div id="alert"></div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12 col-md-12">
				<form  role="form" >
						<div class="form-group">
								<input type="text" name="username" id="username" class="form-control" placeholder="Username">
						</div>
				
					<div class="form-group">
						<input type="password" class="form-control" name="password" id="password" placeholder="Password">
					</div>
				
					 <button class="btn btn-danger info " id="login" type="submit"><i class="fa fa-chevron-circle-right"></i> Login
					 </button>
					<div class="btn btn-warning info pull-right" data-toggle="modal" data-target="#myModal"><i class="fa fa-question-circle"></i> Informasi</div>
				</form>
			</div>
			<div class="col-xs-12 col-md-12 copyright">Developed by <a href="http://java.co.id">Ahlul Aryana Aji</a></div>
			</div>
		
	</div>

<script type="text/javascript" src="<?php echo $js;?>validations.js"></script>
<script type="text/javascript">
$('#myModal').modal();
</script>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Informasi</h4>
      </div>
       <div class="modal-body">
       <?php $helps = mysqli_query($conn,"select * from help,users where help.id_user=users.id_user order by help.id_help DESC"); 
	   while($help = mysqli_fetch_array($helps)){
			
			echo '<h3>'.$help['judul'].'  <small>'.$help['nama'].'</small></h3>';
			echo $help['help'].'<br/>';
			echo '<div class="line"></div>';
	   
	   }
	   
	   ?>
      </div>
    </div>
  </div>
</div>

</body>
</html>
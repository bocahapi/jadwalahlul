<?php
require_once('navbar.php');
?>
<!DOCTYPE html>
<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="robots" content="index, follow" />
<meta name="description" content="Aplikasi Untuk Perancangan Jadwal Terpadu UMS Sesuai Dengan Request Dosen." />
<meta name="copyright" content="Copyright 2014. Universitas Muhammadiyah Surakarta. All Rights Reserved." />
	<title>Aplikasi Perancangan Jadwal Dosen</title>
	<link rel="shortcut icon" href="/includes/img/favicon.ico" type="image/icon" />
	<meta name="viewport" content="width=device-width">
	<!--<meta http-equiv="refresh" content = "900; url=<?php echo $BASE_URL;?>logout.php?action=true">-->
	<link rel="stylesheet" href="<?php echo $css;?>main-site.css"/>
	<link rel="stylesheet" href="<?php echo $css;?>bootstrap-multiselect.css" type="text/css"/>
	<script type="text/javascript" src="<?php echo $jquery_script;?>"></script>
	<script type="text/javascript" src="<?php echo $js;?>modernizr.js"></script>
	<script type="text/javascript" src="<?php echo $js;?>bootstrap.min.js"></script>
	<script src="<?php echo $js;?>live-search.js"></script>
	<script src="<?php echo $js;?>checking.js"></script>
	<script type="text/javascript" src="<?php echo $js;?>insert.js"></script>
	<script type="text/javascript" src="<?php echo $js;?>bootstrap-multiselect.js"></script>


	</head>
<body class="bg-page">	
<script type="text/javascript" src="<?php echo $js;?>tinymce/tinymce.min.js"></script>
<script type="text/javascript">
tinymce.init({
    selector: "#addhelp"
 });
</script>
<!--- Modal Pop Up-->
<div class="modal fade" id="help" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Informasi</h4>
      </div>
      <div class="modal-body">
       <?php $helps = mysqli_query($conn,"select * from help,users where help.id_user=users.id_user order by help.id_help DESC limit 1"); 
	   while($help = mysqli_fetch_array($helps)){
			
			echo '<h3>'.$help['judul'].'</h3>';
			echo $help['help'].'<br/>';
			echo '<div class="line"></div>';
	   
	   }
	   
	   ?>
      </div>

    </div>
  </div>
</div>
<!--- Modal Pop Up -->

	<div class="col-md-12 header-site">

				<div class="container">
					<div class="header-inner">
						<div class="logo-site pull-left"></div>
						<div class="session-user pull-right">
						<ul class="session-list">
							<li><a href="#" title="Informasi" data-toggle="modal" data-target="#help"><i class="fa fa-question-circle fa-lg"></i></a></li>
							<li><?php echo 'Selamat Datang, '.$nameUser ;?></li>
							<li><a href='../logout.php?action=true' title="Keluar"><i class="fa fa-power-off fa-lg"></i> </a></li>
						</ul>
							 
					</div>
				</div>
	</div>
</div>
<script type="text/javascript">
$(function(){
$("a[title='Informasi']").click(function(){
	$('#help').modal();
	});
});
</script>
	
<div class="container">
	



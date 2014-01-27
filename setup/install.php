<?php
if(!isset($_POST['url']) || !isset($_GET['step'])){
exit;
}else{
$var = $_GET['step'];
$url = $_POST['url'];
?>
<html>
	<head>
	<title>:: Welcome To Step <?php echo $var;?>::</title>
	<meta name="viewport" content="width=device-width">
	<link rel="stylesheet" href="../includes/css/main-site.css"/>
	</head>
<body>


	<div class="container">
		<div class="center-block step-1">
			<form role="form" action="install.php?step=<?php echo $var+1;?>" method="post">
			  <div class="form-group">
			    <label for="">Host Name</label>
			    <input type="hidden" class="form-control"name="url" value="<?php echo $url ;?>"/>
			    <input type="text" class="form-control" name="host" placeholder="localhost">
			  </div>
			  <div class="form-group">
			    <label for="">Database</label>
			    <input type="text" class="form-control" name="database" placeholder="Database">
			  </div>
			 <div class="form-group">
			    <label for="">Username</label>
			    <input type="text" class="form-control" name="user" placeholder="Username">
			  </div>
			  <div class="form-group">
			    <label for="">Password</label>
			    <input type="text" class="form-control" name="pass" placeholder="Password">
			  </div>
			  
			  <button type="submit" name="next" class="btn btn-danger">Lanjutkan</button>
			</form>
		</div>
	</div>



</body>
</html>
<?php } 

if($_GET['step'] == 2 && isset($_POST['next'])){

$Data = '<?php

$BASE_URL ="'.$_POST['url'].'";
$include = $BASE_URL."includes/";
$css=$include."css/";
$js=$include."js/";
$jquery_script =$js."jquery.min.js";

$host ="'.$_POST['host'].'";
$username ="'.$_POST['user'].'";
$pass ="'.$_POST['pass'].'";
$database ="'.$_POST['database'].'";

?>'; 



 $File = "../functions.php"; 
 $Handle = fopen($File, 'w');
 

	fwrite($Handle, $Data); 
 fclose($Handle); 
header('location:finish.php?step=finishing');

}else{
//header('location:../');
}

?>
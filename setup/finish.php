<?php
if(!isset($_GET['step'])){
exit;
}else{
$var = $_GET['step'];
if($var=='finishing'){
require_once('../connectdb.php');
?>
<html>
	<head>
	<title>:: Welcome The <?php echo $var;?> Step::</title>
	<meta name="viewport" content="width=device-width">
	<link rel="stylesheet" href="../includes/css/main-site.css"/>
	</head>
<body>


	<div class="container">
		<div class="center-block step-1">
			<form role="form" action="" method="post">
			 <div class="form-group">
			    <label for="">Nama</label>
			    <input type="text" class="form-control" name="name" placeholder="Nama">
			  </div> <div class="form-group">
			    <label for="">Username</label>
			    <input type="text" class="form-control" name="user" placeholder="Username">
			  </div>
			  <div class="form-group">
			    <label for="">Password</label>
			    <input type="password" class="form-control" name="passone" placeholder="Password">
			  </div> 
			  <div class="form-group">
			    <label for="">Repeat Password</label>
			    <input type="password" class="form-control" name="passtwo" placeholder="Password">
			  </div>
			  
			  <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
			</form>
		</div>
	</div>



</body>
</html>
<?php
}else{
exit;
}
}
if(isset($_POST['simpan'])){
$name = $_POST['name'];
$username = $_POST['user'];
$passone = $_POST['passone'];
$passtwo = $_POST['passtwo'];

	if($passone == $passtwo){
	
		$pass_en = md5($passone);
		
		$ins = mysqli_query($conn,"INSERT INTO users (nama,username,password,id_status,id_level) values ('$name','$username','$pass_en',1,1) ");
		
		if(!$ins){
		
			echo '<h3>Error Establishing</h3>';
			exit;
		}else{
		header('location:../');
		}
	
	}

}

?>
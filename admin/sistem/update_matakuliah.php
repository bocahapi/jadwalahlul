<?php
require_once('../../connectdb.php');

if(!isset($_POST['id_matkul']) || $_POST['id_matkul']== ""){
exit;
} else {

$id_matkul=$_POST['id_matkul'];
$semester=$_POST['semester'];
$matkul_kode=$_POST['matkul_kode'];
$matkul=$_POST['matkul'];
$sksnew=$_POST['sksnew'];
$tipenew=$_POST['tipenew'];

$updates = mysqli_query($conn,"Update  matkul Set semester='$semester', nama_matkul = '$matkul',kode_matkul='$matkul_kode',sks='$sksnew',type='$tipenew' Where id_matkul='$id_matkul' ");

	if(!$updates){
		
		echo "error";
	exit;
	}else{

	echo '<div class="alert alert-success">Update Sukses</div>';
	
	}

}?>
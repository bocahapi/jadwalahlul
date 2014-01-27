<?php
require_once('../../connectdb.php');

if(!isset($_POST['id_dosen']) || $_POST['id_dosen']== ""){
exit;
} else {
$id_dosen = $_POST['id_dosen'];
$nidn = $_POST['nidn'];
$nama = $_POST['nama_dosen'];
$status_dosen = $_POST['status_dosen'];
$updates = mysqli_query($conn,"UPDATE  users SET NIDN='$nidn', nama='$nama', id_status='$status_dosen'	Where id_user='$id_dosen' ");


if(!$updates){
	
	echo "error";

}else{
	
	echo '<div class="alert alert-success">Update Sukses</div>';
	}

}
?>
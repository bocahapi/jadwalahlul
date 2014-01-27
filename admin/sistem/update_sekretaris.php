<?php
require_once('../../connectdb.php');

if(!isset($_POST['id_dosen']) || $_POST['id_dosen']== ""){
exit;
} else {

$id_dosen = $_POST['id_dosen'];
$id_sek = $_POST['id_sek'];

$updates = mysqli_query($conn,"Update  sekretaris Set id_user = '$id_dosen' Where id_sekretaris='$id_sek' ");

if(!$updates){
	
	echo "error";
	
	}else{
	
		echo '<div class="alert alert-success">Update Sukses</div>';
	
	}
}

?>
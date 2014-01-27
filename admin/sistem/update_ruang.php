<?php
require_once('../../connectdb.php');

if(!isset($_POST['id_ruang']) || $_POST['id_ruang']== ""){
exit;
} else {

$id_ruang = $_POST['id_ruang'];
$ruangan = $_POST['ruangan'];



$updates = mysqli_query($conn,"Update  ruangan Set nama_ruang = '$ruangan' Where id_ruang='$id_ruang' ");


if(!$updates){
	
	echo "error";

}else{
	
		echo '<div class="alert alert-success">Update Sukses</div>';
	
	}
}
?>
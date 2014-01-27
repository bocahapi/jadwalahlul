<?php
require_once('../../connectdb.php');

if(!isset($_POST['id_fak']) || $_POST['id_fak']== ""){
exit;
} else {

$id_fak = $_POST['id_fak'];
$id_jur = $_POST['id_jur'];
$nama_fak = $_POST['fakultas'];
$nama_jur = $_POST['jurusan'];


$updates = mysqli_query($conn,"Update  jurusan Set nama_jurusan = '$nama_jur' Where id_jur='$id_jur' ");
$update = mysqli_query($conn,"Update  fakultas Set nama_fakultas = '$nama_fak' Where id_fak='$id_fak' ");

if(!$updates){
	
	echo "error";

}else if (!$update){

		echo "error II";

	}else{
	
		echo '<div class="alert alert-success">Update Sukses</div>';
	
	}
}
?>
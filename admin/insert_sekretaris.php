<?php
require_once('../connectdb.php');
if(isset($_POST['fakultas']) || isset($_POST['jurusan']) || isset($_POST['dosen'])) {

$fakultas = $_POST['fakultas'];
$jurusan = $_POST['jurusan'];
$dosen = $_POST['dosen'];
	
	$check = mysqli_query($conn,"SELECT * From sekretaris Where id_fak='$fakultas' &&  id_user = '$dosen' ");

		$thishave = mysqli_num_rows($check);
		if($thishave >= 1 ){
		
		echo "User telah jadi Sekretaris";
		exit;
		}
	
	$query = mysqli_query($conn,"INSERT INTO sekretaris (id_fak, id_jur, id_user) VALUES ('$fakultas','$jurusan','$dosen') ");
	
	if(!$query){
		header('location:../admin/dashboard.php?page=sekertaris&notif=input_error');
	}else{
		
		mysqli_query($conn,"Update users Set id_level='3' Where id_user = '$dosen' " );
		header('location:../admin/dashboard.php?page=sekertaris&notif=input_sukses');
	}
	
}else{

header('location:../admin/dashboard.php?page=sekertaris');

}
?>
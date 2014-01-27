<?php
session_start();
if(isset($_SESSION['sesi'])){
  $session = $_SESSION['sesi'];
}
include('../../connectdb.php');
if(isset($_POST['action'])){

	$upd = $_POST['action'];
	$id  = $_POST['opsi'];
	$count = count($id);
	if($upd == 'hapus'){
		for ($i=0; $i < $count ; $i++) { 
			
			$delete = mysqli_query($conn,"DELETE FROM matkul WHERE id_matkul='".$id[$i]."' ");
		}
		if($delete ){
		echo 'true';
			}else{
				echo 'error';
			}
	}else{
		for ($i=0; $i < $count ; $i++) { 
			$update = mysqli_query($conn, "UPDATE matkul SET session = '$upd' WHERE id_matkul='".$id[$i]."' ");
		}
		if( $update ){
				echo 'true';
			}else{
				echo 'error';
			}
	}
	
}else{
	require_once('../../404.php');
}
?>
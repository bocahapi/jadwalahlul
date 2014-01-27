<?php
if(isset($_GET['action'])){
require_once('../../connectdb.php');
$idpost = $_GET['idpost'];
$title = $_GET['titlehelp'];
$isi = $_GET['help'];

$update = mysqli_query($conn,"Update help set judul = '$title', help = '$isi' where id_help = '$idpost' ");

	if(!$update){
		echo "error update";
		exit;
	}else{
		header('location:../dashboard.php?page=help');
	}
}
?>
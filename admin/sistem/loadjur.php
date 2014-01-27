<?php
session_start();
if(isset($_SESSION['sesi'])){
  $session = $_SESSION['sesi'];
}
include('../../connectdb.php');
if(isset($_POST['jurusan'])){
	$id_jur = $_POST['jurusan'];
	

	$sql   = "SELECT * FROM matkul WHERE id_jur = '$id_jur' AND status='on' AND session = '$session' ";
	$query = mysqli_query($conn,$sql);
	echo '<option value="">Pilih Mata Kuliah</option>';
	while($mat = mysqli_fetch_array($query)){
		echo '<option value="'.$mat['id_matkul'].'">'.$mat['semester'].' - '.$mat['nama_matkul'].'</option>';
	}
}else{
	
	require_once('../../404.php');
}
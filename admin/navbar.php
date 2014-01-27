<?php
session_start();
require_once('../connectdb.php');
function kutip($kalimat, $jumlah_kata=10){
 $arr_str = explode(' ', $kalimat);
 $arr_str = array_slice($arr_str, 0, $jumlah_kata );
 return implode(' ', $arr_str);
}

define('Akses', true);
	//check session
	if(!isset($_SESSION['username']) || !isset($_SESSION['password'])){
	
	// Back To Page Login
	
	header('location:.././');
	
	}else{

		#autoload to check stock of matkul
		require_once('../aload.php');

		#require_once('../functions.php');
		$IDUser = $_SESSION['id_user'];

		$Sql = "SELECT * FROM users,user WHERE users.id_level=user.id_level AND users.id_user='$IDUser'";

		$Query = mysqli_query($conn,$Sql);

		$userdata = mysqli_fetch_array($Query);

		$nameUser = $userdata['nama'];
		$jabatan = $userdata['level'];
	function the_title($jabatan){
		
		if($jabatan != 'Administrator' || $jabatan != 'Sekjur'){
		
			echo  $_SESSION['nama'];
		
		}else{
			
			echo $_SESSION['level_user'];
			
		}
	
	}

	/*
	* Link Navigasi 
	*/

	/* Navigasi Untuk Dosen */
	if ( $jabatan  == 'Dosen'){
		$nav = array( array('menu' => 'Profil Dosen',
							'url' => 'dashboard.php?page=profile'
							),
					array(	'menu' => 'Informasi Jadwal',
							'url' => 'dashboard.php?page=jadwal'
							),
					
					array(	'menu' => 'Keluar',
							'url' => '../logout.php?action=true'
							),
		);
		}else if ( $jabatan == 'Administrator'){ // Navigasi untuk Administrator / superadmin
		$nav = array( array('menu' => 'Fakultas dan Jurusan',
							'url' => 'dashboard.php?page=fakultas'
							),
					array(	'menu' => 'Tambah Dosen',
							'url' => 'dashboard.php?page=dosen'
							),
					array(	'menu' => 'Pilih Sekretaris',
							'url' => 'dashboard.php?page=sekertaris'
							),
					array(	'menu' => 'Atur Waktu',
							'url' => 'dashboard.php?page=settwaktu'
							),
					array(	'menu' => 'Tambah Ruang',
							'url' => 'dashboard.php?page=ruang'
							),
					array(	'menu' => 'Tambah Mata kuliah',
							'url' => 'dashboard.php?page=matakuliah'
							),
					array(	'menu' => 'Informasi',
							'url' => 'dashboard.php?page=help'
							),
					array(	'menu' => 'Keluar',
							'url' => '../logout.php?action=true'
							),
		);
		}else if ( $jabatan == 'Sekjur'){ // Navigasi Untuk Sekretaris
		$nav = array( array('menu' => 'Profil Dosen',
							'url' => 'dashboard.php?page=profile'
							),
					array(	'menu' => 'Tambah Dosen',
							'url' => 'dashboard.php?page=dosen'
							),
					array(	'menu' => 'Tambah Ruang',
							'url' => 'dashboard.php?page=ruang'
							),
					array(	'menu' => 'Tambah Mata kuliah',
							'url' => 'dashboard.php?page=matakuliah'
							),
					array(	'menu' => 'Atur Mata kuliah',
							'url' => 'dashboard.php?page=aturmatkul'
							),		
					array(	'menu' => ' Informasi Jadwal',
							'url' => 'dashboard.php?page=jadwal'
							),
					array(	'menu' => ' Lihat Seluruh Jadwal',
							'url' => 'dashboard.php?page=alljadwal'
							),
					array(	'menu' => 'Panduan', // Akan di Deklarasikan dan dikodisikan secara spesifik di file Dashboard.php
							'url' => '#'
							),
					array(	'menu' => 'Kuisioner', // Akan di Deklarasikan dan dikodisikan secara spesifik di file Dashboard.php
							'url' => '#'
							),
					array(	'menu' => 'Keluar',
							'url' => '../logout.php?action=true'
							),
		);

		$sql      = "SELECT id_jur FROM sekretaris WHERE id_user = '$IDUser' Limit 1";
		$SekJur   = mysqli_query($conn,$sql);
		$SekFecth = mysqli_fetch_array($SekJur);
		$new_jur  = $SekFecth['id_jur']; 
	}else{};
}
?>

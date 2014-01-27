<?php
require_once('../connectdb.php');
@$action=$_GET['action'];
if($action == 'fakultas'){
	$fak = $_GET['fakultas'];
	$exp = explode(';',$fak);
	$countfak = count($exp);
	if($countfak <= 1){
	
	$insert = mysqli_query($conn,"INSERT INTO fakultas (nama_fakultas) values ('$fak')");
	}else{
	$n=0;
		for($ins=0; $ins<$countfak;$ins++){
			$insert = mysqli_query($conn,"INSERT INTO fakultas (nama_fakultas) values (' ".$exp[$n++]." ')");
		}
	}
	if(!$insert){
		echo "error";
	}else{
		header('location:../admin/dashboard.php?page=fakultas#sukses');
	}
exit;
}
if($action == 'jurusan'){
	$fak = $_GET["fakultas"];
	$jur = $_GET["jurusan"];
	
	$exp = explode(';',$jur);
	$countjur = count($exp);
	if($countjur <= 1){
	$insert = mysqli_query($conn,"INSERT INTO jurusan (id_fak,nama_jurusan) values ('$fak','$jur')");
	}else{
	
	$n=0;
		for($ins=0; $ins<$countjur;$ins++){
		$insert = mysqli_query($conn,"INSERT INTO jurusan (id_fak,nama_jurusan) values ('$fak',' ".$exp[$n++]." ')");		
		}
		
	
	}
	if(!$insert){
		echo "error";
	}else{
		header('location:../admin/dashboard.php?page=fakultas#sukses');
		}

	exit;	
}

if($action == 'dosen'){
	$NIDN = $_GET["NIDN"];
	$nama = $_GET["nama"];
	$status = $_GET["status"];
	$user = $_GET["user"];
	$pass = $_GET["pass"];
	$en_pass = md5($pass);

	$jur = $_GET["jurusan"];
	$kls = $_GET['kelas'];
	$matkul = $_GET['matakuliah'];


	$check = mysqli_query($conn,"SELECT * From users Where username = '$user' OR nama = '$nama' OR NIDN='$NIDN' ");
	$count = mysqli_num_rows($check);
	

	
	
	if($count >= 1){
	
	echo "data telah ada";
	exit;
	}else{

	$insert = mysqli_query($conn,"INSERT INTO users (NIDN,nama,username,password,id_status,id_level,hash_pass) 
	values ('$NIDN','$nama','$user','$en_pass','$status','2','$pass')");
	
	}
	if(!$insert){
		echo "gagal input";
		exit;
	}else{
		$idDosen = mysqli_query($conn,"SELECT * From users Where NIDN='$NIDN' AND username = '$user' ");
			$inID = mysqli_fetch_assoc($idDosen);
			$idD = $inID['id_user'];
			
			/* convert $kls into String, before $kls is array*/
			$Newkls = '';
			for ($i=0; $i < count($kls); $i++) { 
				$Newkls .= $kls[$i].',';
			}

			/*breaking string convert to array again*/
			$exp = explode('_kls', $Newkls);

			for ($a=0; $a < count($matkul); $a++) { //looping first, by how many matkul has been selected

				$exp_again = explode(',', $exp[$a]);
				
				for ($b=0; $b < count($exp_again) ; $b++) { // looping kelas after converted to array again.
					if($exp_again[$b] !=''){
						$sqlins_dsn = "INSERT INTO mengajar (id_jur,id_user,id_matkul,id_kelas,status) VALUES ('".$jur[$a]."','$idD','".$matkul[$a]."','".$exp_again[$b]."','on')"; 
						$ins_d = mysqli_query($conn,$sqlins_dsn);
						if(!$ins_d){
							echo "something wrong!!";
							exit;
						}
					}else{
						continue;
					}		
				
				}//end looping kelas
				
			}// end looping matkul
	


		}
			
	//exit;	
}


if($action == 'ruang'){
	$fak = $_GET["fakultas"];
	$jurusan = $_GET["jurusan"];
	$ruang = $_GET["nama"];
	
	$exp = explode(';',$ruang);
	$countru = count($exp);
	if($countru <= 1){
	$insert = mysqli_query($conn,"INSERT INTO ruangan (id_fak,id_jur,nama_ruang)  values ('$fak','$jurusan','$ruang')");
	}else{
	$n=0;
		for($ins=0; $ins<$countru;$ins++){
		$insert = mysqli_query($conn,"INSERT INTO ruangan (id_fak,id_jur,nama_ruang)  values ('$fak','$jurusan','".$exp[$n++]."')");
		}
	}
	if(!$insert){
		echo "error";
	}else{
		header('location:../admin/dashboard.php?page=ruang');
		}

	exit;	
}

if($action == 'matkul'){
	$fak = $_GET["fakultas"];
	$jurusan = $_GET["jurusan"];
	$kode = $_GET["kode"];
	$semester = $_GET["semester"];
	$matkul = $_GET["nama_matkul"];
	$sks = $_GET["sks"];
	$type = $_GET["tipe"];

	$insert = mysqli_query($conn,"INSERT INTO matkul (id_fak,id_jur,kode_matkul,nama_matkul,semester,sks,type) 
	values ('$fak','$jurusan','$kode','$matkul','$semester','$sks','$type')");
	
	if(!$insert){
		echo "Error";
	}else{
		header('location:../admin/dashboard.php?page=matakuliah');
		}

	exit;	
}

if($action == 'help'){

$title= $_GET['titlehelp'];
$text = $_GET['help'];
$id = $_GET['id'];

$inserthelp = mysqli_query($conn,"INSERT INTO help (judul,help,id_user) values('$title','$text','$id')");

if($inserthelp){
header('location:../admin/dashboard.php?page=help');
}else{
echo "Gagal Input";
}
}

?>
<?php
require_once('../connectdb.php');
if(!isset($_POST['place'])){
	exit;
	}else{

	$id 	= $_POST['place'];
	$user 	= $_POST['user'];
	$jab 	= $_POST['jab'];

	if($jab != 'Dosen'){

		$query = mysqli_query($conn,"SELECT * FROM jurusan Where id_fak = '$id' ");

	}else{

		$query= mysqli_query($conn,"SELECT DISTINCT mengajar.id_jur,jurusan.nama_jurusan from mengajar,jurusan Where mengajar.id_user = '$user' AND mengajar.id_jur = jurusan.id_jur AND  jurusan.id_fak = '$id' " );
	}
?>
	<option value="">Plih Jurusan</option>
	<?php
	while ($jurusan = mysqli_fetch_array($query)){?>
			<option value="<?php echo $jurusan['id_jur'];?>"><?php echo $jurusan['nama_jurusan'];?></option>

<?php } 
}
?>
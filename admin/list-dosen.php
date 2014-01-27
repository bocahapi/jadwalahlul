<?php
require_once('../connectdb.php');
if(!isset($_POST['place'])){
exit;
}else{
$id = $_POST['place'];
?>
<option value="">Plih Dosen</option>
		<?php $queryDosen = mysqli_query($conn,"SELECT DISTINCT mengajar.id_user,users.nama FROM users,mengajar where users.id_user=mengajar.id_user && mengajar.id_jur='$id' ");
		while ($dosen = mysqli_fetch_array($queryDosen)){?>
		<option value="<?php echo $dosen['id_user'];?>"><?php echo $dosen['nama'];?></option>
		<?php
	}
} ?>
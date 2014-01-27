<?php
$query = mysqli_query($conn,"SELECT * FROM users,status_dosen Where id_user='$IDUser' AND users.id_status=status_dosen.id_status");
$bioUser = mysqli_fetch_assoc($query);

if(isset($_GET['del'])){
$iddel = $_GET['del'];
$exp = explode('-',$iddel);

$delete1 = "DELETE FROM jadwal WHERE id_matkul ='".$exp[0]."' AND  id_kelas='".$exp[1]."' AND id_user='$IDUser' ";
$delete2 = "DELETE FROM jadwal_full WHERE id_matkul ='".$exp[0]."' AND  id_kelas='".$exp[1]."' AND id_user='$IDUser' ";

/*set ON matkul selected*/
$on = mysqli_query($conn,"UPDATE mengajar SET status ='on' WHERE id_matkul ='".$exp[0]."' AND  id_kelas='".$exp[1]."' AND id_user='$IDUser' ");

$del1 = mysqli_query($conn,$delete1);
$del2 = mysqli_query($conn,$delete2);
if(!$del1){
echo "gagal delete";
exit;
}else if(!$del2){
echo "gagal delete";
exit;
}

}
?>
<div class="row">
	<div class="col-md-12">
		<div class="head-title">
		<h3><i class="fa fa-user"></i> Profil : <?php echo $nameUser ;?></h3>
		</div>
	</div>
</div>
<hr/>
<div class="bio">

<form class="form-horizontal" role="form" method="post">
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-6 control-label">NIK</label>
    <div class="col-sm-6">
     <input class="form-control" type="text"value="<?php echo $bioUser['NIDN'];?>" disabled />
    </div>
  </div>
<div class="form-group">
    <label for="inputEmail3" class="col-sm-6 control-label">Nama Lengkap</label>
    <div class="col-sm-6">
     <input class="form-control" type="text" name="nama" value="<?php echo $bioUser['nama'];?>"  />
    </div>
  </div>
 <div class="form-group">
    <label for="inputEmail3" class="col-sm-6 control-label">Status Dosen</label>
    <div class="col-sm-6">
     <input class="form-control" type="text"value="<?php echo $bioUser['stats_dosen'];?>"  disabled />
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-6 control-label">Reset Password</label>
    <div class="col-sm-6">
     <input class="form-control" type="password" name="passone" placeholder="Password Baru"  />
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-6 control-label">Ulangi Password</label>
    <div class="col-sm-6">
     <input class="form-control"  type="password" name="passtwo"  placeholder="Ulangi Password"/>
    </div>
  </div>

		 <button type="submit"  name="update"  class="btn btn-danger pull-right">Simpan</button>
	</form>
	<div class="clear"></div>
</div>
<?php
if(isset($_POST['update'])){
$name = $_POST['nama'];
$pass1 = $_POST['passone'];
$pass2 = $_POST['passtwo'];

	if($pass1 == '' || $pass2 == ''){
		mysqli_query($conn,"update users set nama = '$name'where id_user='$IDUser' ");
		echo "Update Sukses";
	}else if($pass1 == $pass2){
		$pass = md5($pass1);
		mysqli_query($conn,"update users set nama = '$name', password='$pass', hash_pass='$pass1' where id_user='$IDUser' ");
		echo "Update Sukses";
	}else{
	
		echo "password tidak sama";
	
	}
}
?>
<hr/>
<div class="jadwal">
<p>
	<a href="<?php echo $BASE_URL;?>admin/pdf.php?param=cetak&userid=<?php echo $IDUser;?>" class="btn btn-danger btn-sm pull-right"> Cetak <i class="fa fa-print"></i></a>
	<div class="clear"></div>
	</p>
<?php

echo '<table class="table table-bordered">';
$q = mysqli_query($conn,"Select * From jadwal_full, hari, matkul, kelas, ruangan, fakultas, jurusan, users Where jadwal_full.id_hari=hari.id_hari && jadwal_full.id_matkul=matkul.id_matkul && jadwal_full.id_kelas=kelas.id_kelas && jadwal_full.id_ruang=ruangan.id_ruang && jadwal_full.id_fak=fakultas.id_fak && jadwal_full.id_jur=jurusan.id_jur && jadwal_full.id_user=users.id_user && jadwal_full.id_user='$IDUser'  order by hari.id_hari ASC ");
  
 echo'<tr>';
 echo '<th>No</th>';
 echo '<th>Hari</th>';
 echo '<th>Jam</th>';
 echo '<th>SKS</th>';
 echo '<th>Semester</th>';
 echo '<th>Mata Kuliah</th>';
 echo '<th>Kelas</th>';
 echo '<th>Ruang</th>';
 echo '<th>Fakultas</th>';
 echo '<th>Jurusan</th>';
 echo '<th>Aksi</th>';
  echo '</tr>';
		
		$n=1;
		while($thejad = mysqli_fetch_array($q)){
		echo '<tr>';
		echo '<td align=center>'.$n++.'</td>';
		echo '<td>'.$thejad['hari'].'</td>';
		echo '<td>'.$thejad['jamkelas'].'</td>';
		echo '<td align=center>'.$thejad['sks'].'</td>';
		echo '<td align=center>'.$thejad['semester'].'</td>';
		echo '<td>'.$thejad['nama_matkul'].'</td>';
		echo '<td align=center>'.$thejad['kelas'].'</td>';
		echo '<td>'.$thejad['nama_ruang'].'</td>';
		echo '<td>'.$thejad['nama_fakultas'].'</td>';
		echo '<td>'.$thejad['nama_jurusan'].'</td>';
		echo '<td align="center"><a href="dashboard.php?page=profile&del='.$thejad['id_matkul'].'-'.$thejad['id_kelas'].'"  title="delete"><i class="fa fa-trash-o"></i></a</td>';
		
		echo '</tr>';		
		}
 
echo '</table>';


?>
</div>
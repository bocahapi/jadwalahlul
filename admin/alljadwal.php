<?php
if(isset($_GET['del'])){
$iddel = $_GET['del'];

	
$exp = explode('-',$iddel);

$delete1 = "DELETE FROM jadwal WHERE id_matkul ='".$exp[0]."' &&  id_kelas='".$exp[1]."'&& id_user='".$exp[2]."' ";
$delete2 = "DELETE FROM jadwal_full WHERE id_matkul ='".$exp[0]."' &&  id_kelas='".$exp[1]."' && id_user='".$exp[2]."' ";
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
$sekretaris = mysqli_query($conn,"Select * from sekretaris where id_user = '$IDUser' ");
$sekjur = mysqli_fetch_assoc($sekretaris);
	
$idjur = $sekjur['id_jur']; 
?>
<div class="jadwal">
<p>
	<a href="<?php echo $BASE_URL;?>pdf.php?param=cetak&&userid=<?php echo $idjur;?>" class="btn btn-danger btn-sm pull-right">Cetak</a>
	<div class="clear"></div>
	</p>
<div class="jadwal-inner">
<?php

	
		echo '<table class="table table-bordered">';
		$q = mysqli_query($conn,"Select * From jadwal_full, hari, matkul, kelas, ruangan, fakultas, jurusan, users Where jadwal_full.id_hari=hari.id_hari && jadwal_full.id_matkul=matkul.id_matkul && jadwal_full.id_kelas=kelas.id_kelas && jadwal_full.id_ruang=ruangan.id_ruang && jadwal_full.id_fak=fakultas.id_fak && jadwal_full.id_jur=jurusan.id_jur && jadwal_full.id_user=users.id_user && jadwal_full.id_jur='$idjur'  order by hari.id_hari ASC ");
		  
		 echo'<tr>';
		 echo '<th>No</th>';
		 echo '<th>Nama</th>';
		 echo '<th>Hari</th>';
		 echo '<th>Jam</th>';
		 echo '<th>SKS</th>';
		 echo '<th>Semester</th>';
		 echo '<th>Mata Kuliah</th>';
		 echo '<th>Kelas</th>';
		 echo '<th>Ruang</th>';
		 echo '<th>Aksi</th>';
		  echo '</tr>';
				
				$n=1;
				while($thejad = mysqli_fetch_array($q)){
				echo '<tr>';
				echo '<td align=center>'.$n++.'</td>';
				echo '<td>'.$thejad['nama'].'</td>';
				echo '<td>'.$thejad['hari'].'</td>';
				echo '<td>'.$thejad['jamkelas'].'</td>';
				echo '<td align=center>'.$thejad['sks'].'</td>';
				echo '<td align=center>'.$thejad['semester'].'</td>';
				echo '<td>'.$thejad['nama_matkul'].'</td>';
				echo '<td align=center>'.$thejad['kelas'].'</td>';
				echo '<td>'.$thejad['nama_ruang'].'</td>';
				echo '<td align="center"><a href="dashboard.php?page=alljadwal&del='.$thejad['id_matkul'].'-'.$thejad['id_kelas'].'-'.$thejad['id_user'].'"  title="delete"><i class="fa fa-trash-o"></i></a</td>';
				
				echo '</tr>';		
				}
		 
		echo '</table>';
	?>
	</div>	
</div>


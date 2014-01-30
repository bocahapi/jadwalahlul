<?php
require_once('../../connectdb.php');
if(isset($_POST['fakultas'])){
$fakultas = $_POST['fakultas'];

	if(!isset($_POST['jurusan']) ||  $_POST['jurusan'] == "" ){

	echo "Mohon Pilih Jurusan";
	exit;
				
		}else{
		$jurusan = $_POST['jurusan'];
		
		$checkRuang = mysqli_query($conn,"SELECT * From ruangan Where id_fak='$fakultas' AND id_jur='$jurusan' ");
		
		$checked = mysqli_num_rows($checkRuang);
		
		if($checked == 0){
		
			echo "Ruangan Belum Ada";
			exit;
		}
		
		}
}else{

	echo "Mohon Pilih Fakultas";
	exit;

}
# Hitung Hari & Query Table Hari
$queryDay = mysqli_query($conn,"Select * From hari");
$countDay = mysqli_num_rows($queryDay);

$Ro  = "SELECT * FROM ruangan WHERE id_fak='$fakultas' AND id_jur='$jurusan'";
$num = mysqli_num_rows(mysqli_query($conn,$Ro));
# Set Statis Css dengan PHP 
$width = $num*740;
echo '<div class="tablefull" style="width:'.$width.'px">';

for($daya=0;$daya<=$countDay-1;$daya++){
	
	$day = mysqli_fetch_assoc($queryDay);

	echo"<div class='tables'>";
	echo"<table class='time-schedule table-bordered'>";
	
	if($day['hari'] == 'Senin'){
	
		echo"<tr><td>&nbsp;</td><td>&nbsp;</td></tr>";
		echo"<tr><td>Hari</td><td>Jam</td></tr>";
	
	}
	echo "<tr><td id='hari' rowspan=".($day['jam']+2).">".$day['hari']."</td></tr>";
	
		$t = 1;
		for($jaM=0;$jaM<=$day['jam']-1;$jaM++){
			echo "<tr>";
			
			echo "<td id='jam'>".$t++."</td>";
			
			echo "</tr>";
		}
		
	echo "</table>";
	# Hitung Jumlah Ruang dan Query table Ruangan

	$QroomSql 	= "SELECT * FROM ruangan WHERE id_fak='$fakultas' AND id_jur='$jurusan' ORDER BY nama_ruang";
	$Qroom 		= mysqli_query($conn,$QroomSql);
	$count 		= mysqli_num_rows($Qroom);

	$thisDay	= $day['id_hari'] ;
	
	if($thisDay == 1){

	for($room=0;$room<=$count-1;$room++){
	
	$jadwal = mysqli_fetch_assoc($Qroom);	
	$ruang  = $jadwal['id_ruang'];
	
	echo"<table class='time-schedule table-bordered table-ruang'>";
		echo "<tr>";
			echo "<td colspan=4 align='center'>".$jadwal['nama_ruang']."</td>";
		echo "</tr>";
		
				echo "<tr>";
					echo "<td id='a'>Semester</td>";
					echo "<td id='b' align='center'>Mata Kuliah</td>";
					echo "<td id='c' align='center'>Dosen</td>";
					echo "<td id='d'>Kelas</td>";
				echo "</tr>";
		
	
		$n=0;
		$jamke = range(1,$day['jam']);
		for($list=0;$list<=$day['jam']-1;$list++){
		
			$queryJ =  mysqli_query($conn,"SELECT * FROM jadwal,matkul,users,kelas,ruangan WHERE jadwal.id_matkul=matkul.id_matkul AND jadwal.id_user=users.id_user AND jadwal.id_kelas=kelas.id_kelas AND jadwal.id_ruang=ruangan.id_ruang AND jadwal.id_ruang = '$ruang ' AND jadwal.id_hari ='$thisDay' AND jadwal.jam='".($jamke[$n++])."' ");
			
			$data = mysqli_fetch_assoc($queryJ);
		
			if($data['jam'] == "" ){
			echo "<tr id='blank'><td id=a>&nbsp;</td><td id=b>&nbsp;</td><td id=c>&nbsp;</td><td id=d>&nbsp;</td></tr>";
			}else{
			
				echo "<tr id='current'>";
					echo "<td id=a>" .$data ['semester']. "</td>";
					echo "<td id=b>" .$data [ 'nama_matkul' ]. "</td>";
					echo "<td id=c>" .$data ['nama']. "</td>";
					echo "<td id=d>" .$data ['kelas']. "</td>";
				echo "</tr>";
			}
		}
	echo "</table>";	
	}
	
	}else{

		for($room=0;$room<=$count-1;$room++){

		$jadwal = mysqli_fetch_assoc($Qroom);	
		$ruang = $jadwal['id_ruang'];
		
	
		echo"<table class='time-schedule table-bordered'>";
		$n=0;
		$jamke = range(1,$day['jam']);		
		for($list=0;$list<=$day['jam']-1;$list++){
		$queryJ =  mysqli_query($conn,"SELECT * FROM jadwal,matkul,users,kelas,ruangan Where jadwal.id_matkul=matkul.id_matkul AND jadwal.id_user=users.id_user AND jadwal.id_kelas=kelas.id_kelas AND jadwal.id_ruang=ruangan.id_ruang AND jadwal.id_ruang = '$ruang ' AND jadwal.id_hari ='$thisDay' AND jadwal.jam='".($jamke[$n++])."' ");
			$data = mysqli_fetch_assoc($queryJ);
				
		if($data['jam'] == "" ){
			
			echo "<tr id='blank'><td id=a>&nbsp;</td><td id=b>&nbsp;</td><td id=c>&nbsp;</td><td id=d>&nbsp;</td></tr>";
			
			}else{
				echo "<tr id='current'>";
					echo "<td id=a>" .$data ['semester']. "</td>";
					echo "<td id=b>" .$data [ 'nama_matkul' ]. "</td>";
					echo "<td id=c>" .$data ['nama']. "</td>";
					echo "<td id=d>" .$data ['kelas']. "</td>";
				echo "</tr>";
			}
		}
			echo "</table>";
			}
	
	}
	// end Ruang
	echo "<div class='clear'></div>";
	echo "</div>";
}

echo '</div>';
?>

<script>
var full = $('.jadwalfull').html();
	$('#fullscreen').click(function(){
		$('.full-screen').fadeIn();
		$('.overflow-page').html(full);
		$('.jadwalfull,.navigations').hide();
		$('#menu').hide();
	});
	$('#close').click(function(){
		
		
		$('.full-screen').fadeOut();		
		$('.jadwalfull,.navigations').fadeIn();
		$('#menu').show();
	});

	$('.close').click(function(){
		
		$('#addnew-modal').fadeOut();	
	
	});

</script>

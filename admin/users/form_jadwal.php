<?php
session_start();
if(isset($_SESSION['sesi'])){
  $session = $_SESSION['sesi'];
}
require_once('../../connectdb.php');

if(!isset($_POST['id']) || $_POST['id']== ""){
exit;
} else {
$fakultas = $_POST['fak'];
$IDjur = $_POST['id'];
$IDUser = $_POST['im'];

}?>

<form role="form" action="users/input_jadwal.php" method="POST">
	<div class="form-group">
	<input type="hidden" id="addfakultas"  name="fakultas" value="<?php echo $fakultas;?>"/>
	<input type="hidden" id="addjurusan" name="jurusan" value="<?php echo $IDjur;?>"/>
	<input class="form-control" type="hidden" id="im" name="im" value="<?php echo $IDUser ;?>"/>
	</div>
				
		<div class="form-group">
		<label for="">Plih Hari</label>
			<select class="form-control" name="hari" id="">
			<option value="">Plih Hari</option>
			<?php $days = mysqli_query($conn,"SELECT * FROM hari");
				while ($hari = mysqli_fetch_array($days)){?>
						<option value="<?php echo $hari['id_hari'];?>"><?php echo $hari['hari'];?></option>
			<?php } ?>
			</select>
		</div>
		
		<div class="form-group">
		<label for="">Plih Jam</label>
			<select class="form-control" name="jam" id="">
			<option value="">Plih Jam</option>
			<option value="1">  1 : 07.00 - 07.50</option>
			<option value="2">  2 : 07.50 - 08.40</option>
			<option value="3">  3 : 08.40 - 09.30</option>
			<option value="4">  4 : 09.30 - 10.20</option>
			<option value="5">  5 : 10.20 - 11.10</option>
			<option value="6">  6 : 11.10 - 12.00</option>
			<option value="7">  7 : 12.30 - 13.20</option>
			<option value="8">  8 : 13.20 - 14.10</option>
			<option value="9">  9 : 14.10 - 15.00</option>
			<option value="10">10 : 15.20 - 16.10</option>
			<option value="11">11 : 16.10 - 17.00</option>
			<option value="12">12 : 17.00 - 18.50</option>
			<option value="13">13 : 18.50 - 19.40</option>
			<option value="14">14 : 19.40 - 20.30</option>
			<option value="15">15 : 20.30 - 21.20</option>
			</select>
		</div>
		
		<div class="form-group">
		<label for="">Plih Mata Kuliah</label>
			<select class="form-control" name="matkul" id="">
			<option value="">Plih Mata Kuliah</option>
			<?php 
			$matsql = "SELECT * FROM mengajar,matkul,kelas WHERE 
						mengajar.id_matkul  = matkul.id_matkul AND
						mengajar.id_kelas 	= kelas.id_kelas AND 
						mengajar.status     = 'on' AND 
						matkul.session      = '$session' AND 
						mengajar.id_user    = '$IDUser' AND 
						mengajar.id_jur     = '$IDjur' ORDER BY matkul.semester ASC";

			$matkuls = mysqli_query($conn,$matsql);
			
			while ($matkul = mysqli_fetch_array($matkuls)){ ?>
				<option value="<?php echo $matkul['id_matkul'];?>-<?php echo $matkul['id_kelas'];?>-<?php echo $matkul['semester'];?>">
				
					<?php echo $matkul['semester'];?> - <?php echo $matkul['nama_matkul'];?> [ <?php echo $matkul['kelas'];?> ]
				
				</option>
			
			<?php } ?>
			</select>
		</div>
		
		<div class="form-group">
			<label for="">Plih Ruang</label>
			<select class="form-control" name="ruang" id="">
				
				<option value="">Plih Ruang</option>			
				<?php	$Ruang = mysqli_query($conn,"SELECT * From ruangan  Where id_jur = '$IDjur' ");
				while ($room = mysqli_fetch_array($Ruang)){?>
				<option value="<?php echo $room['id_ruang'];?>"><?php echo $room['nama_ruang'];?></option>
				<?php } ?>
			</select>
		</div>
		

		<div id="submit-req"  class="btn btn-danger"  class="form-control">Request Jadwal</div>
	</form>
	<script>
	$('#submit-req').click(function() {
		newinput = $(this).parent('form').serialize();
	
	$.ajax({
		url: 'users/input_jadwal.php',
		type: 'POST',
		data: newinput,
		beforeSend:function(){
				$('.jadwalfull').html('Mohon Tunggu .....');
		},
		success:function(result){
			$('#menu').show();

			/* Alert Error  */
			$('#menu').before('<div class="alert alert-danger error">'+result+'</div>');
			$('.error').delay(5000).fadeOut();

			$('.jadwalfull').fadeIn('slow', function() {
				pageN = $(this);
				dataM = $('#addfakultas').val();
				dataN = $('#addjurusan').val();
						
				$('#addnew-modal,.modal-backdrop').fadeOut();
				$.ajax({
					url:'users/list_jadwal.php',
					type:'POST',
					data: {jurusan:dataN,fakultas:dataM},
					success:function(dataget){
						pageN.html(dataget);
					}
				});

			});
		}
	});
	return false;
	});
	</script>
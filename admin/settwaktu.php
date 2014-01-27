<div class="row">
	<div class="col-md-12">
		<div class="head-title">
		<h3>Manajemen Waktu</h3>
		</div>
		<?php
if(isset($_POST['config'])){

$request = $_POST['request'];
$ins = mysqli_query($conn,"Update config SET  value = '$request' Where setting = 'Request' ");

	if(!$ins){

	}else{

	echo '
	<div class="alert alert-warning alert-dismissable">
	  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	 Update Berhasil dilakukan
	</div>';
	}

}

if(isset($_POST['ta'])){
	$ta = $_POST['ata'];
	$inzs = mysqli_query($conn,"Update config SET  value = '$ta' Where setting = 'TA' ");
	if(!$inzs){

	}else{

	echo '
	<div class="alert alert-warning alert-dismissable">
	  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	 Update Berhasil dilakukan
	</div>';
	}
}

?>
	</div>
</div>

<form role="form" method="POST">
	<table class='table-bordered set' width="450">
		<tr>
			<td>Aktifitas</td>
			<td>Status</td>
		</tr>
		<tr>
			<td>Request Jadwal</td>
			<td><select class="form-control input-sm" name="request" id="">
				<?php 
				$dd = mysqli_query($conn,"select * from config");
				$con = mysqli_fetch_assoc($dd);?>
					
				<option value="on" <?php if($con['value']== 'on') echo ' selected'; ?>>Dibuka</option>
					
				<option value="off"<?php if($con['value']== 'off') echo ' selected';?>>Ditutup</option>
					
				
			</select></td>
		</tr>
	</table>
	<br/>
	<button type="submit" name="config" class="btn btn-danger btn-sm">Simpan</button>
	<button type="reset"  class="btn btn-default btn-sm">Reset</button>
</form>
<hr/>
<form id="" action="update_waktu.php" method="post" role="form">
	<table class='table-bordered set' width="450">
		<tr>
			<td colspan="3">Mulai Request Jadwal</td>
		</tr>
		<?php
		$n=1;
		$m=2;
		$query = mysqli_query($conn,"select * from status_dosen");
		while ($tgl = mysqli_fetch_array($query)) {
		?>
		<tr>
			<td><input type="hidden" class="form-control input-sm" name="id<?php echo $tgl['id_status'];?>" value="<?php echo $tgl['id_status'];?>"> Dosen <?php echo $tgl['stats_dosen'];?></td>
			<td><input type="text" class="form-control input-sm" name="start<?php echo $tgl['id_status'];?>" id="datepicker<?php echo $n++;?>" value="<?php echo $tgl['tgl_mulai'];?>"></td>
			<td><input type="text" class="form-control input-sm" name="end<?php echo $tgl['id_status'];?>" id="datepicker<?php echo $m++;?>" value="<?php echo $tgl['tgl_selesai'];?>"></td>
		</tr>
	<?php
	} ?>
		
	</table>
	<br/>
	<button type="submit" class="btn btn-danger btn-sm">Simpan</button>
	<button type="reset"  class="btn btn-default btn-sm">Reset</button>
</form>

<hr>
<form role="form" method="POST">
	<table class='table-bordered set' width="450">
		<tr>
			<td>Aktifitas</td>
			<td>Status</td>
		</tr>
		<tr>
			<td>Semester</td>
			<td><select class="form-control input-sm" name="ata" id="">
				<?php 
				$dd = mysqli_query($conn,"select * from config where setting = 'TA' ");
				$con = mysqli_fetch_assoc($dd);?>
					
				<option value="genap" <?php if($con['value']== 'genap') echo ' selected'; ?>>Genap</option>
					
				<option value="ganjil"<?php if($con['value']== 'ganjil') echo ' selected';?>>Ganjil</option>
					
				
			</select></td>
		</tr>
	</table>
	<br/>
	<button type="submit" name="ta" class="btn btn-danger btn-sm">Simpan</button>
	<button type="reset"  class="btn btn-default btn-sm">Reset</button>
</form>
<script type="text/javascript" src="<?php echo $js;?>bootstrap-datepicker.js"></script>
	
	<script type="text/javascript">
	$('#datepicker1,#datepicker2,#datepicker3,#datepicker4,#datepicker5,#datepicker6').datepicker()
	</script>

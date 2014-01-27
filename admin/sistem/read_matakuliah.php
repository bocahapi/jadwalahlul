<?php

require_once('../../connectdb.php');

if(!isset($_POST['id']) || $_POST['id']== ""){
exit;
} else {

	$Id = $_POST['id'];

	$values = mysqli_query($conn,"Select * From matkul Where id_matkul = '$Id' ");

	$value = mysqli_fetch_assoc($values);
	
	?>
	<div class="form-group">
				<label for="semester" class="col-sm-4 control-label">Semester</label>
				<div class="col-sm-8">
					<input type="hidden" class="form-control" id="id_matkul" value="<?php echo $value['id_matkul'];?>">
					<select class="form-control" id="semester">
						<?php
							for ($i=1; $i <=8 ; $i++) { 
								if( $i == $value['semester'] ){
									$select = ' selected';
								}else{
									$select ='';
								}
								
								echo '<option value="'.$i.'" '.$select.'>'.$i.'</option>';
							}

						?>
					</select>
				</div>
	</div>
	<div class="form-group">
				<label for="kode" class="col-sm-4 control-label">Kode Mata Kuliah</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" id="matkul_kode" value="<?php echo $value['kode_matkul'];?>">
				</div>
	</div>
	<div class="form-group">
				<label for="matkul" class="col-sm-4 control-label">Mata Kuliah</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" id="matkul" value="<?php echo $value['nama_matkul'];?>">
				</div>
	</div>
	<div class="form-group">
				<label for="" class="col-sm-4 control-label">SKS</label>
				<div class="col-sm-8">
					<select class="form-control" id="sksnew">
						<?php
							for ($a=1; $a <= 4 ; $a++) { 
								if($a == $value['sks'] ){
									$select = ' selected';
								}else{
									$select ='';
								}
								
								echo '<option value="'.$a.'" '.$select.'>'.$a.'</option>';
							}

						?>
					</select>
				</div>
	</div>
	<div class="form-group">
				<label for="" class="col-sm-4 control-label">Jenis Kuliah</label>
				<div class="col-sm-8">
					<select class="form-control" id="tipenew">
						<option value="">Pilih Tipe</option>
						<option value="Teori">Teori</option>
						<option value="Praktikum">Praktikum</option>
					</select>
				</div>
	</div>
		<script type="text/javascript">
			$(function(){
			
				$('button[name="update"]').click(function(){
					var id_matkul = $('#id_matkul').val();
					var semester = $('#semester').val();
					var matkul_kode = $('#matkul_kode').val();
					var matkul = $('#matkul').val();
					var sksnew = $('#sksnew').val();
					var tipenew = $('#tipenew').val();
				
					var dataString = 'id_matkul=' + id_matkul + '&semester=' + semester + '&matkul_kode=' + matkul_kode + '&matkul='+ matkul + '&sksnew='+sksnew+'&tipenew='+tipenew;
						$.ajax({
						type: "POST",
						url: "sistem/update_matakuliah.php",
						data: dataString,
						success: function(result){
						if(result != 'error' || result != 'error II'){
							$('.fromupdate').html(result);
							}else{
							$('.fromupdate').html(result);
							}
						location.reload(true);
						}
					
					});
					return false;
				
				 
				});
			
			
			});
			</script>
	<?php
}
	?>
	
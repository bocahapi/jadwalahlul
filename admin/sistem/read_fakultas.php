<?php
require_once('../../connectdb.php');

if(!isset($_POST['id']) || $_POST['id']== ""){
exit;
} else {

	$Id = $_POST['id'];

	$values = mysqli_query($conn,"Select * From fakultas,jurusan Where  fakultas.id_fak = jurusan.id_fak AND jurusan.id_jur = '$Id' ");

	$value = mysqli_fetch_assoc($values);
	

	?>
	<div class="form-group">
				<label for="fakultas" class="col-sm-2 control-label">Fakultas</label>
				<div class="col-sm-10">
					<input type="hidden" name="id_fak" class="form-control" id="id_fak" value="<?php echo $value['id_fak'];?>">
					<input type="text" name="fakultas" class="form-control" id="fakul" value="<?php echo $value['nama_fakultas'];?>">
				</div>
	</div>
	<div class="form-group">
				<label for="jurusan" class="col-sm-2 control-label">Jurusan</label>
				<div class="col-sm-10">
					<input type="hidden" name="id_jur" class="form-control" id="id_jur" value="<?php echo $value['id_jur'];?>">
					<input type="text" name="jurusan" class="form-control" id="jurusan" value="<?php echo $value['nama_jurusan'];?>"/>
				</div>
	</div>
			
			<script type="text/javascript">
			$(function(){
			
				$('button[name="update"]').click(function(){
					var id_fak = $('#id_fak').val();
					var id_jur = $('#id_jur').val();
					var nama_fak = $('#fakul').val();
					var nama_jur = $('#jurusan').val();
				
					var dataString = 'id_fak=' + id_fak + '&id_jur=' + id_jur + '&fakultas=' + nama_fak + '&jurusan='+ nama_jur;
						$.ajax({
						type: "POST",
						url: "sistem/update_fakultas.php",
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
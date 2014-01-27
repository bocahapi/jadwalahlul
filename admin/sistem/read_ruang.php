<?php
require_once('../../connectdb.php');

if(!isset($_POST['id']) || $_POST['id']== ""){
exit;
} else {

	$Id = $_POST['id'];

	$values = mysqli_query($conn,"Select * From ruangan Where  id_ruang = '$Id' ");

	$value = mysqli_fetch_assoc($values);
	
	?>
	<div class="form-group">
				<label for="fakultas" class="col-sm-4 control-label">Nama Ruang</label>
				<div class="col-sm-8">
					<input type="hidden"  class="form-control" id="id_ruang" value="<?php echo $value['id_ruang'];?>">
					<input type="text" class="form-control" id="ruangan" value="<?php echo $value['nama_ruang'];?>">
				</div>
	</div>
<script type="text/javascript">
			$(function(){
			
				$('button[name="update"]').click(function(){
					var id_ruang = $('#id_ruang').val();
					var ruangan = $('#ruangan').val();
				
					var dataString = 'id_ruang=' + id_ruang + '&ruangan=' + ruangan;
						$.ajax({
						type: "POST",
						url: "sistem/update_ruang.php",
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
<?php } ?>
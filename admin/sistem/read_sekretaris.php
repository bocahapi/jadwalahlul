<?php
require_once('../../connectdb.php');

if(!isset($_POST['id']) || $_POST['id']== ""){
exit;
} else {

	$Id = $_POST['id'];

	$values = mysqli_query($conn,"Select * From sekretaris Where  id_sekretaris = '$Id' ");

	$value = mysqli_fetch_assoc($values);
	$jurId = $value['id_jur'];

	?>
	<div class="form-group">
				<label for="fakultas" class="col-sm-2 control-label">Sekretaris</label>
				<div class="col-sm-10">
				<input type="hidden" id="id_sek" value="<?php echo $Id ;?>"/>
					<select class="form-control width" name="dosen" id="dosen_new">
					<option value="">Plih Dosen</option>
		<?php $queryDosen = mysqli_query($conn,"SELECT DISTINCT mengajar.id_user,users.nama FROM users,mengajar where users.id_user=mengajar.id_user AND mengajar.id_jur='$jurId' ");
		while ($dosen = mysqli_fetch_array($queryDosen)){ ?>
		<option value="<?php echo $dosen['id_user'];?>"><?php echo $dosen['nama'];?></option>
		<?php } ?>
					</select>
			</div>
			</div>
			<script type="text/javascript">
			$(function(){
			
				$('button[name="update"]').click(function(){
					var id_dosen = $('#dosen_new').val();
					var id_sek = $('#id_sek').val();
				
					var dataString = 'id_dosen=' + id_dosen + '&id_sek='+ id_sek;
						$.ajax({
						type: "POST",
						url: "sistem/update_sekretaris.php",
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
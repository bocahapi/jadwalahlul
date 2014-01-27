<?php
require_once('../../connectdb.php');

if(!isset($_POST['id']) || $_POST['id']== ""){
	require_once('../../404.php');
} else {

	$Id = $_POST['id'];

	$values = mysqli_query($conn,"Select * From users Where  id_user = '$Id' ");

	$value = mysqli_fetch_assoc($values);
	

	?>
	<div class="form-group">
				<label for="fakultas" class="col-sm-2 control-label">NIK</label>
				<div class="col-sm-10">
					<input type="hidden"class="form-control" id="id_dosen" value="<?php echo $value['id_user'];?>">
					<input type="text" class="form-control" id="nidn" value="<?php echo $value['NIDN'];?>">
				</div>
			</div>
		<div class="form-group">
				<label for="jurusan" class="col-sm-2 control-label">Nama</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="nama_dosen" value="<?php echo $value['nama'];?>"/>
				</div>
			</div>
			<div class="form-group">
				<label for="jurusan" class="col-sm-2 control-label">Status Dosen</label>
				<div class="col-sm-10">
					<select class="form-control"  id="status_dosen">
					<?php
					$query = mysqli_query($conn,"SELECT * FROM status_dosen");
					while( $status = mysqli_fetch_array($query)){
						?>
						<option value="<?php echo $status['id_status'];?>" <?php if($status['id_status']==$value['id_status']) echo" selected"; ?> ><?php echo $status['stats_dosen'];?> </option>;
					<?php }		?>
					</select>
					</div>
				</div>
			<div class="form-group">
				<label for="jurusan" class="col-sm-2 control-label">Mengajar di</label>
				<div class="col-sm-10">
				<?php
				# select id_jur in mengajar table's by id_user
				$mg 	 = "SELECT DISTINCT id_jur FROM mengajar WHERE id_user='$Id' ";
				$mgquery = mysqli_query($conn,$mg);
				
				# make array for ID Jurusan;
				
				$jurusan = array();
				while ($data = mysqli_fetch_array($mgquery)) {
					$jurusan[]=$data['id_jur'];
				}
				
				# make array for ID Matkul;
				$matkul = array();

				for($i=0;$i < count($jurusan);$i++){
					$mat 	  = "SELECT DISTINCT id_matkul FROM mengajar WHERE id_user='$Id' AND id_jur = '".$jurusan[$i]."' ";
					$matquery = mysqli_query($conn,$mat);
					
					while ($mat = mysqli_fetch_array($matquery)) {
						$matkul[]=$mat['id_matkul'];
					}
				}

				# make array for ID Kelas;
				$kls = array();
				for($a=0;$a < count($matkul);$a++){
					$kelas 	    = "SELECT * FROM mengajar WHERE id_user='$Id' AND id_matkul = '".$matkul[$a]."' ";
					$kelasquery = mysqli_query($conn,$kelas);
					
					while ($kel = mysqli_fetch_array($kelasquery)) {
						$kls[]=$kel['id_kelas'];
					}
				}
/*lis matkul*/
				echo '<div class="btn btn-sm btn-primary" id="tambah">Tambah</div>';
				echo '<div class="add_new_mat"></div>';
				echo '<hr />';
				echo '<div class="list_aa">';

				for ($e=0; $e < count($jurusan); $e++) { 
					
						echo '<div class="mg_jr_d">';
						$jur = mysqli_fetch_array(mysqli_query($conn,"SELECT nama_jurusan FROM jurusan WHERE id_jur = '".$jurusan[$e]."' "));
							echo "<b>Jurusan</b> : ";
							echo $jur['nama_jurusan'].'<br />';// get id use $jurusan[$e];
							
							echo "<b>Mengajar</b> : <br />";
							for ($d=0; $d < count($matkul) ; $d++) { 
								
								$mat = mysqli_fetch_array(mysqli_query($conn,"SELECT nama_matkul FROM matkul WHERE id_matkul = '".$matkul[$d]."' AND id_jur = '".$jurusan[$e]."' "));
									
									if($mat['nama_matkul'] == ''){
									
									}else{				
									
									echo'<div class="mg_mat">';
									echo'<div class="clearfix pull-right close remov" act="delete" data="'.$matkul[$d].'">&times;</div>';
									echo $mat['nama_matkul'].'<br />';// get id use $matkul[$d];
															
									echo '<div class="mg_kls">';
									echo "Kelas : ";
										
										$klss = mysqli_query($conn,"SELECT kelas.kelas FROM kelas,mengajar WHERE mengajar.id_kelas=kelas.id_kelas AND mengajar.id_matkul = '".$matkul[$d]."' AND mengajar.id_jur = '".$jurusan[$e]."' ");
										
										while($klse = mysqli_fetch_array($klss)){
																
											echo $klse['kelas'].' ';// get id use $kls[$s];
										}
									echo'</div></div>';
								}
							}
							echo '</div>';
					
					}
					echo'</div>';

				?>

				</div>
					</div>

<!-- javascript functions  -->
			<script type="text/javascript">
			$(function(){

				/* to add new form mengajar */
			$('#tambah').click(function(){
				$.ajax({
					url:'sistem/load_mengajar.php',
					type:'POST',
					data:{add:'add',jab:'',jur:''},
					success:function(result){
						$('.add_new_mat').html(result);
						$('#simpan').show();
					}
				});
			});
			
			$('.remov[data]').click(function(){
				parT  = $(this).parents('.mg_jr_d');
				ids   = $(this).attr('data');
				child = parT.children('.mg_mat').length;


				/*ajax*/
				$.ajax({
					url :'sistem/queryeditdosen.php',
					type:'POST',
					data:{idmat:ids},
					success:function(result){
						if(result == 'true'){

						}else{
							alert('terjadi Kelasahan');
						}
					}

				}); // End Of Ajax
				
				if(child <= 1){
				  parT.remove();
			     }else{
				  $(this).parent('.mg_mat').remove();
				}
				//return false;
			});

			/* action Update data Dosen */
			$('button[name="update"]').click(function(){
				var id_dosen 	= $('#id_dosen').val();
				var nidn 		= $('#nidn').val();
				var nama_dosen	= $('#nama_dosen').val();
				var statusn 	= $('#status_dosen').val();
				var jurusanNew  = $('#jurusan_new').val();

				/* Checking condition when the form is Empty */
				if(id_dosen == '' || nidn=='' || nama_dosen=='' || statusn == '' ){
					$('.fromupdate').html('Kolom Harus Di Isi Semua');
					$('.modal-backdrop').fadeOut();

					}else{

					var dataString = 'id_dosen=' + id_dosen + '&nidn=' + nidn + '&nama_dosen=' + nama_dosen + '&status_dosen='+ statusn + '&jurusan='+jurusanNew;

						$.ajax({
							type: "POST",
							url: "sistem/update_dosen.php",
							data: dataString,
							success: function(result){
							
							/* Error handling whitin Query database */
							
							if(result != 'error' || result != 'error II'){

							$('.fromupdate').html(result);
								
								}else{
								
								$('.fromupdate').html(result);
								
								}
							
							/* Reload Page after Query Success */
							location.reload(true);
							}
					
					});// End Of Ajax
					
					return false;
				
				 }

				});// End Of click Function
		
		
			}); 

			</script>
	<?php
}

?>
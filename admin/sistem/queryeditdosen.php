<?php
include('../../connectdb.php');


if(isset($_POST['idmat'])){
	
	$id_matkul = $_POST['idmat'];

	$sql 	= "DELETE FROM mengajar WHERE id_matkul='$id_matkul' ";

	$query  = mysqli_query($conn,$sql);
	if(!$query){
		echo "false";
	}else{
		echo "true";
	}
}else if(isset($_POST['id_dosen'])){
	
	$id = $_POST['id_dosen'];
	$jur = $_POST['jurusan'];
	$mat = $_POST['matakuliah'];
	$kls = $_POST['kelas'];

	if(count($jur) == 1){
		$jur = $jur[0];
	}else{
		exit;
	}
	if(count($mat) == 1){

		$mat = $mat[0];
	}else{
		exit;
	}


		for ($i=0; $i < count($kls)-1 ; $i++) { 
				$sql 	= "INSERT INTO mengajar (id_jur,id_user,id_matkul,id_kelas,status) VALUES ('$jur','$id','$mat','".$kls[$i]."',1) ";
				$query	= mysqli_query($conn,$sql);
				if(!$query){
					echo "eoor";
					exit;
				}
		}



$jurusan 	= mysqli_fetch_array(mysqli_query($conn,"SELECT nama_jurusan FROM jurusan WHERE id_jur='$jur' LIMIT 1"));
$matakuliah = mysqli_fetch_array(mysqli_query($conn,"SELECT nama_matkul FROM matkul WHERE id_matkul='$mat' LIMIT 1"));

?>

<div class="mg_jr_d">
	<b>Jurusan 	:  <?php echo $jurusan['nama_jurusan'] ;?> </b> <br>
	<b>Mengajar : </b><br>

	<div class="mg_mat">
		<div class="clearfix pull-right close delete" data="<?php echo $mat ;?>">×</div>
		<?php echo $matakuliah['nama_matkul'];?><br>
		<div class="mg_kls">Kelas : 
		<?php
		for ($a=0; $a < count($kls)-1; $a++) { 
			$sqlkls 	= "SELECT kelas FROM kelas WHERE id_kelas='".$kls[$a]."' ";
			$querykls	= mysqli_fetch_array(mysqli_query($conn,$sqlkls));

			echo $querykls['kelas'].' ';

		}
		?>		
		</div>
		</div>
</div>

<script>
	$('.delete[data]').click(function(){
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
</script>

<?php 
}else{

require_once('../../404.php');

} ?>
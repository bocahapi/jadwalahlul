<div class="row">
	<div class="col-md-12">
		<div class="head-title">
		<h3>Manajemen Sekretaris Jurusan</h3>
		</div>
	</div>
</div>

<div class="input-dosen-full">
	<form class="form-inline" role="form" action="insert_sekretaris.php" method="post">
	<select  class="form-control width" name="fakultas" id="fakultas">
		<option value="">Plih Fakultas</option>
		<?php $queryFak = mysqli_query($conn,"SELECT * FROM fakultas");
		while ($fakultas = mysqli_fetch_array($queryFak)){?>
		<option value="<?php echo $fakultas['id_fak'];?>"><?php echo $fakultas['nama_fakultas'];?></option>
		<?php } ?>
	</select>
	<select  class="form-control width" name="jurusan" id="jurusan">
		<option value="">Plih Jurusan</option>
		
	</select>
	<select class="form-control width" name="dosen" id="dosen">
		<option value="">Plih Dosen</option>
		
	</select>
	<input type="hidden" name="action" value="sekertaris"/>
	<button type="submit" class="btn btn-danger">Tambah</button>
	</form>

</div>

<hr/>
	<div class="list">		
	<div class="search">
	 <form class="form-inline" role="form" method="GET" action="">
           <div class="form-group">
                <input type="hidden" name="page" value="sekretaris"/>
				<input type="text" id="search" class="form-control" placeholder="Cari Sekretaris ..."/>
	</div>
        
        </form>
	</div>	
		<?php
		// query from database;
		$query = mysqli_query($conn,"SELECT * FROM sekretaris, fakultas,jurusan,users WHERE sekretaris.id_fak=fakultas.id_fak && sekretaris.id_jur=jurusan.id_jur && sekretaris.id_user=users.id_user");
		?>
		<table class='table-bordered full' id="search">
		<tr>
			<th>Fakultas</th>
			<th>Jurusan</th>
			<th>Nama Sekretaris</th>
			<th>Aksi</th>
		</tr>
		<?php
		while ($sekretaris = mysqli_fetch_array($query)){
			echo '<tr class="tr">';
			echo '<td>'.$sekretaris['nama_fakultas'].'</td>';
			echo '<td>'.$sekretaris['nama_jurusan'].'</td>';
			echo '<td>'.$sekretaris['nama'].'</td>';
			echo '<td id="action" data="sekretaris"><a href="#"  data-id="id_sekretaris-'.$sekretaris['id_sekretaris'].'-'.$sekretaris['id_user'].'" title="delete"><i class="fa fa-trash-o"></i></a>  |  <a href="#" data-id="'.$sekretaris['id_sekretaris'].'" title="edit"><i class="fa fa-pencil-square-o"></i></a> </td></tr>';
		}?>
		</table>
	</div>
<script type="text/javascript">
$(function(){
	$("a[title|='edit']").click(function(){
		var ID = $(this).attr('data-id');
		var dataString = "id="+ ID;
		$.ajax({
			type: "POST",
			url: "sistem/read_sekretaris.php",
			data: dataString,
			success: function(result){
				$('.fromupdate').html(result);
				$('#edit').modal();
			}
			
			});
			return false;
		});
		
});
</script>
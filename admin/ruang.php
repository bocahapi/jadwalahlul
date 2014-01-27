<div class="row">
	<div class="col-md-12">
		<div class="head-title">
		<h3>Manajemen Ruang</h3>
		</div>
	</div>
</div>

<div class="input-dosen-full">
	<form role="form" action="query.php">
	<table class='table-bordered set'>
	<tr>
		<td>
			<select class="form-control"  name="fakultas" id="fakultas">
				<option value="">Plih Fakultas</option>
				<?php $queryFak = mysqli_query($conn,"SELECT * FROM fakultas");
				while ($fakultas = mysqli_fetch_array($queryFak)){?>
				<option value="<?php echo $fakultas['id_fak'];?>"><?php echo $fakultas['nama_fakultas'];?></option>
				<?php } ?>
			</select>
		</td>
		<td>
			<select class="form-control"  name="jurusan" id="jurusan">
				<option value="">Plih Jurusan</option>
			</select>
		</td>
		<td>
				<input type="hidden" class="form-control"  name="action" value="ruang" id="ruang" />
				<input type="text" class="form-control"  name="nama" id="add_ruang" placeholder="Nama Ruang" />
			</td>
	</tr>
</table>
<br/>
<button type="submit"  class="btn btn-danger"  class="form-control"> Tambah</button>
	</form>

	</div>

<hr/>
	<div class="list">		
<div class="search">
	<form class="form-inline" role="form" method="GET" action="">
           <div class="form-group">
                <input type="hidden" name="page" value="ruang"/>
                <input type="text" class="form-control" id="search" name="cari" placeholder="Cari Ruangan ..."/>
                
          </div>
         <button type="submit" class="btn btn-primary btn-sm">Cari</button>
        </form>

</div>	
		<?php


		if (isset($_GET['cari'])) {
                $cari = $_GET['cari'];
               $sql = "SELECT * FROM ruangan,jurusan where ruangan.id_jur=jurusan.id_jur AND ruangan.nama_ruang LIKE  '%$cari%'";
               $chois=$sql;  
		}else{
			$sql = "SELECT * FROM ruangan,jurusan where ruangan.id_jur=jurusan.id_jur";

			$chois = $sql." LIMIT $start,$show";
		}
		
		$ruangan = mysqli_query($conn,$chois);

		?>
		<table class='table-bordered half' id="search">
			<tr>
				<th>Nomor</th>
				<th>Nama Ruang</th>
				<th>Jurusan</th>
				<th>Aksi</th>
			</tr>
		<?php
		$i=$no;
		while ($ruang = mysqli_fetch_array($ruangan)){
			echo '<tr class="tr"><td>'.$i++.'</td><td>'.$ruang['nama_ruang'].'</td><td>'.$ruang['nama_jurusan'].'</td><td  id="action" data="ruangan"><a href="#" data-id="id_ruang-'.$ruang['id_ruang'].'" title="delete"><i class="fa fa-trash-o"></i></a>  |  <a href="#" data-id="'.$ruang['id_ruang'].'" title="edit"><i class="fa fa-pencil-square-o"></i></a> </td></tr>';
		}?>
		</table>
	<div class="paginations">
<?php echo paginations($sql,$page,$show) ;?>
	</div>
	</div>
<script type="text/javascript">
$(function(){
	$("a[title|='edit']").click(function(){
		var ID = $(this).attr('data-id');
		var dataString = "id="+ ID;
		$.ajax({
			type: "POST",
			url: "sistem/read_ruang.php",
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
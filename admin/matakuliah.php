<div class="row">
	<div class="col-md-12">
		<div class="head-title">
		<h3>Manajemen Mata Kuliah</h3>
		</div>
	</div>
</div>
<form role="form" action="query.php" method="get">
	<table class='table-bordered set'>
	<tr>
		<td>Fakultas</td>
		<td>
		 <input type="hidden" name="action" value="matkul"/>
		<select class="form-control"  name="fakultas" id="fakultas">
		<option value="">Plih Fakultas</option>
		<?php $query = mysqli_query($conn,"SELECT * FROM fakultas");
		while ($fakultas = mysqli_fetch_array($query)){?>
		<option value="<?php echo $fakultas['id_fak'];?>"><?php echo $fakultas['nama_fakultas'];?></option>
		<?php } ?>
	</select>
	</td>
	</tr>
	<tr>
		<td>Jurusan</td>
		<td>
		<select class="form-control"  name="jurusan" id="jurusan" >
		<option value="">Plih Jurusan</option>
	</select>
		</td>
	</tr>
	
	<tr>
		<td>Semester</td>
		<td>
			<select class="form-control"  type="text" name="semester">
				<option value="">Pilih Semester</option>
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
				<option value="5">5</option>
				<option value="6">6</option>
				<option value="7">7</option>
				<option value="8">8</option>
				<option value="P">Pilihan</option>
			</select>
		</td>
	</tr>
	
	<tr>
		<td>Mata Kuliah</td>
		<td><input class="form-control" type="text" name="nama_matkul" placeholder="Mata Kuliah"/></td>
	</tr>
	<tr>
		<td>Kode Mata Kuliah</td>
		<td><input class="form-control"  type="text" name="kode" placeholder="Kode Mata Kuliah"/></td>
	</tr>
	<tr>
		<td>Jenis Kuliah</td>
		<td><input   type="radio" name="tipe" value="teori" checked/> Teori       <input  type="radio" name="tipe" value="praktik"/> Praktikum</td>
	</tr>
	<tr>
		<td>SKS</td>
		<td><input type="hidden" name="action" value="matkul"/>
		<select class="form-control"  type="text" name="sks">
		<option value="">Pilih SKS</option>
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
		</select>
		</td>
	</tr>
	
	</table>
	<br/>
	<button type="submit"  class="btn btn-danger"  class="form-control"> Tambah</button>
	<button type="reset"  class="btn btn-default"  class="form-control"> Reset</button>
</form>
<hr/>
<script type="text/javascript" src="<?php echo $js;?>insert.js"></script>

	<div class="list">		
<div class="search">
		<form class="form-inline" role="form" method="GET" action="">
           <div class="form-group">
                <input type="hidden" name="page" value="matakuliah"/>
                <input type="text" class="form-control" id="search" name="cari" placeholder="Cari Mata Kuliah ..."/>
                
          </div>
         <button type="submit" class="btn btn-primary btn-sm">Cari</button>
		</form>
</div>	
		<?php
		if (isset($_GET['cari'])) {
                $cari = $_GET['cari'];
               $sql = "SELECT * FROM matkul,jurusan WHERE matkul.id_jur=jurusan.id_jur AND matkul.nama_matkul LIKE  '%$cari%'";
               $chois=$sql;  
		}else{
			$sql = "SELECT * FROM matkul,jurusan WHERE matkul.id_jur=jurusan.id_jur";
			$chois = $sql." LIMIT $start,$show";
		}
		

		$chois = $sql." LIMIT $start,$show";
		$matkulQuery = mysqli_query($conn,$chois);
		?>
		<table class='table-bordered full' id="search">
		<tr>
			<th>No</th>
			<th>Semester</th>
			<th>Kode Mata Kuliah</th>
			<th>Mata Kuliah</th>
			<th>Jurusan</th>
			<th>SKS</th>
			<th>Jenis Kuliah</th>
			<th>Aksi</th>
		</tr>
		<?php
		$i=$no;
		while ($matkul = mysqli_fetch_array($matkulQuery)){
			echo '<tr class="tr">';
			echo '<td>'.$i++.'</td>';
			echo '<td align="center">'.$matkul['semester'].'</td>';
			echo '<td align="center">'.$matkul['kode_matkul'].'</td>';
			echo '<td>'.$matkul['nama_matkul'].'</td>';
			echo '<td>'.$matkul['nama_jurusan'].'</td>';
			echo '<td align="center">'.$matkul['sks'].'</td>';
			echo '<td align="center">'.$matkul['type'].'</td>';
			echo '<td id="action" data="matkul" ><a href="#" data-id="id_matkul-'.$matkul['id_matkul'].'" title="delete"><i class="fa fa-trash-o"></i></a>  |  <a href="#" data-id="'.$matkul['id_matkul'].'" title="edit"><i class="fa fa-pencil-square-o"></i></a> </td></tr>';
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
			url: "sistem/read_matakuliah.php",
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

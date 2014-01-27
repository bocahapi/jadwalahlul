<div class="row">
	<div class="col-md-12">
		<div class="head-title">
		<h3>Manajemen Fakultas dan Jurusan</h3>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-4">
			<ul class="nav nav-tabs" id="tabMenu">
				<li><a href="#fakultas" data-toggle="tab"><i class="fa fa-plus-square"></i> Fakultas</a></li>
			    <li><a href="#jurusan-add" data-toggle="tab"><i class="fa fa-plus-square"></i> Jurusan</a></li>
			  </ul>
			
			    <div class="tab-content">
				<div class="tab-pane active" id="fakultas">
					  <form name="input-fakultas" method="get" action="query.php" role="form">
						<input type="hidden" name="action" value="fakultas"/>
						<div class="form-group">
							<input type="text" class="form-control" id="fakname" name="fakultas" placeholder="Nama Fakultas"/>
						</div>
					
						<button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
					  </form> 
					  
				</div>
				
				<div class="tab-pane" id="jurusan-add">
					  <form method="GET" action="query.php" name="jur" role="form">
					  <input type="hidden" name="action" value="jurusan"/>
						<div class="form-group">
							<select name="fakultas" class="form-control" id="select-fakultas">
								<option value="">Plih Fakultas</option>
								<?php $query = mysqli_query($conn,"SELECT * FROM fakultas");
								while ($fakultas = mysqli_fetch_array($query)){?>
								<option value="<?php echo $fakultas['id_fak'];?>"><?php echo $fakultas['nama_fakultas'];?></option>
								<?php } ?>
							</select>
						</div>
						<div class="form-group">
							<input type="text" class="form-control" id="jrsn" name="jurusan" placeholder="Nama Jurusan"/>
						</div>
						 
						<button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
						
					  </form> 
				</div>
				</div>
		</div>
	<script>
	  $(function () {
	    $('#tabMenu a:first').tab('show')
	  })
	</script>

		<div class="col-md-8">
			<div class="list">
			<div class="row">	
					<div class="search col-md-5">
						<input type="text"  id="search" class="form-control" placeholder="Cari Fakultas dan Jurusan ..."/>
					</div>
			</div>
				<?php
				// query from database;
				$sql = "SELECT * FROM fakultas, jurusan WHERE fakultas.id_fak=jurusan.id_fak";
				$chois = $sql." LIMIT $start,$show";
				$query = mysqli_query($conn,$chois);
				?>
				<table class='table-bordered full' id="search">
				<tr>
				<th>Fakultas</th>
				<th>Jurusan</th>
				<th>Aksi</th>
				</tr>
				<?php
				while ($list = mysqli_fetch_array($query)){
					echo '<tr class="tr"><td id="fak">'.$list['nama_fakultas'].'</td>';
					echo '<td id="jurs">'.$list['nama_jurusan'].'</td>';
					echo '<td id="action" data="jurusan" >';
					
					echo '<a href="#" data-id="id_jur-'.$list['id_jur'].'" title="delete"><i class="fa fa-trash-o"></i></a>  |  <a href="jurusan"  data-id="'.$list['id_jur'].'"  data-toggle="modal" data-target="#edit" title="edit"><i class="fa fa-pencil-square-o"></i></a> </td></tr>';
				}?>
				</table>
			</div>
			<div class="paginations">
			<?php echo paginations($sql,$page,$show) ;?>
		</div>
		</div>
</div>
<script type="text/javascript">
$(function(){
	$("a[title|='edit']").click(function(){
		var ID = $(this).attr('data-id');
		var dataString = "id="+ ID;
		$.ajax({
			type: "POST",
			url: "sistem/read_fakultas.php",
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

<?php 
if(isset($_GET['aksi'])){

$aksi = $_GET['aksi'];
$expl = explode('-',$aksi);
$idhelp = $expl[1];
$helpdata = mysqli_fetch_assoc(mysqli_query($conn,"select * from help where id_help='$idhelp' "));
$title = $helpdata['judul'];
$isi = $helpdata['help'];
$iduser = $helpdata['id_user'];
$button = "update";
$querydata ="sistem/update_help.php";
}else{
$title ="";
$isi ="";
$iduser = $IDUser;
$button = "simpan";
$querydata = "query.php";
}
?>
<div class="row">
	<div class="col-md-12">
		<div class="head-title">
		<h3>Manajemen Informasi</h3>
		</div>
	</div>


<div class="input-dosen-full">
	<form role="form" action="<?php echo $querydata;?>" >
	<div class="form-group">
	<div class="col-md-9">
		<input type="hidden" name="action"value="help"/>
		<input type="hidden" name="idpost"value="<?php echo $idhelp;?>"/>
		<input type="hidden" name="id"value="<?php echo $iduser;?>"/>
		<input type="text" name="titlehelp" class="form-control" size="35" placeholder="Judul" value="<?php echo $title;?>"/>
	</div>
	<div class="col-md-3">
		<button type="submit"  name="<?php echo $button;?>" class="btn btn-danger pull-right"  class="form-control "> <?php echo $button;?></button>
	</div>
		<div class="clear"></div>
	</div>
	
	<div class="form-group col-md-12">
		<textarea class="form-control"  name="help" id="addhelp" cols="30" rows="10"><?php echo $isi;?></textarea>
	</div>
	</form>
	<div class="col-md-12">
		<table class='table-bordered full' id="search">
			<tr>
				<th>Judul</th>
				<th>Isi</th>
				<th>Aksi</th>
			</tr>
		<?php
		$helps = mysqli_query($conn,"Select * from help");
		while($help = mysqli_fetch_array($helps)){
		echo '<tr class="tr">';
				echo '<td>'.$help['judul'].'</td>';
				echo '<td>'.$help['help'].'</td>';
				echo '<td id="action" data="help"><a href="#"  data-id="id_help-'.$help['id_help'].'" title="delete"><i class="fa fa-trash-o"></i></a>  |  <a href="dashboard.php?page=help&aksi=update-'.$help['id_help'].'"  title="edit"><i class="fa fa-pencil-square-o"></i></a> </td></tr>';
		
		}
		?>
		</table>
	</div>
	</div>

</div>

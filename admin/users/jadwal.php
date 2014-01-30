<div class="row">
	<div class="col-md-12">
	<div class="alert-jadwal"></div>
		<div class="head-title">
		<h3>Manajemen Jadwal</h3>
		</div>
	</div>
</div>
<div class="full-screen">
	<div class="overflow">
	<div class="command flow">
		
		<a href="#" title="close" class="pull-right" id="close"><i class="fa fa-times"></i></a>
		
	<div class="clear"></div>
	</div>

	<hr/>
		<div class="overflow-page"></div>
	</div>
</div>


<div class="row">
	<form role="form" action="" method="POST">
	<input type="hidden" id="jab" value="<?php echo $jabatan;?>"/>
	<input type="hidden" id="idm" value="<?php echo $IDUser;?>"/>
	<div class="alert-post col-xs-12"></div>
	<div class="col-xs-5">
		<select  class="form-control" name="fakultas" id="fakultas">
			<option value="">Plih Fakultas</option>
			<?php 
			$sqlfak = "SELECT DISTINCT mengajar.id_jur,fakultas.nama_fakultas,fakultas.id_fak FROM mengajar,fakultas,jurusan where mengajar.id_jur=jurusan.id_jur AND jurusan.id_fak=fakultas.id_fak AND mengajar.id_user = '$IDUser'  ";
			$queryFak = mysqli_query($conn,$sqlfak);
			while ($fakultas = mysqli_fetch_array($queryFak)){
	
			echo '<option value="'.$fakultas['id_fak'].'">'.$fakultas['nama_fakultas'].'</option>';
		 } ?>
		</select>
	</div>
	
	<div class="col-xs-4">
		<select    class="form-control jurusan" name="jurusan" id="jurusan">
			<option value="">Plih Jurusan</option>
		</select>
	</div>			
	<div  class="btn btn-danger"  id="lihat" class="form-control">Lihat</div>
	<div class="btn btn-success" id="addnew">Request Jadwal</div>
	</form>
</div>
<div class="clear"></div>
<script type="text/javascript">
$(function(){
	$('#lihat').click(function(){
		$('#menu').hide();
		fakultas = $('#fakultas').val();
		jurusan  = $('#jurusan').val();

		if(fakultas == ''){
			$('.alert-post').html('Mohon Pilih Fakultas terlebih dahulu');
		}else if(jurusan == ''){
			$('.alert-post').html('Mohon Pilih Jurusan terlebih dahulu');
		}else{
			$.ajax({
				type:'POST',
				url :'users/list_jadwal.php',
				data :{fakultas : fakultas,jurusan:jurusan},
				beforeSend:function(){
					$('.jadwalfull').html('Mohon Tunggu .....');
				},
				success:function(result){
					$('.jadwalfull').fadeIn('slow', function() {
						$('#menu').show();
						$(this).html(result);

					});
				}
			}); return false;
		}
			
	});

	$(document).on('click','#addnew',function(event){
		event.preventDefault();
		
		fakultas = $('#fakultas').val();
		jurusan  = $('#jurusan').val();
		idm 	 = $('#idm').val();
		if(fakultas == ''){
			$('.alert-post').html('Mohon Pilih Fakultas terlebih dahulu');
		}else if(jurusan == ''){
			$('.alert-post').html('Mohon Pilih Jurusan terlebih dahulu');
		}else{
			$.ajax({
				type:'POST',
				url :'users/form_jadwal.php',
				data :{fak : fakultas,id:jurusan,im:idm},
				success:function(result){
					$('#addnew-modal').modal();
					$('#addnew-modal').css('display','block');
					$('.add-jadwal').html(result);
				}
			});
			return false;
		};
	});

	var Height = $('td#jam').height();
	$('td#a').css("height",Height);
	var w = $('#c').width();
$('tr#blank').children('#c').width(w);
});
</script>

<div class="modal-dialog" id="addnew-modal">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Request Jadwal</h4>
      </div>
      <div class="modal-body">
		<div class="add-jadwal" id="addjad">
			
		</div>
		</div>
	</div>
</div>


<hr/>

<div class="command" id="menu" style="display:none">
	<div class="btn btn-success btn-sm" id="fullscreen"><i class="fa fa-external-link"></i> Tampilan Penuh</div>
</div>
<div class="jadwalwin col-xs-12">
	<div class="jadwalfull ">

	</div>
</div>

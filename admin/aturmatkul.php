<div class="row">
	<div class="col-md-12">
		<div class="head-title">
		<h3><i class="fa fa-user"></i> Atur Mata Kuliah</h3>
		</div>
	</div>
</div>
<hr/>

<form action="" id="updatemat" role="form">
<div class="form-inline">
  
      <div class="form-group">
        <div class="btn btn-primary btn-sm sort" id="all"> Semua </div>
      </div>
  
      <div class="form-group">
        <div class="btn btn-info btn-sm sort" id="genap"> Genap </div>
      </div>
  
      <div class="form-group">
        <div class="btn btn-warning  btn-sm sort" id="ganjil"> Ganjil </div>
      </div>
  
      <div class="form-group">
        <div class="btn btn-danger btn-sm" id="not-undf">  Sisa  </div>
      </div>
  
         <div class="form-group">
            <select name="action"  class="form-control input-sm" id="aksi">
             <option value="">Pilih Aksi</option>
             <option value="genap">Genap</option>
             <option value="ganjil">Ganjil</option>
             <option value="delete">Hapus</option>
           </select>
         </div>
  
      <div class="form-group">
        <div class="btn btn-primary btn-sm" id="save">  Simpan  </div>
      </div>
</div>
  <div class="clear"></div>
  <br/>  
  <table class="table table-striped">
    <tr>
      <th><input type="checkbox" name="opsi" class="all_opsi" sort-data=""></th>
      <th>KODE</th>
      <th>Mata Kuliah</th>
      <th>Semester</th>
      <th>SKS</th>
      <th>Tipe</th>
    </tr>
    <?php 
    $sql = "SELECT * FROM matkul Where id_jur = '$new_jur' ";
    $sqlQuery = mysqli_query($conn,$sql);
    while($mat = mysqli_fetch_array($sqlQuery)){?>
    <tr class="<?php echo $mat['session'];?> matkul all">
      <td><input class="check" type="checkbox" name="opsi[]" value="<?php echo $mat['id_matkul'];?>"></td>
      <td><?php echo $mat['kode_matkul'];?> <span class="box<?php echo $mat['session'];?>" title="<?php echo $mat['session'];?>"></span></td>
      <td><?php echo $mat['nama_matkul'];?></td>
      <td><?php echo $mat['semester'];?></td>
      <td><?php echo $mat['sks'];?></td>
      <td><?php echo $mat['type'];?></td>
    </tr>
    <?php }?>
    
  </table>
</form>

<script>
  $('.all_opsi').click(function(){
    if(!$(this).hasClass('checked')){
        $(this).addClass('checked');
        sort = $(this).attr('sort-data');
        $('input.check[sort-data^='+sort+']').prop('checked', true);
  }else{
    $(this).removeClass('checked');
    $('input.check').prop('checked', false);
  }
  });

  /*Sort data ganjil dan genap*/
  $('.sort').click(function() {
    ClassId = $(this).attr('id');
    $('.all_opsi').removeClass('checked');
    $('.all_opsi,.check').attr('sort-data',ClassId);
    $('input').prop('checked', false);
      
      $('tr.matkul').each(function(index, el) {
        if($(this).hasClass(ClassId)){
          $(this).fadeIn();
        }else{
          $(this).fadeOut();
          $(this).find('input.check').attr('sort-data','#');
        }
      });
    
  });

  $('#not-undf').click(function(){
    $('tr.matkul').each(function(index, el) {
        if($(this).hasClass('ganjil') || $(this).hasClass('genap')){
          $(this).fadeOut();
        }else{
          $(this).fadeIn();
        }
      });
  });

//save function
 $('#save').click(function(){

  if($('select#aksi').val() == ''){

    alert('Pilih Aksi');
  
  }else if($('tr td').children(':checked').length < 1){

      alert('tidak ada aksi');
  
    }else{
  
    datamat = $(this).parents('#updatemat').serialize();
        
       $.ajax({
          url:'sistem/update_matkul.php',
          type:'POST',
          data:datamat,
          success:function(result){
            if(result == 'true'){
              location.reload(true);
            }else{
              alert('Something Wrong');
            }

          }
       });
  
    }
 });
</script>
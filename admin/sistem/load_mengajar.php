<?php
session_start();
if(isset($_SESSION['sesi'])){
  $session = $_SESSION['sesi'];
}
include('../../connectdb.php');
if(isset($_POST['add'])){
 $new_jur = $_POST['jur'];
 $jabatan = $_POST['jab'];
?>

<form action="" role="form" id="form_new">
    
    <div title="hapus" id="hapus_datax" class="close"><i class="fa fa-times pull-right "></i></div>

    <br clear="all"/>    
    
        <table class="full">
    
          <tr>
    
             <td id="title-td">Mengampu</td>
    
             <td>
    
                <div class="form-group">
    
                <?php
                if($jabatan != 'Sekjur'){?>
                  <select name="jurusan[]" id="jur_select" sel="jur" class="form-control input-sm dt_dsn" >
                      <option value="">Pilih Jurusan</option>
                     <?php
                      $jurs     = "SELECT * FROM jurusan";
                      $query_jur  = mysqli_query($conn,$jurs);
                      while ($jurname = mysqli_fetch_array($query_jur)) {
                           echo '<option value="'.$jurname['id_jur'].'">'.$jurname['nama_jurusan'].'</option>';
                       } 
                      ?>
                  </select>
    
                  <?php }else{ ?>
    
                      <input type="hidden" name="jurusan[]" value="<?php echo $new_jur?>"> 
    
                  <?php }?>
    
                </div>

               <div class="form-group">
    
                  <select name="matakuliah[]" id="fak_new" class="form-control input-sm dt_dsn">
    
                      <option value="">Pilih Mata Kuliah</option>
    
                      <?php
    
                          if ($new_jur == ''){
    
                              $matkul = "SELECT * FROM matkul WHERE session = '$session' "; 
    
                          }else{

                              $matkul = "SELECT * FROM matkul WHERE id_jur='$new_jur' AND session = '$session' ";

                          }

                      $query_mat  = mysqli_query($conn,$matkul);
                      while ($matname = mysqli_fetch_array($query_mat)) {
                           echo '<option value="'.$matname['id_matkul'].'">'.$matname['nama_matkul'].'</option>';
                       } 
                      ?>
                  </select>
                </div>
               
               <div class="kelasbox">
                <?php
                   $kls = "SELECT * FROM kelas";
                   $query_kls = mysqli_query($conn,$kls);
                   while ($klsname = mysqli_fetch_array($query_kls)) {
                       echo '<label class="checkbox-inline"><input type="checkbox"value="'.$klsname['id_kelas'].'" name="kelas[]"> '.$klsname['kelas'].'</label>';
                   }
                 ?>  
               </div>

                   <input type="hidden" name="kelas[]" value="_kls">
              </td>
         </tr>
               <script>

               /* to delete matkul has been selected */
               $('div#hapus_datax[title^=hapus]').click(function(){
                        $(this).parent('form').remove();

                }); 

                /* dispay Matkul in Jurusan , when choise a jurusan */
                $('#jur_select[class]').change(function(){

                    thePar = $(this).parents('table.full');
                    nilai = $(this).children('option:selected').val();
                  
                    $.ajax({
                      url:'sistem/loadjur.php',
                      type:'post',
                      data:{jurusan:nilai},
                      success:function(result){
                        
                        thePar.find('#fak_new').html(result);

                      }
                    }); // End Of Ajax

                }); // End Of Click Function


                /*to check kelas stock's when matkul choise*/

                $('#fak_new[class]').change(function(){

                    thePar = $(this).parents('table.full');
                    nilai = $(this).children('option:selected').val();

                    $.ajax({

                      url:'sistem/loadkelas.php',
                      type:'post',
                      data:{id_mat:nilai},
                      success:function(result){
                        thePar.find('.kelasbox').html(result);
                      }

                     }); // End Of Ajax
                    
                });//End Of Click Function

                $('#simpan').on('click',function(){

                  id_dosen = $('#id_dosen').val();
                  Mengampu = $('#form_new').serialize();
                  data     = 'id_dosen='+id_dosen+'&'+Mengampu;
                  
                  if($('#jur_select').val() == ''){

                     alert('Mohon pilih Jurusan');
                 
                    }else if($('#fak_new').val() == ''){

                     alert('Mohon tentukan Mata kuliah');

                    }else if($('.kelasbox input:checked').length < 1){

                      alert('Mohon Pilih beberapa Kelas');
                      
                    }else{
                    
                   $.ajax({
                      url:'sistem/queryeditdosen.php',
                      type:'POST',
                      data:data,
                      success:function(result){
                        $('.add_new_mat').html('');
                        $('.list_aa').prepend(result);
                      }

                    }); // End Of Ajax

                  }
                  
                });

               </script>
        </table>
<div class="btn btn-sm btn-success" id="simpan" style="display:none">Simpan</div>
    </form>
<?php
 }

?>
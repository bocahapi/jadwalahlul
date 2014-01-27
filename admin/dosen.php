<div class="row">
        <div class="col-md-12">
                <div class="head-title">
                <h3>Manajemen Dosen</h3>
                </div>
        </div>
</div>


<!-- Navigasi Menu tab -->
<ul class="nav nav-tabs" id="Dosen-list">
  <li class="active"><a href="#semua_dosen" data-toggle="tab"><i class="fa fa-users"></i> Semua Dosen</a></li>
  <li><a href="#Tambah" data-toggle="tab"><i class="fa fa-plus-square"></i> Tambah Dosen</a></li>
</ul>
<div class="tab-content">

    <!-- Tab Daftar Semua Dosen -->
    <div class="tab-pane active" id="semua_dosen" style="font-weight:normal">
         <div class="list">
        <div class="search">
        
        <form class="form-inline" role="form" method="GET" action="">
           <div class="form-group">
                <input type="hidden" name="page" value="dosen"/>
                <input type="text" class="form-control" id="search" size="80" name="cari" placeholder="Cari Dosen ..."/>
                
          </div>
         <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-search"></i>  Cari  </button>
        </form>
        </div>        
                <table class='table-bordered full ' id="search">
                <tr>
                        <th>Nomor</th>
                        <th>ID Dosen</th>
                        <th>Nama</th>
                        <th>Status Dosen</th>
                        <th>Aksi</th>
                </tr>
        
                <?php
                
                if (isset($_GET['cari'])) {
                $cari = $_GET['cari'];
                $sql ="SELECT * FROM users,status_dosen WHERE users.id_status=status_dosen.id_status AND users.id_level != 1 AND users.nama LIKE  '%$cari%'";
                $chois=$sql;                        
                }else{
                $sql ="SELECT * FROM users,status_dosen WHERE users.id_status=status_dosen.id_status AND users.id_level != 1";
                 $chois= $sql." LIMIT $start,$show";
                }
               
        $daftarDosen = mysqli_query($conn,$chois);
        if(mysqli_num_rows($daftarDosen) < 1 ) {
                echo '<tr class="tr"><td colspan="5" align="center"><i>Maaf,</i> Nama yang anda inginkan belum terdaftar</td></tr>';
        }else{}
        $i = $no ;
                while($dosen = mysqli_fetch_array($daftarDosen)){
               
                echo "<tr class='tr'><td>".$i++."</td><td>".$dosen['NIDN']."</td><td>".$dosen['nama']."</td><td>".$dosen['stats_dosen']."</td><td id='action' data='users'><a href='#' data-id='id_user-".$dosen['id_user']."' title='delete'><i class='fa fa-trash-o'></i></a> | <a href=# data-id='".$dosen['id_user']."' title='edit'><i class='fa fa-pencil-square-o'></i></a></td></tr>";
               
        }
                ?>
                </table>
                <div class="paginations">
                        <?php echo paginations($sql,$page,$show) ;?>
                </div>
        </div>
    </div>

                                <!-- Tab tambah dosen -->
<div class="tab-pane" id="Tambah">
<div class="add_new_dsn">
    <form role="form" id="inp-dosen" action="query.php" method="GET" class="col-md-6">
        <table class="full">
            <tr>
                <td id="title-td">ID Dosen</td>
                <td>
                    <input id="id" type="hidden" name="action" value="dosen"/>
                    <div class="form-group">
                        <input id="id" class="form-control input-sm dt_dsn" type="text" name="NIDN" placeholder="Masukkan NIK Dosen Sebagai ID nya !"/>
                    </div>
                </td>
            </tr>
            <tr>
                <td id="title-td">Nama Lengkap</td>
                <td>
                    <div class="form-group">
                        <input id="nama"  class="form-control input-sm dt_dsn" type="text" name="nama" placeholder="Nama Lengkap dan Gelar"/>
                    </div>
                </td>
            </tr>
            
    
            <tr>
                <td id="title-td">Status Dosen</td>
                <td>
                    <div class="form-group">
                        <select class="form-control input-sm dt_dsn" name="status" id="status">
                            <option value="">Status</option>
                            <?php
                            $query = mysqli_query($conn,"SELECT * FROM status_dosen");
                            while( $status = mysqli_fetch_array($query)){
                                ?><option value="<?php echo $status['id_status'];?>"><?php echo $status['stats_dosen'];?> </option>;
                            <?php }                ?>
                        </select>
                    </div>
                </td>                       
            </tr>
    
            <tr>
                <td id="title-td">Username</td>
                <td>
                    <div class="form-group">
                        <input id="user" class="form-control input-sm dt_dsn" type="text" autocomplete="off" name="user" placeholder="Username"/>
                    </div>
                </td>
            </tr>
            <tr>
                <td id="title-td">Password</td>
                <td>
                    <div class="form-group">
                        <input id="pass" class="form-control input-sm dt_dsn" type="password" placeholder="Password" name="pass"/>
                    </div>
                </td>
            </tr>
        </table>
    </form>
    <div class="col-md-6" id="form_add">
    <?php if(!isset($new_jur)){
        $new_jur ='';
    }?>
         <!-- form add new matkul -->       
    <div class="btn btn-link btn-sm" id="add_new_mat" data="<?php echo $new_jur;?>" jabatan="<?php echo $jabatan;?>"> Tambah Mata Kuliah </div>
    </div>       
           
    <div class="clear"></div>
    <div id="submit" class="btn btn-primary pull-right">Simpan</div>
    <div class="clear"></div>
    
    </div>
  </div>

  <div id="result"></div>
</div>
<script type="text/javascript">
$(function(){
    $('#Dosen-list a:first').tab('show');
$('.multiselect').multiselect();
     $("a[title|='edit']").click(function(){
        var ID = $(this).attr('data-id');
        var dataString = "id="+ ID;
        $.ajax({
                type: "POST",
                url: "sistem/read_dosen.php",
                data: dataString,
                success: function(result){
                        $('.fromupdate').html(result);
                        $('#edit').modal();
                }
                
                });
                return false;
        });

     $('#add_new_mat').click(function(){
        par  = $(this);
        datv = par.attr('data');
        datJ = par.attr('jabatan');
        $.ajax({
            url:'sistem/load_mengajar.php',
            type:'post',
            data:{add:'add',jur:datv,jab:datJ},
            success:function(result){
                par.before(result);
                
            }
        });
        

     });
/* Saving data to database*/
$('#submit').click(function(){
    data = $('.add_new_dsn,#form_add').children('form').serialize();
    
    all = $('.dt_dsn').length; 

    /* checking form input dosen, if form not have value, this form will highlight */
   $('input[type=text],input[type=password],select').each(function(index, el) {
        if($(this).val()==''){
            $(this).css('border', 'red 1px solid').addClass('_error');
        }else{
           $(this).removeClass('_error');
           $(this).css('border', '#ccc 1px solid').addClass('_valid');
        }
    });
    
    /* count form add Jurusan and Matakuliah*/
    form_new = $('#form_add #form_new').length;
    valid    = $('._valid').length; 

    /* if form jur and matakuliah  less of 1, this output is wrong */
    
    if( all == valid ){

        if(form_new < 1){
            $('#result').html('mohon tambah matakuliah');
        } else {
         
            checked = $('#form_add #form_new input:checked').length;
       
                if(checked < 1){
                    $('#result').html('mohon tambah kelas');
                }else{
            //console.log(data);
                $.ajax({
                    url:'query.php',
                    data:data,
                    success:function(result){
                        $('#result').html(result);
                        location.reload(true);
                    }

                 });
                }
            }
        }else{
            $('#result').html('Lengkapi form yang berwarna merah...');
    }


});
        
});
</script>
<div class="master_mat" style="display:none">
    
</div>
 
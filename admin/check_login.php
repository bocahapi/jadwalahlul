<?php
session_start();
require_once('../connectdb.php');

if(!isset($_POST['username-login'])){
        header('location:../');
}


$username = $_POST['username-login'];
$password = $_POST['password-login'];

if($username == '' && $password == ""){
        echo '<div class="alert alert-info">Form Username dan Password Tidak Boleh Kosong</div>';
}else if(!$username == '' && $password == ''){
        echo '<div class="alert alert-info">Form Password Tidak Boleh Kosong</div>';
}else if($username == ''&& !$password == ''){
        echo '<div class="alert alert-info">Form Username Tidak Boleh Kosong</div>';
}else{

$ses  = mysqli_query($conn,"SELECT * FROM config WHERE setting='TA'");
$sess = mysqli_fetch_assoc($ses);       
        $password = md5($password);        //encrytion password
        
$sql = "SELECT * FROM users,user,status_dosen WHERE users.id_level= user.id_level AND users.id_status = status_dosen.id_status AND users.username = '$username' AND users.password = '$password'";
                
$query = mysqli_query($conn, $sql);
        
$check = mysqli_num_rows($query);
        
        if($check == 1){
                
                #checking Tahun Ajaran, apakah ganjil atau genap
                $_SESSION['sesi'] = $sess['value'];

                $member = mysqli_fetch_assoc($query);
                $id_member = $member['id_user'];

                if($member['level'] == 'Dosen'){
                        $checktwo = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM config WHERE setting='Request' "));
                        if($checktwo['value'] == "on"){
                        
                        $now    = date('m/d/Y');
                        $start  = $member['tgl_mulai'];
                        $end    = $member['tgl_selesai'];

                        $startDate = strtotime($start);
                        $endDate   = strtotime($end);
                        $usrDate   = strtotime($now);

                        if( ($usrDate >= $startDate) && ($usrDate >= $endDate)){
                                                        echo '<div class="alert alert-warning"> Periode Login Anda Telah Habis Silahkan Hubungi Admin</div>';
                                                }else{

                                                $_SESSION['username'] = true;                
                                                $_SESSION['password'] = true;                                
                                                $_SESSION['id_user'] = $id_member;             
                                               
                                                echo 'true';
                                                }
                        }else{
                                echo '<div class="alert alert-warning"> Periode Login Anda Telah Habis Silahkan Hubungi Admin</div>';
                        
                        }

                }else if( $member['level'] == 'Sekjur'){
                        $id_sekretris = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM sekretaris WHERE id_user ='$id_member' "));
                        if (!$id_sekretris) {
                                echo "Erro";
                                exit;
                        }
                        $_SESSION['username'] = true;                
                        $_SESSION['password'] = true;                              
                        $_SESSION['id_user']  = $id_member;        
                        echo 'true';
                }else{

                        $_SESSION['username'] = true;                
                        $_SESSION['password'] = true;                              
                        $_SESSION['id_user'] = $id_member;
                        echo 'true';

                        }
                
        }else{
                
                echo '<div class="alert alert-warning"> Username dan Password Anda Salah</div>';
        
        }
        
        }

?>
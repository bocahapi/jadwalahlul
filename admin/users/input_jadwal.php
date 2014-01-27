<?php
session_start();
require_once('../../connectdb.php');

$id_user  = $_POST['im'];
$hari     = $_POST['hari'];
$jam      = $_POST['jam'];

/* Create Array to sclie option ID from matkul 
* in the Select option tag's be found two variable from id_matkul and id_kelas.
* then we will separate the variables with explode functions 
*/
$matkls   = explode('-', $_POST['matkul']);

$matkul   = $matkls[0]; // id_matkul
$kelas    = $matkls[1]; // id_kelas
$semester = $matkls[2]; // semester

$fakultas = $_POST['fakultas'];
$jurusan  = $_POST['jurusan'];
$ruang    = $_POST['ruang'];

/* To look for the SKS in the table matkul */
$the_sks = mysqli_query($conn,"SELECT type,sks FROM matkul WHERE id_matkul = '$matkul'");
if(!$the_sks){
        echo 'error check';
        exit;
}

$sks_find = mysqli_fetch_assoc($the_sks);

/* To Seek last Time ( jam ) of the Matkul will be End */
$hour =$jam+$sks_find['sks']-1;

/* To check whether the User has the same Schedule elsewhere */
$checkjadwal = mysqli_query($conn,"SELECT * FROM jadwal WHERE id_hari = '$hari' AND jam BETWEEN	 '$jam' AND '$hour' AND id_user='$id_user' ");

$valid = mysqli_num_rows($checkjadwal);

if($valid == 0){
/*
  if the user not have Schedule elsewhere. the sistem will checking the room has been select by the user has selected by other; 
*/
        $checkjadwaldua = mysqli_query($conn,"SELECT * FROM jadwal WHERE id_hari = '$hari' AND jam BETWEEN '$jam' AND '$hour' AND id_ruang= '$ruang' AND id_jur='$jurusan' ");
        $validdua = mysqli_num_rows($checkjadwaldua);
}else{
        echo "<b>Maaf Anda Memiliki Jam Mengajar Di lokasi lain pada Jam yang anda pilih</b>";
exit;
}
if($validdua == 0){ 
/*
  if the room is empty from other people. the sistem will checking 
*/   
$checkjadwaltiga = mysqli_query($conn,"SELECT * FROM jadwal WHERE id_hari = '$hari' AND id_jur= '$jurusan' AND id_kelas='$kelas'  AND jam BETWEEN  '$jam' AND '$hour' AND semester ='$semester' ");

  $validtiga = mysqli_num_rows($checkjadwaltiga);

}else{

echo " <b>Ruang yang Anda pilih sudah ada yang mengisi</b>";

exit;

}

if ($validtiga != 0) { 

 	echo "<b>kelas yang Anda Pilih sudah di pilih sebelumnya</b>";

 	exit;
}


/*
  checking type of matkul. if matkul type's is praktik jam will * 2 
*/

$type = $sks_find['type'];

if($type == 'praktik'){
  $count = $sks_find['sks']*2;
}else{
  $count = $sks_find['sks'];
}

$jsks     = $count;
$rangejam = $jam+$jsks-1; //jam 1 = $jam + 3sks $sks -1
$jamk     = $jam.'-'.$rangejam; //hasil report jam 1-4

/*insert into  table jadwal_full*/
$sql = "INSERT INTO jadwal_full (jamkelas,id_user,id_hari,id_matkul,id_kelas,id_ruang,id_fak,id_jur,semester) VALUES ('$jamk','$id_user','$hari','$matkul','$kelas','$ruang','$fakultas','$jurusan','$semester')";
$inserttwo=mysqli_query($conn,$sql);
if(!$inserttwo){

        echo "<b>Maaf Terjadi Kegagalan pada Sistem</b>";
        exit;
}

/*after all the values will insert into table jadwal */
for($loop=1;$loop<=$count;$loop++){
$insert = mysqli_query($conn,"INSERT INTO jadwal (id_hari,jam,id_user,id_kelas,id_matkul,id_fak,id_jur,id_ruang,semester)
Values
('$hari',' ".$jam++." ','$id_user','$kelas','$matkul','$fakultas','$jurusan','$ruang','$semester')");
}
if(!$insert){
        echo "<b>Maaf Terjadi Kegagalan pada Sistem</b>";
}else{
        /*set off matkul selected*/
        mysqli_query($conn,"UPDATE mengajar SET status ='off' WHERE id_user='$id_user' AND id_matkul='$matkul' AND id_kelas='$kelas' ");

        echo "<b>Input Jadwal Berhasil......</b>";
}

?>
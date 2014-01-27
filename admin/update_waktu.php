<?php
require_once('../connectdb.php');
$id = array ($_POST['id1'],$_POST['id2'],$_POST['id3']);
$idn=count($id);
$start = array ($_POST['start1'],$_POST['start2'],$_POST['start3']);
$end = array ($_POST['end1'],$_POST['end2'],$_POST['end3']);

$n=0;
$m=0;
$p=0;
for($input=0;$input<=$idn-1;$input++){

 $update = mysqli_query($conn,"Update  status_dosen Set tgl_mulai='".$start[$n++]."', tgl_selesai='".$end[$m++]."' Where id_status='".$id[$p++]."' ");

}
if(!$update){
echo "error";
}else{
header('location:../admin/dashboard.php?page=settwaktu');
}
?>
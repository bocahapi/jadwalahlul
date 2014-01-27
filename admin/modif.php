<?php
require_once('../connectdb.php');
if(!isset($_POST['action']) || $_POST['action'] == ''){

	header('location:../');

}else{

$act = $_POST['action'];
$tableid = $_POST['id'];
$test = explode("-",$tableid);
$coloum= $test[0];//kolom
$id=$test[1];

$table = $_POST['data'];//table

		if($act == 'delete'){
			$dataRow = "Delete From $table Where $coloum= '$id'";
			$query = mysqli_query($conn,$dataRow);
			
			if(!$query){
			
				echo"Gagal Delete";
			
			} else {
			
				echo "true";
			}
		if($table == 'sekretaris'){
				$idu=$test[2];
				$update = mysqli_query($conn,"UPDATE users Set id_level = 2 where id_user = '$idu'");
				if(!$table){
				echo "Gagal Delete";
				}
			}
		}
}

?>
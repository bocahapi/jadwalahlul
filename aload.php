<?php
if(defined('Akses')){

$sqlkls      = "SELECT id_kelas From Kelas";

$queryksl    = mysqli_query($conn,$sqlkls);

$num_kls     = mysqli_num_rows($queryksl);

$sqlmatkul   = "SELECT id_matkul FROM matkul";
$querymatkul = mysqli_query($conn,$sqlmatkul);

$num_matkul  = mysqli_num_rows($querymatkul);

if( $num_matkul >= 1 ){#check Condition

		#loop to make array
		$matid = array();
		while($matkul = mysqli_fetch_array($querymatkul)){
			$matid[] = $matkul['id_matkul'];
		}
		#end loop


	for ($i=0; $i < $num_matkul ; $i++) {#loop to check one by one of ID

		$sql_c   = "SELECT id_matkul FROM mengajar WHERE id_matkul='".$matid[$i]."'";
	
		$query_c = mysqli_query($conn,$sql_c);
	
		$num_matkul_c = mysqli_num_rows($query_c);

		#condition to update table with on or off
		if($num_matkul_c == $num_kls){

			$updmat = "UPDATE matkul SET status = 'off' WHERE id_matkul='".$matid[$i]."' ";

			$update = mysqli_query($conn,$updmat);

		}else{
			$updmat = "UPDATE matkul SET status = 'on' WHERE id_matkul='".$matid[$i]."' ";

			$update = mysqli_query($conn,$updmat);
		}#end condition

	}#end check

}else{

		return $num_matkul;
	
}#end check

}else{
	
	#if this file opened by url this file will be 404 error;

	require_once('404.php');
}
<?php
include('../../connectdb.php');

if(!isset($_POST['id_mat'])){
	require_once('../../404.php');
}else{
	$id_mat = $_POST['id_mat'];

	$sqlmat	 	= "SELECT id_kelas FROM mengajar WHERE id_matkul = '$id_mat' ";
	$querymat	= mysqli_query($conn,$sqlmat);
	$nummat		= mysqli_num_rows($querymat);

 	# To display Kelas form table kelas

 	$sqlkls 	= "SELECT * FROM kelas ";
 	$querykls	= mysqli_query($conn,$sqlkls);
 	$numkls		= mysqli_num_rows($querykls);
	
	if( $nummat >= 1 ){
	
	# Make id Kelas to Array,.

		$kelas 		= array();
		while ($kls = mysqli_fetch_array($querymat)) {
		   $kelas[] = $kls['id_kelas'];
		}

		 # loop with  while functions;
		 
	 	while($name = mysqli_fetch_array($querykls)){

			if(in_array($name['id_kelas'], $kelas)){
				
			}else{
				 echo '<label class="checkbox-inline 2"><input type="checkbox"value="'.$name['id_kelas'].'" name="kelas[]"> '.$name['kelas'].'</label>';
			}
			
		}



	}else if($nummat == $numkls){

		echo "kelas telah habis";
	
	}else{

		while ($name = mysqli_fetch_array($querykls)) {

		    echo '<label class="checkbox-inline 3"><input type="checkbox"value="'.$name['id_kelas'].'" name="kelas[]"> '.$name['kelas'].'</label>';

		}		

	}


}
?>
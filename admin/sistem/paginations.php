<?php
function paginations ($num,$page,$show){
	include('../connectdb.php');
	
	if(isset($_GET['num'])){
		
		$a = $_GET['num'];

	}else{

		$a = 1;
}

if(!isset($page)){
	$page = 'fakultas';
}

	$next  = $a + 1;
	$prev  = $a - 1;

	$count = mysqli_num_rows(mysqli_query($conn,$num));

	if($show < $count){
echo '<ul class="pagination">';
if($a > 1 ){
echo '<li><a href="dashboard.php?page='.$page.'&num='.$prev.'">&laquo;</a></li>';
}
	$n=1;
	$m=1;
		for($p=0;$p<ceil($count/$show);$p++){
		if($a == $m){
			echo '<li><a href="dashboard.php?page='.$page.'&num='.$m++.'" class="active">'.$n++.'</a></li>';
			}else{
			echo '<li><a href="dashboard.php?page='.$page.'&num='.$m++.'">'.$n++.'</a></li>';
			}
		}
if($a < ceil($count/$show) ){
echo '<li><a href="dashboard.php?page='.$page.'&num='.$next.'">&raquo;</a></li>';
}
echo '</ul>';
}
}
?>
<?php
/*Error Log */
include '../debug.php';

require_once('header.php');
require_once('sistem/paginations.php');

?>


<div class="navigations">
	<nav class='navigation'>
	<?php
	/* Navigations Menu */
				$count = count($nav);
				echo "<ul>";
				for ($i=0; $i<$count; $i++){

					/* Pengkodisian secara spesifik */

					if($nav[$i]['menu'] == 'Panduan' || $nav[$i]['menu'] == 'Kuisioner' ){
						$target_url = 'target="_blank"';
					}else{
						$target_url='';
					}
						print "<li><a href=\"{$nav[$i]['url']}\" ".$target_url.">".$nav[$i]['menu']."</a></li>";
				}
				echo "</ul>";
	?>
	</nav>
</div>

<script type="text/javascript">
$(function(){
$(window).scroll(function() {
        if ($(this).scrollTop() > 75) {
           $('.navigation').css('position','fixed');
        } else {
           $('.navigation').css('position','inherit');
        }
});

});
</script>

<section class="contain">
<div class="notife"></div>
<!--- content -->
<?php
$show = 10;
if(!isset($_GET['num']) || $_GET['num'] == 1){
	$start = 0;
	$no = 1;
}else{
	$number = $_GET['num'];
	$start = ($number - 1)* $show;
	$no = ($show*$number)-($show-1);
}
 if(isset($_GET['page'])) {
 $page = htmlentities(htmlspecialchars($_GET['page']));
 }else{
 $page = '';
 }
	if($jabatan == 'Administrator' ){

		if($page == '') $page = 'fakultas';

		if(file_exists($page.'.php')){
				require_once($page.'.php');
		}else{
		ob_start();
		header('location:../admin/dashboard.php');
		ob_clean();		
		}
	}else if($jabatan == 'Sekjur'){
		
		if($page == '') $page = 'profile';
			if(file_exists($page.'.php')){
		
				require_once($page.'.php');
				}else if(file_exists('users/'.$page.'.php')){
				require_once('users/'.$page.'.php');
				}else{
					ob_start();
					header('location:../admin/dashboard.php');
					ob_clean();	
				}
		}else{
		 if($page == '') $page= 'profile';
			if(file_exists('users/'.$page.'.php')){
			
					require_once('users/'.$page.'.php');
			}else{
				ob_start();
				header('location:../admin/dashboard.php');
				ob_clean();			
			}
		}
		
?>
<!-- content -->
</section>
<?php

require_once('footer.php');
?>
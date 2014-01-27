<?php
error_reporting(0);
function report_error($_level, $err_str, $err_file, $err_line){
	$value = array(
		E_ERROR	  			=> 'E_ERROR',
		E_WARNING 			=> 'BAHAYA',
		E_PARSE 			=> 'E_PARSE',
		E_NOTICE 		 	=> 'E_NOTICE',
		E_CORE_ERROR 	 	=> 'E_CORE_ERROR',
		E_CORE_WARNING 	 	=> 'E_CORE_WARNING',
		E_COMPILE_ERROR 	=> 'E_COMPILE_ERROR',
		E_COMPILE_WARNING  	=> 'E_COMPILE_WARNING',
		E_USER_ERROR  		=> 'E_USER_ERROR',
		E_USER_WARNING  	=> 'E_USER_WARNING',
		E_USER_NOTICE 		=> 'E_USER_NOTICE',
		E_STRICT 			=> 'E_STRICT',
		E_RECOVERABLE_ERROR => 'E_RECOVERABLE_ERROR',
		E_ALL 				=> 'E_ALL',
	);
	$data =  date('j/m/y H:i:s')." | ".$value[$_level] ."|".$err_str."|".$err_file."|".$err_line.PHP_EOL;

	/*create file*/
	$file = '../log.txt';
	$open =fopen($file, 'a');
	fwrite($open, $data);
//	file_put_contents($file, $data, FILE_APPEND);
	fclose($open);


}

/* set error with error handler*/
$error = set_error_handler('report_error',E_ALL);


?>
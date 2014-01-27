<?php
//Get Full URL
require('functions.php');


$conn = mysqli_connect($host, $username, $pass , $database);

if(mysqli_connect_errno($conn)){

echo 'please check this '.mysqli_connect_errno();

exit;

}

?>
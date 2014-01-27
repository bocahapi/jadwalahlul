<?php

if(!file_exists('functions.php')){

function getFullURL($s)
{
    $ssl = (!empty($s['HTTPS']) && $s['HTTPS'] == 'on') ? true:false;
    $sp = strtolower($s['SERVER_PROTOCOL']);
    $protocol = substr($sp, 0, strpos($sp, '/')) . (($ssl) ? 's' : '');
    $port = $s['SERVER_PORT'];
    $port = ((!$ssl && $port=='80') || ($ssl && $port=='443')) ? '' : ':'.$port;
    $host = isset($s['HTTP_X_FORWARDED_HOST']) ? $s['HTTP_X_FORWARDED_HOST'] : isset($s['HTTP_HOST']) ? $s['HTTP_HOST'] : $s['SERVER_NAME'];
    return $protocol . '://' . $host . $port . $s['REQUEST_URI'];
}
$currentURL = getFullURL($_SERVER);
echo '<head><title>Warning Sistem</title></head>';

echo	'<link rel="stylesheet" href="includes/css/main-site.css"/>';

echo '<div class="container"><div class="center-block step">';
echo '<form role="form" action="setup/install.php?step=1" method="post" class="install">';
echo '<input type="hidden" class="form-control" name="url" value="'.$currentURL.'"/>';
echo '<h3>Waring !!! Perangkat Tidak Dikenali</h3>';
echo '<p>Sistem berada diperangkat baru, untuk menyesuaikan sistem akan melakukan installasi. <br/> klik Lanjutkan untuk melakukan installasi</p>';
echo '<button type="submit" class="btn btn-primary pull-right">Lanjutkan</button>';

echo '<div class="clear"></div></form></div></div>';
}else{

require_once('navbar.php');



/** anti Sql-Injection **/

}
?>
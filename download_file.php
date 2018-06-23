<?php
session_start();
$res=$_SESSION['res'];
echo $_SESSION['res'];
if(file_exists($res))
{
    header('Content-Description: File Transfer');
    header('Content-Type: application/force-download');
    header("Content-Disposition: attachment; filename=\"" . basename($res) . "\";");
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($res));
    ob_clean();
    flush();
    readfile($res); 
    //exit;
}
session_write_close();
?>
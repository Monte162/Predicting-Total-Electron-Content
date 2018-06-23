<?php
require 'init.php';
session_start();
if($_SESSION['type']=='D')
{
	session_write_close();
	header('Location:view_data_d.php');
}
else
{
	session_write_close();
	header('Location:view_data_s.php');
}
?>
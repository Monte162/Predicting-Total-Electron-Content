<?php
require 'init.php';
session_start();
if($_SESSION['type']=='D')
{
	session_write_close();
	header('Location:clear_data_d.php');
}
else
{
	session_write_close();
	header('Location:clear_data_s.php');
}
?>
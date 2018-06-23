<?php
require 'init.php';
require 'navbar_user.php';
session_start();
$verifydb=$dbO->prepare("DELETE FROM user_data_discard WHERE username=:uname");
$verifydb->bindParam(':uname',$_SESSION['username']);
if(!$verifydb->execute())
{
	echo 'Error in execution of MySQL';
}
?>
<html> 
<head>
<h1 style="margin-left:5%"> All your data has been deleted. </h1>
</head>
</html>
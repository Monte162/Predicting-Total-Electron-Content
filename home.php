<?php
require 'initvarlog.php';
require 'navbar_main.php';
?>

<html>
<head>
<link rel="stylesheet" type="text/css" href="thecss.css">
<title> Home Page </title>
</head>
<body>
<div>
<h1 style="margin-top: 10%;"> Existing User? Click here to login. </h1>
<form name="home" action="login.php" method="post"> 
	<input type="submit" value="Login" name="log" style="margin-left: 44%;"><br><br>
</form>
<h1 style="margin-top: 15%;"> New User? Click here to register! </h1>
<form name="home" action="register.php" method="post"> 
	<input type="submit" value="Register User" name="reg" style="margin-left: 44%;"><br><br>
</form>
</div>
</body>
</html>
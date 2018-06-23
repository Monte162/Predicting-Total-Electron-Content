<?php
require 'init.php';
require 'navbar_main.php';
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="thecss.css">
<title> Login page </title>
<script>
	function validateLogin()
	{
		var uname=document.forms["login"]["uname"].value;
		var pass=document.forms["login"]["pass"].value;
		if(uname==null || uname=="")
		{
			document.getElementById("e1").innerHTML=" Error! Username cannot be empty.";
			// form.uname.focus();
			return false;
		}
		else
			document.getElementById("e1").innerHTML="";
		if(pass==null || pass=="")
		{
			document.getElementById("e2").innerHTML=" Error! Password cannot be empty.";
			// form.pass.focus();
			return false;
		}
		else
			document.getElementById("e2").innerHTML="";
		return true;
	}
</script>
</head>
<body>
<h1> Welcome! Login here! </h1>
<form name="login" action="loginval.php" method="post" onsubmit="return validateLogin()">
	<br>
	<input type="text/plain" name="uname" placeholder="Username" > <error id="e1"></error><br><br>
	<input type="password" name="pass" placeholder="Password" > <error id="e2"></error><br><br>
	<input type="submit" value="Submit" name="sub" style="margin-left: 45.8%;">
	<error1 id="f1"></error1>
</form>
<form name="home" action="home.php" method="post"> 
	<input type="submit" value="Return home" name="sub" style="margin-left: 45.8%;"><br><br>
</form>
</body>
<?php
	session_start();
	if($_SESSION['logerr']!="")
	{
		echo $_SESSION['logerr'];
		$_SESSION['logerr']="";
	}
	else
	{
		header("user_home.php");
	}
	session_write_close();
?>
</html>
<?php
require 'init.php';
require 'navbar_main.php';
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="thecss.css">
<title> User Registration </title>

<script>

	function validateRegister()
	{
		var uname=document.forms["register"]["uname"].value;
		var pass=document.forms["register"]["pass"].value;
		var name=document.forms["register"]["name"].value;
		if(name==null || name=="")
		{
			document.getElementById("e3").innerHTML=" Error! Your name cannot be empty. "
			return false;
		}
		else
			document.getElementById("e3").innerHTML="";
		if(uname==null || uname=="")
		{
			document.getElementById("e4").innerHTML=" Error! Username cannot be empty.";
			// form.uname.focus();
			return false;
		}
		else
			document.getElementById("e4").innerHTML="";
		if(pass==null || pass=="")
		{
			document.getElementById("e5").innerHTML=" Error! Password cannot be empty.";
			// form.pass.focus();
			return false;
		}
		else
			document.getElementById("e5").innerHTML="";
		return true;
	}
</script>
</head>
<body>
<h1>New User? Register here!</h1>
<form name="register" method="post" action="regval.php" onsubmit="return validateRegister()">
		<br>
		<input type="text/plain" name="name" placeholder="Your full name">	<error id="e3"></error><br><br>
		<input type="text/plain" name="uname" placeholder="Choose Username">	<error id="e4"></error> <br><br>
		<input type="password" name="pass" placeholder="Choose Password"> 	<error id="e5"></error><br><br>
		<label style="margin-left:40.8%"> Type of user? </label>
		<input type="radio" name="type" value="Store" checked style="margin-left:1.8%">Store transactions 
		<input type="radio" name="type" value="Discard">Discard transactions <br><br>
		<input type="submit" value="Register Details" name="sub" style="display: inline-block;width: 200px;height: 30px;text-align: center;margin-left: 45.8%;"> <br><br>
</form>
<form name="home" action="home.php" method="post"> 
	<input type="submit" value="Return home" name="sub" style="margin-left: 45.8%;"><br><br>
</form>
</body>
<?php
session_start();
if($_SESSION['regerr']!="")
{
	echo $_SESSION['regerr'];
	$_SESSION['regerr']="";
}
session_write_close();
?>
</html>
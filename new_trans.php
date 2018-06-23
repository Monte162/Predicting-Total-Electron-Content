<?php
require 'init.php';
require 'navbar_user.php';
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="thecss.css">
<title> Upload Page </title>

<script>
function validate()
{
		var sdate=document.forms["upload"]["startDate"].value;
		var edate=document.forms["upload"]["endDate"].value;
		var sname=document.forms["upload"]["stnName"].value;
		var year=document.forms["uploadFile"]["year"].value;
		if(sdate==null || sdate=="")
		{
			document.getElementById("e1").innerHTML=" Error! Start date cannot be empty.";
			return false;
		}
		else
			document.getElementById("e1").innerHTML="";
		if(edate==null || edate=="")
		{
			document.getElementById("e2").innerHTML=" Error! End date cannot be empty.";
			return false;
		}
		else
			document.getElementById("e2").innerHTML="";
		if(sname==null || sname=="")
		{
			document.getElementById("e3").innerHTML=" Error! Station name cannot be empty.";
			return false;
		}
		else
			document.getElementById("e3").innerHTML="";
		if(year==null || year=="")
		{
			document.getElementById("e4").innerHTML=" Error! Year cannot be empty.";
			return false;
		}
		else
			document.getElementById("e4").innerHTML="";
		return true;
}
</script>
</head>
<body>
<h1 style="margin-left: 5.8%;"> Welcome User! This is your homepage.<br> Please fill in your relevant details. </h1>
<form name="upload" action="upload.php" onsubmit="return validate()" method="post" enctype="multipart/form-data">
<br><br>
<label> Enter start date: </label>
<input type="date" name="startDate" placeholder="Enter start date" style="margin-left: 48.8%;"> <error id="e1"></error><br><br>
<label> Enter end date: </label>
<input type="date" name="endDate" placeholder="Enter end date" style="margin-left: 48.8%;"> <error id="e2"></error><br><br>
<input type="text/plain" name="stnName" placeholder="Enter Station Name" style="margin-left: 40%;"> <error id="e3"></error><br><br> 
<label id="ylabel" style="margin-left: 45%;"> Enter year: </label>
<input type="number" name="year" placeholder="Enter year" style="width: 100px;height: 30px;padding: 0px 10px; border: none;box-sizing: border-box;margin-left:48.8%"><error id="e4"></error><br><br>
<input type="file" name="uploadFile" id="file" class="inputfile"/>
<label for="file" style="margin-left: 45.5%;"> Choose a file </label>
<br><br>
<input type="submit" value="Upload" name="upload" style="margin-left: 45.5%;">
<br><br>
</form>
</body>
<?php
session_start();
if($_SESSION['uperr']!="")
{
	echo $_SESSION["uperr"];
	$_SESSION['uperr']="";
}
session_write_close();
?>
</html>
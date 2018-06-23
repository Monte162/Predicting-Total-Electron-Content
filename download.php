
<?php
require 'init.php';
?>
<html>
<link rel="stylesheet" type="text/css" href="thecss.css">
<body>
<?php
session_start();
set_time_limit(10000000);
$dirpath=getcwd().'/'.$_SESSION['username'];
$path=$dirpath.'/'.'Output';
if(!file_exists($path))
	mkdir($path);
$res=scandir($path);
$n=count($res);
while(1)
{
	$res=scandir($path);
	if(count($res)>$n)
		break;
}
$ctime=-1;
$file="";
foreach($res as $value)
{
	if(filectime($value)>$ctime)
	{
		$ctime=filectime($file);
		$file=$value;
	}
}

if($file=="")
	echo 'File empty';
 $_SESSION['res']=$file;
 $realpath=realpath($file);
if($_SESSION['type']=='S')
{
$verifydb=$dbO->prepare('UPDATE user_data_store SET Output=:result WHERE username=:user AND trans_id=:trans');
$verifydb->bindParam(":result",$_SESSION['res']);
$verifydb->bindParam(":user",$_SESSION['username']);
$verifydb->bindParam(":trans",$_SESSION['no_of_trans']);
if(!$verifydb->execute())
	echo 'Error';
}
else
{
$verifydb=$dbO->prepare('UPDATE user_data_discard SET Output=:result WHERE username=:user');
$verifydb->bindParam(":result",$_SESSION['res']);
$verifydb->bindParam(":user",$_SESSION['username']);
if(!$verifydb->execute())
	echo 'Error';	
}
$verifydb=$dbO->prepare("UPDATE users SET no_of_trans=no_of_trans+1 WHERE username=:uname");
$verifydb->bindParam(":uname",$user);
if(!$verifydb->execute())
{
	$_SESSION['uperr']="Error in execution";
	session_write_close();
	header("Location:new_trans.php");		
}
?>
<h1 style="margin-top:10%;"> Your file is ready to download. </h1>
<form name="home" action="download_file.php" method="post"> 
	<input type="submit" value="Download file" name="log" style="margin-left: 44%;"><br><br>
</form>
<h1 style="margin-top:10%;"> Click here to go home. </h1>
<form name="hoho" action="user_home.php" method="post"> 
	<input type="submit" value="Go home" name="log" style="margin-left: 44%;"><br><br>
</form>


</body>
</html>
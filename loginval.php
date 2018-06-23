<?php
require 'init.php';
session_start();
if($_SERVER["REQUEST_METHOD"]=="POST")
{
	$uname=$_POST["uname"];
	$password=$_POST["pass"];
	$verifydb=$dbO->prepare("SELECT password FROM users WHERE username=:uname");
	$verifydb->bindParam(':uname',$uname);
	if($verifydb->execute())
	{
		$row=$verifydb->fetch(PDO::FETCH_ASSOC);
		$dbpass=$row['password'];
		if($dbpass==$password)
		{
			$verifydb=$dbO->prepare("SELECT no_of_trans,type FROM users WHERE username=:uname");
			$verifydb->bindParam(':uname',$uname);
			if($verifydb->execute())
			{
				echo 'Hi';
				$row=$verifydb->fetch(PDO::FETCH_ASSOC);
				$_SESSION['type']=$row['type'];
				$_SESSION['no_of_trans']=$row['no_of_trans'];
				$_SESSION['username']=$uname;
				$_SESSION['password']=$password;
				$_SESSION['logerr']="";
				session_write_close();
				header("Location:user_home.php");
			}
			else
			{
				$_SESSION['logerr']="Cant execute statement.";
				session_write_close();
				header("Location:login.php");
			}
		}
		else
		{
			$_SESSION['logerr']="Incorrect username or password.";
			session_write_close();
			header("Location:login.php");
		}
	}
	else
	{
		$_SESSION['logerr']="Cant execute user statement.";
		session_write_close();
		header("Location:login.php");
	}
}


?>
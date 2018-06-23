<?php
require 'init.php';
if($_SERVER["REQUEST_METHOD"]=="POST")
{
	session_start();
	$uname=$_POST["uname"];
	$password=$_POST["pass"];
	$verifydb=$dbO->prepare("SELECT username FROM users WHERE username=:uname");
	$verifydb->bindParam(':uname',$uname);
	if($verifydb->execute())
	{
		$rows=$verifydb->fetch(PDO::FETCH_ASSOC);
		if($rows['username']==$uname)
		{
			$_SESSION['regerr']="User already exists. Please login.";
			session_write_close();
			header('Location:register.php');
		}
		else
		{
			$name=$_POST["name"];
			$type=$_POST["type"];
			if(isset($type) && $type=="Store")
				$type='S';
			else if(isset($type) && $type=="Discard")
				$type='D';
			$stat=$dbO->prepare('INSERT INTO users(name, username, password, no_of_trans, type) VALUES(:name,:uname,:password,1,:type)');
			$stat->bindParam(':name',$name);
			$stat->bindParam(':uname',$uname);
			$stat->bindParam(':password',$password);
			$stat->bindParam(':type',$type);
			if(!$stat->execute())
			{
				$_SESSION['regerr']="Error in execution.";
				session_write_close();
				header('Location:register.php');
			}
			$_SESSION['regerr']="Successfully registered";
			session_write_close();
			header('Location:register.php');
		}
	}
	else
	{
		$_SESSION['regerr']="Error in execution.";
		session_write_close();
	}
}
?>
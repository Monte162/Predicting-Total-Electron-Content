<?php
require 'init.php';
?>
<html>
<body>
<?php
	session_start();
	if($_SERVER['REQUEST_METHOD']=='POST')
	{
		$strtdate=$_POST['startDate'];
		$enddate=$_POST['endDate'];
		$stnname=$_POST['stnName'];
		$year=$_POST['year'];
		$currpath=getcwd();
		$user=$_SESSION['username'];
		$pass=$_SESSION['password'];
		$type=$_SESSION['type'];
		$trans=$_SESSION['no_of_trans'];
		$dirpath=$currpath.'/'.$user;
		if(!file_exists($dirpath))
		{
			mkdir($dirpath,0777);
			$dirpath=$dirpath.'/'.'Input';
			if(!file_exists($dirpath))
				mkdir($dirpath,0777);
		}
		else
			$dirpath=$dirpath.'/'.'Input';
		$tmp=$_FILES['uploadFile']['tmp_name'];
		$dirpath=$dirpath.'/'.basename($_FILES["uploadFile"]['name']);
		if(move_uploaded_file($_FILES["uploadFile"]['tmp_name'], $dirpath))
		{
			$ext=pathinfo($dirpath, PATHINFO_EXTENSION);
			if($ext!='txt')
			{
				$_SESSION['uperr']="Invalid file type";
				session_write_close();
				header("Location:new_trans.php");
			}
			if(!ctype_alnum($stnname))
			{
				$_SESSION['uperr']="Invalid station name";
				session_write_close();
				header("Location:new_trans.php");				
			}
			if($year<1990)
			{
				$_SESSION['uperr']="Invalid year";
				session_write_close();
				header("Location:new_trans.php");				
			}
			if($type=="S")
			{
					$verifydb=$dbO->prepare("SELECT no_of_trans FROM users WHERE username=:uname");
					$verifydb->bindParam(":uname",$user);
					if($verifydb->execute())
					{
						$row=$verifydb->fetch(PDO::FETCH_ASSOC);
						$_SESSION['no_of_trans']=$row['no_of_trans'];
					}
					$verifydb=$dbO->prepare("INSERT INTO user_data_store(username, trans_id, startdate, enddate, station_name, year, input) VALUES(:user, :trans, :strtdate, :enddate, :stnname, :year, :dirpath)");
					$verifydb->bindParam(':user',$user);
					$verifydb->bindParam(':trans',$trans);
					$verifydb->bindParam(':strtdate',$strtdate);
					$verifydb->bindParam(':enddate',$enddate);
					$verifydb->bindParam(':stnname',$stnname);
					$verifydb->bindParam(':year',$year);
					$verifydb->bindParam(':dirpath',$dirpath);
					if(!$verifydb->execute())
					{
						$_SESSION['uperr']="Error in execution";
						session_write_close();
						header("Location:new_trans.php");						
					}
			}
			else if($type=="D")
			{
					$verifydb=$dbO->prepare("DELETE FROM user_data_discard WHERE username=:uname ");
					$verifydb->bindParam(":uname",$user);
					if(!$verifydb->execute())
					{
						$_SESSION['uperr']="Error in execution";
						session_write_close();
						header("Location:new_trans.php");
					}
					$verifydb=$dbO->prepare("INSERT INTO user_data_discard(username, trans_id, startdate, enddate, station_name, year, input) VALUES(:user, 1, :strtdate, :enddate, :stnname, :year, :dirpath)");
					$verifydb->bindParam(':user',$user);
					$verifydb->bindParam(':strtdate',$strtdate);
					$verifydb->bindParam(':enddate',$enddate);
					$verifydb->bindParam(':stnname',$stnname);
					$verifydb->bindParam(':year',$year);
					$verifydb->bindParam(':dirpath',$dirpath);
					if(!$verifydb->execute())
					{
						$_SESSION['uperr']="Error in execution";
						session_write_close();
						header("Location:new_trans.php");						
					}
			}
			else
			{
						$_SESSION['uperr']="Error in execution";
						session_write_close();
						header("Location:new_trans.php");
			}
			session_write_close();
			header("Location:download.php");
		}
		else
		{
						$_SESSION['uperr']="Error! Entered invalid or no data";
						session_write_close();
						header("Location:new_trans.php");		
		}
	}
 ?>
 </body>
 </html>
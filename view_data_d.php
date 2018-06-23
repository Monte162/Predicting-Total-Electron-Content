<html>
<head>
<link rel="stylesheet" type="text/css" href="thecss.css">
<?php
require 'init.php';
require 'navbar_user.php';
$verifydb=$dbO->prepare("SELECT * FROM user_data_discard WHERE username=:uname");
$verifydb->bindParam(':uname',$_SESSION['username']);
$verifydb->execute();
?>
<table border=2>
<thead>
<tr>
		<th> Username </th>
		<th> Transaction ID </th>
		<th> Start Date </th>
		<th> End Date </th>
		<th> Station Name </th>
		<th> Year </th>
		<th> Input file </th>
		<th> Output file </th>
</tr>
</thead>
<?php
session_start();
$path=$_SESSION['res'];
session_write_close();
while($res=$verifydb->fetch(PDO::FETCH_ASSOC))
{
	echo '<html><br></html>';
	?>
	<tbody>
		<?php
		session_start();
		echo "<tr><td>{$res['username']}
				</td><td>{$res['trans_id']}
				</td><td>{$res['startdate']}
				</td><td>{$res['enddate']}
				</td><td>{$res['station_name']}
				</td><td>{$res['year']}
				</td><td>";
				$_SESSION['res']=$res['input'];
				session_write_close();
			?>
			<html><a href="download_file.php"> Input</a>
		<?php 
			session_start();
			echo "
				</td><td>";
			$_SESSION['res']=$res['output'];
			session_write_close();
			?>
			<html><a href="download_file.php"> Output</a>
			
	</tbody>
	<?php
}
session_start();
$_SESSION['res']=$path;
session_write_close();
?>
</table>
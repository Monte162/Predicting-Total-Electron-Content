<?php
require 'init.php';
$verifydb=$dbO->prepare("SELECT * FROM users");
$verifydb->execute();
$res=$verifydb->fetch(PDO::FETCH_ASSOC);
print_r($res);
while($res=$verifydb->fetch(PDO::FETCH_ASSOC))
{
	echo '<html><br></html>';
	print_r($res);
}
?>
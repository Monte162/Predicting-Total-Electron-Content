<?php
session_start();
$dbO;

$dbUsername = 'root';
$dbPassword = '';

try {
	$conn=new mysqli("localhost",$dbUsername,$dbPassword);
	if(!$conn)
	{
		die('Connection failed.'.mysqli_connect_error());
	}
	$sql="CREATE DATABASE webengine";
	if(!mysqli_query($conn,$sql));
    else
    {
        $_SESSION['logerr']="";
        $_SESSION['regerr']="";
        $_SESSION['type']="";
        $_SESSION['no_of_trans']="";
        $_SESSION['username']="";
        $_SESSION['password']="";
        $_SESSION['uperr']="";
    }
	mysqli_close($conn);
    $dbO = new PDO("mysql:host=localhost;dbname=webengine", $dbUsername, $dbPassword);
    $dbO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $verifydb=$dbO->prepare('CREATE TABLE IF NOT EXISTS users 
                        (
                        name VARCHAR(30) NOT NULL,
                        username VARCHAR(30), 
                        password VARCHAR(30) NOT NULL, 
                        no_of_trans INT DEFAULT 1, 
                        type VARCHAR(1) DEFAULT "S",
                        PRIMARY KEY(username)
                        )');
    if(!$verifydb->execute())
        echo 'Fail.';
    $verifydb=$dbO->prepare('CREATE TABLE IF NOT EXISTS user_data_discard 
                        (
                        username VARCHAR(30) NOT NULL, 
                        trans_id INT NOT NULL, 
                        startdate DATE NOT NULL, 
                        enddate DATE NOT NULL,
                        station_name VARCHAR(4) NOT NULL, 
                        year INT NOT NULL,
                        input VARCHAR(50) NOT NULL,
                        output VARCHAR(50),
                        CHECK(year>=1990), 
                        PRIMARY KEY(username)
                    )');
    if(!$verifydb->execute())
        echo 'Fail.';
    $verifydb=$dbO->prepare('CREATE TABLE IF NOT EXISTS user_data_store 
                        (
                        username VARCHAR(30), 
                        trans_id INT, 
                        startdate DATE NOT NULL, 
                        enddate DATE NOT NULL,
                        station_name VARCHAR(4) NOT NULL, 
                        year INT NOT NULL,
                        input VARCHAR(50) NOT NULL,
                        output VARCHAR(50),
                        CHECK(year>=1990), 
                        PRIMARY KEY(username,trans_id)
                        )');
    if(!$verifydb->execute())
        echo 'Fail.';
    session_write_close();

} catch(PDOException $e) {
    echo $e->getMessage();
}
?>
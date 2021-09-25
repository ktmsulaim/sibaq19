<?php
	
	$server = 'localhost';
	$username = 'root';
	$password = 'mysqlroot';
	$db = 'sibaq19';

	$connect = mysqli_connect($server, $username, $password, $db);

	if(!$connect){
		die('Connection failed:' . mysqli_connect_error());
	}
?>
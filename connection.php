<?php
	$databaseHost = 'localhost:3307';
	$databaseUsername = 'gabo';
	$databasePass = 'root';
	$databaseName = 'tecnicas_ataque';

	$mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePass, $databaseName); 

	if (mysqli_connect_errno()) {
		echo "Coneccion fallida a MySQL: " . mysqli_connect_error();
		exit();
	}
?>
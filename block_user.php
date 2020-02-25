<?php session_start(); ?>

<?php
	if(!isset($_SESSION['valid'])) {
		header('Location: login.php');
	}
?>

<?php
	include("connection.php");

	$id = $_GET['id_user'];
	$id = (int)$id;
	$name = $_GET['name_user'];
	$active = $_GET['active'];
	$usersId = $_SESSION['id'];
	
	if($active == '1'){
		$active = 0;
	}else {
		$active = 1;
	}
	
	$result1=mysqli_query($mysqli, "UPDATE users SET active = $active WHERE id=$id");
	
	$description = "Se cambio el estado del usuario: ".$name;
	$result2 = mysqli_query($mysqli, "INSERT INTO audit_process_tracking (action, date, user_id, description) VALUES('Change status user', CURRENT_TIMESTAMP, '$usersId', '$description')");

	header("Location:users.php");
?>
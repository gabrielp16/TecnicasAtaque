<?php session_start(); ?>

<?php
	if(!isset($_SESSION['valid'])) {
		header('Location: login.php');
	}
?>

<?php
	include("connection.php");

	$id = $_GET['id_role'];
	$id = (int)$id;
	$name = $_GET['name_role'];
	$usersId = $_SESSION['id'];
	
	$result2=mysqli_query($mysqli, "DELETE FROM users_roles WHERE role_id=$id");
	$result1=mysqli_query($mysqli, "DELETE FROM roles WHERE id=$id");
	
	$description = "Se eliminó el rol: ".$name;
	$result2 = mysqli_query($mysqli, "INSERT INTO audit_process_tracking (action, date, user_id, description) VALUES('Delete role', CURRENT_TIMESTAMP, '$usersId', '$description')");

	header("Location:roles.php");
?>
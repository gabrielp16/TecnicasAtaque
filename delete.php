<?php session_start(); ?>

<?php
	if(!isset($_SESSION['valid'])) {
		header('Location: login.php');
	}
?>

<?php
	include("connection.php");

	$id = $_GET['id'];
	$name = $_GET['name'];
    $usersId = $_SESSION['id'];
	$result=mysqli_query($mysqli, "DELETE FROM services WHERE id=$id");
	
	$description = "Se eliminó el servicio: ".$name;
	$result2 = mysqli_query($mysqli, "INSERT INTO audit_process_tracking (action, date, user_id, description) VALUES('Delete service', CURRENT_TIMESTAMP, '$usersId', '$description')");

		
	header("Location:view.php");
?>
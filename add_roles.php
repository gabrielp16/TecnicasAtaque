<?php session_start(); ?>

<?php
	if(!isset($_SESSION['valid'])) {
		header('Location: login.php');
	}
?>
<html>

<head>
    <title>Agregar roles | Gabriel Peña & Manuel Albarran</title>
</head>

<body>
    <?php
		include_once("connection.php");

		if(isset($_POST['Submit'])) {	
			$name = $_POST['name'];
			$usersId = $_SESSION['id'];
		
			$result = mysqli_query($mysqli, "INSERT INTO roles(name) VALUES('$name')");

			$description = "Se agregó el rol: ".$name;
			$result2 = mysqli_query($mysqli, "INSERT INTO audit_process_tracking (action, date, user_id, description) VALUES('Add role', CURRENT_TIMESTAMP, '$usersId', '$description')");
			
			header('Location: roles.php');
		}
	?>
</body>

</html>
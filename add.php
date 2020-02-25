<?php session_start(); ?>

<?php
	if(!isset($_SESSION['valid'])) {
		header('Location: login.php');
	}
?>
<html>

<head>
    <title>Agregar un producto | Gabriel Peña</title>
</head>

<body>
    <?php
		include_once("connection.php");

		if(isset($_POST['Submit'])) {	
			$name = $_POST['name'];
			$qty = $_POST['qty'];
			$price = $_POST['price'];
			$usersId = $_SESSION['id'];
		
			$result = mysqli_query($mysqli, "INSERT INTO services (name, qty, price, users_id) VALUES('$name','$qty','$price', '$usersId')");
			
			$description = "Se agregó el servicio: ".$name;
			$result2 = mysqli_query($mysqli, "INSERT INTO audit_process_tracking (action, date, user_id, description) VALUES('Add service', CURRENT_TIMESTAMP, '$usersId', '$description')");
			
			header('Location: view.php');
		}
	?>
</body>

</html>
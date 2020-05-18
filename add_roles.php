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
			$usersId = $_SESSION['id'];
			$name = $_POST['name'];

			if($_POST['products'] == 'active') { $permission_products = 1; } else { $permission_products = 0; }
			if($_POST['roles'] == 'active') { $permission_roles = 1; } else { $permission_roles = 0; }
			if($_POST['audit'] == 'active') { $permission_audit = 1; } else { $permission_audit = 0; }
			if($_POST['users'] == 'active') { $permission_users = 1; } else { $permission_users = 0; }

			$result = mysqli_query($mysqli, "INSERT INTO roles(name, products, roles, audit, users) VALUES('$name', $permission_products, $permission_roles, $permission_audit, $permission_users)");

			$description = "Se agregó el rol: ".$name;
			$result2 = mysqli_query($mysqli, "INSERT INTO audit_process_tracking (action, date, user_id, description) VALUES('Add role', CURRENT_TIMESTAMP, '$usersId', '$description')");

			header('Location: roles.php');
		}
	?>
</body>

</html>
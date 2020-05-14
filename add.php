<?php session_start(); ?>

<?php
	if(!isset($_SESSION['valid'])) {
		header('Location: login.php');
	}
?>
<html>

<head>
    <title>Agregar un producto | Gabriel Peña & Manuel Albarran</title>
</head>

<body>
    <?php
		include_once("connection.php");

		if(isset($_POST['Submit'])) {	
			$name = $_POST['name'];
			$qty = $_POST['qty'];
			$price = $_POST['price'];
			$expiration_date = $_POST['expiration_date'];
			$usersId = $_SESSION['id'];

			$today = new DateTime();
			$today = $today->format('Y-m-d');

			$expiration_date = new DateTime($expiration_date);
			$expiration_date = $expiration_date->format('Y-m-d');

			$soon = new DateTime();
			$soon->add(new DateInterval('P8D'));
			$soon = $soon->format('Y-m-d');
			
			if($expiration_date < $today ){
				$expiration_status = 'expired';
			}elseif ($expiration_date <= $soon){
				$expiration_status = 'soon-expired';
			}else{
				$expiration_status = 'not-expired';
			}

			$result = mysqli_query($mysqli, "INSERT INTO products (name, qty, price, expiration_date, expiration_status, users_id)
			VALUES('$name','$qty','$price', '$expiration_date', '$expiration_status', '$usersId')");

			$description = "Se agregó el producto: ".$name;
			$result2 = mysqli_query($mysqli, "INSERT INTO audit_process_tracking (action, date, user_id, description)
			VALUES('Add service', CURRENT_TIMESTAMP, '$usersId', '$description')");

			header('Location: view.php?search=&search_selector=products.name&order_type=id&order=DESC');
    	}
    ?>
</body>

</html>
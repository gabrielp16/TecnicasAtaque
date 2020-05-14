<?php session_start(); ?>

<?php
	if(!isset($_SESSION['valid'])) {
		header('Location: login.php');
	}
?>
<html>

<head>
    <title>Buscar productos | Gabriel Peña & Manuel Albarran</title>
</head>

<body>
    <?php
		include_once("connection.php");

		if(isset($_POST['submit_search'])) {	
			$search_selector = $_POST['search-selector'];
			$search = $_POST['search'];
			$order_type = $_POST['order-type-selector'];
			$order = $_POST['order-selector'];
				
			header('Location: view.php?search='.$search.'&search_selector='.$search_selector.'&order_type='.$order_type.'&order='.$order);
		}
	?>
</body>

</html>
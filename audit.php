<?php session_start(); ?>

<?php
	if(!isset($_SESSION['valid'])) {
		header('Location: login.php');
	}
?>
<html>

<head>
    <title>Buscar productos</title>
</head>

<body>
    <?php
		include_once("connection.php");

		if(isset($_POST['submit_audit'])) {	
			$search_selector = $_POST['search-selector'];
			$search = $_POST['search'];
				
			header('Location: audit-list.php?search='.$search.'&search_selector='.$search_selector);
		}
	?>
</body>

</html>
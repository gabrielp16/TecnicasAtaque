<?php session_start(); ?>

<?php
if(!isset($_SESSION['valid'])) {
	header('Location: login.php');
}
?>

<?php
include_once("connection.php");

if(isset($_POST['update']))
{	
	$id = $_POST['id'];
    $usersId = $_SESSION['id'];
	
	$name = $_POST['name'];
	$qty = $_POST['qty'];
    $price = $_POST['price'];
    $expiration_date = $_POST['expiration_date'];	
	
	if(empty($name) || empty($qty) || empty($price)) {
				
		if(empty($name)) {
			echo "<font color='red'>El campo Nombre esta vacio.</font><br/>";
		}
		
		if(empty($qty)) {
			echo "<font color='red'>El campo Cantidad esta vacio</font><br/>";
		}
		
		if(empty($price)) {
			echo "<font color='red'>El campo Precio esta vacio</font><br/>";
        }	
        
        if(empty($expiration_date)) {
			echo "<font color='red'>El campo Fecha de expiracion esta vacio</font><br/>";
		}	
	} else {	
        $result = mysqli_query($mysqli, "UPDATE products SET name='$name', qty='$qty', price='$price',expiration_date='$expiration_date' WHERE id=$id");
        
        $description = "Se editó el producto: ".$name;
        $result2 = mysqli_query($mysqli, "INSERT INTO audit_process_tracking (action, date, user_id, description) VALUES('Update service', CURRENT_TIMESTAMP, '$usersId', '$description')");

		header("Location: view.php");
	}
}
?>
<?php
    $id = $_GET['id'];
    $result = mysqli_query($mysqli, "SELECT * FROM products WHERE id=$id");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Editar de productos | Gabriel Peña & Manuel Albarran</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h2>Lista de producto</h2>
                    </div>
                    <div class="col-sm-6">
                        <a href="logout.php" class="btn btn-danger">
                            <i class="material-icons">exit_to_app</i> <span>Salir</span>
                        </a>
                        <a href="view.php" class="btn btn-success">
                            <i class="material-icons">remove_red_eye</i> <span>Ver productos</span>
                        </a>
                        <a href="index.php" class="btn btn-success">
                            <i class="material-icons">home</i> <span>Inicio</span>
                        </a>
                    </div>
                </div>
            </div>
            <form name="form1" method="post" action="edit.php">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th id="name_header">Nombre</th>
                            <th id="qty_header">Cantidad</th>
                            <th id="price_header">Precio</th>
                            <th id="expiration_date_header">Fecha de vencimiento</th>
                            <th id="action_header">Accion</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
						while($res = mysqli_fetch_assoc($result)) {
					?>
                        <tr>
                            <td>
                                <input type="text" class="form-control" name="name" value="<?php echo $res['name'];?>">
                            </td>
                            <td>
                                <input type="text" class="form-control" name="qty" value="<?php echo $res['qty'];?>">
                            </td>
                            <td>
                                <input type="text" class="form-control" name="price"
                                    value="<?php echo $res['price'];?>">
                            </td>
                            <td>
                                <input type="text" class="form-control" name="expiration_date"
                                    value="<?php echo $res['expiration_date'];?>">
                            </td>
                            <td>
                                <input type="hidden" name="id" value=<?php echo $_GET['id'];?>>
                                <input type="submit" name="update" value="Guardar" class="btn btn-info">
                            </td>
                        </tr>
                        <?php
						}
					?>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
</body>

</html>
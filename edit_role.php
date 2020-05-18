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
	
	if(empty($name)) {
        echo "<font color='red'>El campo Nombre esta vacio.</font><br/>";		
	} else {
        if($_POST['products'] == 'active') { $permission_products = 1; } else { $permission_products = 0; }
        if($_POST['roles'] == 'active') { $permission_roles = 1; } else { $permission_roles = 0; }
        if($_POST['audit'] == 'active') { $permission_audit = 1; } else { $permission_audit = 0; }
        if($_POST['users'] == 'active') { $permission_users = 1; } else { $permission_users = 0; }

		$result = mysqli_query($mysqli, "UPDATE roles SET name='$name', products=$permission_products, roles=$permission_roles, audit=$permission_audit, users=$permission_users WHERE id=$id");

        $description = "Se editó el rol: ".$name;
        $result2 = mysqli_query($mysqli, "INSERT INTO audit_process_tracking (action, date, user_id, description) VALUES('Update role', CURRENT_TIMESTAMP, '$usersId', '$description')");

		header("Location: roles.php");
	}
}
?>
<?php
    $id = $_GET['id'];
    $result = mysqli_query($mysqli, "SELECT * FROM roles WHERE id=$id");
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
                        <a href="roles.php" class="btn btn-success">
                            <i class="material-icons">remove_red_eye</i> <span>Ver roles</span>
                        </a>
                        <a href="index.php" class="btn btn-success">
                            <i class="material-icons">home</i> <span>Inicio</span>
                        </a>
                    </div>
                </div>
            </div>
            <form name="form1" method="post" action="edit_role.php">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th id="name_header">Nombre</th>
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
                        </tr>
                        <tr>
                            <td>
                                <div class="wrap-checkbox">
                                    <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                        <input type="checkbox" class="custom-control-input" id="products"
                                            name="products" value="active"
                                            <?php if($res['products'] == 1){ echo ' checked="checked"'; } ?>>
                                        <label class="custom-control-label" for="products">Listar y/o agregar
                                            productos</label>
                                    </div>
                                    <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                        <input type="checkbox" class="custom-control-input" id="roles" name="roles"
                                            value="active"
                                            <?php if($res['roles'] == 1){ echo ' checked="checked"'; } ?>>
                                        <label class="custom-control-label" for="roles">Listar y/o crear roles</label>
                                    </div>
                                    <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                        <input type="checkbox" class="custom-control-input" id="audit" name="audit"
                                            value="active"
                                            <?php if($res['audit'] == 1){ echo ' checked="checked"'; } ?>>
                                        <label class="custom-control-label" for="audit">Auditar</label>
                                    </div>
                                    <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                        <input type="checkbox" class="custom-control-input" id="users" name="users"
                                            value="active"
                                            <?php if($res['users'] == 1){ echo ' checked="checked"'; } ?>>
                                        <label class="custom-control-label" for="users">Listar usuarios</label>
                                    </div>
                                </div>

                            </td>
                        </tr>
                        <tr>
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
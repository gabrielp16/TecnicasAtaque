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
    $email = $_POST['email'];	
    $username = $_POST['username'];	
    $role = $_POST['role'];
	
	if(empty($name)) {
        if(empty($name)) {
            echo "<font color='red'>El campo Nombre esta vacio.</font><br/>";		
        }
        if(empty($email)) {
            echo "<font color='red'>El campo Correo esta vacio.</font><br/>";		
        }
        if(empty($username)) {
            echo "<font color='red'>El campo Usuario esta vacio.</font><br/>";		
        }
        if(empty($role)) {
            echo "<font color='red'>El campo Rol esta vacio.</font><br/>";		
        }		
	} else {	
		$result = mysqli_query($mysqli, "UPDATE users SET name='$name', email='$email', username='$username', role='$role' WHERE id=$id");

        $description = "Se editó el usuario: ".$name;
        $result2 = mysqli_query($mysqli, "INSERT INTO audit_process_tracking (action, date, user_id, description) VALUES('Update user', CURRENT_TIMESTAMP, '$usersId', '$description')");

		header("Location: users.php");
	}
}
?>
<?php
    $id = $_GET['id'];
    $result = mysqli_query($mysqli, "SELECT * FROM users WHERE id=$id");

    $roles = mysqli_query($mysqli, "SELECT * FROM roles;");   
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
                        <a href="users.php" class="btn btn-success">
                            <i class="material-icons">remove_red_eye</i> <span>Ver usuarios</span>
                        </a>
                        <a href="index.php" class="btn btn-success">
                            <i class="material-icons">home</i> <span>Inicio</span>
                        </a>
                    </div>
                </div>
            </div>
            <form name="form1" method="post" action="edit_user.php">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th id="name_header">Nombre</th>
                            <th id="email_header">Correo</th>
                            <th id="username_header">Usuario</th>
                            <th id="role_header">Rol</th>
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
                                <input type="text" class="form-control" name="email"
                                    value="<?php echo $res['email'];?>">
                            </td>
                            <td>
                                <input type="text" class="form-control" name="username"
                                    value="<?php echo $res['username'];?>">
                            </td>
                            <td>
                                <select name="role" class="form-control" id="role-selector">
                                    <?php
                                        while($role = mysqli_fetch_assoc($roles)) {
                                            if($res['role'] ==  $role['name']){
                                                $selected = 'selected';
                                            }else {
                                                $selected = '';
                                            }
                                            echo "<option $selected value='".$role['name']."'>".$role['name']."</option>";
                                        }
                                    ?>
                                </select>
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
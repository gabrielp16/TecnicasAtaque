<?php session_start(); ?>

<?php
	if(!isset($_SESSION['valid'])) {
		header('Location: login.php');
	}
?>

<?php
	include_once("connection.php");
    $result = mysqli_query($mysqli, "SELECT * FROM users ORDER BY name ASC");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lista de roles | Gabriel Peña & Manuel Albarran</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</head>

<body>
    <div class="container users-list">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h2>Lista de usuarios</h2>
                    </div>
                    <div class="col-sm-6">
                        <a href="logout.php" class="btn btn-danger">
                            <i class="material-icons">exit_to_app</i> <span>Salir</span>
                        </a>
                        <a href="add_user.php" class="btn btn-success">
                            <i class="material-icons">&#xE147;</i> <span>Crear usuario</span>
                        </a>
                        <a href="index.php" class="btn btn-success">
                            <i class="material-icons">home</i> <span>Inicio</span>
                        </a>
                    </div>
                </div>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th id="name_header">Nombre</th>
                        <th id="mail_header">Correo</th>
                        <th id="username_header">Usuario</th>
                        <th id="role_header">Rol</th>
                        <th id="status_header">Estado</th>
                        <th id="action_header">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
						while($res = mysqli_fetch_assoc($result)) {
                            if($res['active'] == 1){
                                $status = 'Activo';
                                $icon = 'block';
                                $class = 'delete';
                                $text = 'Bloquear';
                            }else{
                                $status = 'Inactivo';                                
                                $icon = 'check';
                                $class = 'active';
                                $text = 'Activar';
                            }
					?>
                    <tr class="user-item">
                        <?php echo "<td>".$res['name']."</td>"?>
                        <?php echo "<td>".$res['email']."</td>"?>
                        <?php echo "<td>".$res['username']."</td>"?>
                        <?php echo "<td>".$res['role']."</td>"?>
                        <?php echo "<td>".$status."</td>"?>

                        <td class="<?php echo $classHide ?>">
                            <a href="edit_user.php?id=<?php echo $res[id]?>" class="edit">
                                <i class="material-icons" data-toggle="tooltip" title="Editar">&#xE254;</i>
                            </a>
                            <a href="block_user.php?id_user=<?php echo $res[id]?>&name_user=<?php echo $res[name]?>&active=<?php echo $res[active]?>"
                                class="<?php echo $class?>">
                                <i class="material-icons" data-toggle="tooltip"
                                    title="<?php echo $text?>"><?php echo $icon?></i>
                            </a>
                            <a href="user_detail.php?id=<?php echo $res[id]?>" class="datail">
                                <i class="material-icons" data-toggle="tooltip" title="Ir al detalle">input</i>
                            </a>
                        </td>
                    </tr>
                    <?php
						}
					?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
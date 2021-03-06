<?php session_start(); ?>

<?php
	if(!isset($_SESSION['valid'])) {
		header('Location: login.php');
	}
?>

<?php
	include_once("connection.php");
    $result = mysqli_query($mysqli, "SELECT * FROM roles ORDER BY name ASC");
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
    <div class="container">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h2>Lista de roles</h2>
                    </div>
                    <div class="col-sm-6">
                        <a href="logout.php" class="btn btn-danger">
                            <i class="material-icons">exit_to_app</i> <span>Salir</span>
                        </a>
                        <a href="#addEmployeeModal" data-toggle="modal" class="btn btn-success">
                            <i class="material-icons">&#xE147;</i> <span>Agregar nuevo rol</span>
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
                        <th id="action_header">Accion</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
						while($res = mysqli_fetch_assoc($result)) {
					?>
                    <tr>
                        <?php echo "<td>".$res['name']."</td>"?>

                        <td class="<?php echo $classHide ?>">
                            <a href="edit_role.php?id=<?php echo $res[id]?>" class="edit">
                                <i class="material-icons" data-toggle="tooltip" title="Editar">&#xE254;</i>
                            </a>
                            <a href="delete_role.php?id_role=<?php echo $res[id]?>&name_role=<?php echo $res[name]?>"
                                class="delete">
                                <i class="material-icons" data-toggle="tooltip" title="Borrar">&#xE872;</i>
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
    <!-- Agregar - Modal -->
    <div id="addEmployeeModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="add_roles.php" method="post" name="form1">
                    <div class="modal-header">
                        <h4 class="modal-title">Agregar nuevo role</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nombre</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="wrap-checkbox">
                            <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                <input type="checkbox" class="custom-control-input" id="products" name="products"
                                    value="active">
                                <label class="custom-control-label" for="products">Listar y/o agregar productos</label>
                            </div>
                            <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                <input type="checkbox" class="custom-control-input" id="roles" name="roles"
                                    value="active">
                                <label class="custom-control-label" for="roles">Listar y/o crear roles</label>
                            </div>
                            <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                <input type="checkbox" class="custom-control-input" id="audit" name="audit"
                                    value="active">
                                <label class="custom-control-label" for="audit">Auditar</label>
                            </div>
                            <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                <input type="checkbox" class="custom-control-input" id="users" name="users"
                                    value="active">
                                <label class="custom-control-label" for="users">Listar usuarios</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
                        <input type="submit" class="btn btn-success" name="Submit" value="Agregar">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Borrar - Modal -->
    <div id="deleteEmployeeModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h4 class="modal-title">Borrar elemento</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p>¿Esta seguro que desea borrar este elemento?</p>
                        <p class="text-warning"><small>Esta accion no puede ser reversada.</small></p>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
                        <input type="submit" class="btn btn-danger" value="Borrar">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
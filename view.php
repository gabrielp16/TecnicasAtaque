<?php session_start(); ?>

<?php
	if(!isset($_SESSION['valid'])) {
		header('Location: login.php');
	}
?>

<?php
	include_once("connection.php");
    $users = mysqli_query($mysqli, "SELECT * FROM users WHERE id=".$_SESSION['id']." ORDER BY id DESC");    

    $search = $_GET["search"];
    $search_selector = $_GET["search_selector"];
    $order_type = $_GET['order_type'];
    $order = $_GET['order'];

    if(empty($search_selector)){
        $search_selector = 'products.name';
    }
    if(empty($order_type)){
        $order_type = 'id';
    }
    if(empty($order)){
        $order = 'DESC';
    }

    $result = mysqli_query($mysqli, "SELECT products.*, users.id AS userId FROM products INNER JOIN users ON products.users_id = users.id WHERE $search_selector LIKE '$search%' and users_id=".$_SESSION['id']." ORDER BY ".$order_type." ".$order); 


    while($user = mysqli_fetch_assoc($users)) {
        if ($user['role'] == 'cliente'): 
            $classHide='hide-class';
        else: 
            $classHide='show-class';
        endif;
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lista de producto | Gabriel Peña & Manuel Albarran</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</head>

<body>
    <div class="container product-list">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h2>Lista de productos</h2>
                    </div>
                    <div class="col-sm-6">
                        <a href="logout.php" class="btn btn-danger">
                            <i class="material-icons">exit_to_app</i> <span>Salir</span>
                        </a>
                        <a href="#addEmployeeModal" data-toggle="modal" class="btn btn-success">
                            <i class="material-icons">&#xE147;</i> <span>Agregar nuevo producto</span>
                        </a>
                        <a href="index.php" class="btn btn-success">
                            <i class="material-icons">home</i> <span>Inicio</span>
                        </a>
                    </div>
                    <div class="col-12">
                        <?php include("search-component.php");?>
                    </div>
                </div>
            </div>
            <table class="table table-striped table-hover products-table">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>Fecha de vencimiento <span>(AAAA-MM-DD)</span></th>
                        <th>Estado</th>
                        <th class="<?php echo $classHide ?>">Accion</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
						while($res = mysqli_fetch_assoc($result)) {
					?>
                    <?php
                        $stateClass = $res['expiration_status'];
                        switch ($stateClass) {
                            case 'expired':
                                $state = 'Expirado'; 
                                break;
                            case 'soon-expired':
                                $state = 'Proximo a vencerse'; 
                                break;                            
                            default:
                                $state = 'Al dia'; 
                                break;
                        }
                    ?>
                    <tr class="product-item <?php echo $stateClass ?>">
                        <?php echo "<td>".$res['name']."</td>"?>
                        <?php echo "<td>".$res['qty']."</td>"?>
                        <?php echo "<td>$".$res['price']."</td>"?>
                        <?php echo "<td>".$res['expiration_date']."<i class='alerta material-icons'>warning</i></td>"?>
                        <?php echo "<td>".$state."</td>"?>

                        <td class="<?php echo $classHide ?>">
                            <a href="edit.php?id=<?php echo $res[id]?>" class="edit">
                                <i class="material-icons" data-toggle="tooltip" title="Editar">&#xE254;</i>
                            </a>
                            <a href="delete.php?id=<?php echo $res[id]?>&name=<?php echo $res[name]?>" class="delete">
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
                <form action="add.php" method="post" name="form1">
                    <div class="modal-header">
                        <h4 class="modal-title">Agregar nuevo producto</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nombre</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="form-group">
                            <label>Cantidad</label>
                            <input type="number" class="form-control" name="qty" required>
                        </div>
                        <div class="form-group">
                            <label>Precio</label>
                            <input type="number" class="form-control" name="price" required>
                        </div>
                        <div class="form-group">
                            <label>Fecha de vencimiento (AAAA-MM-DD)</label>
                            <input type="text" class="form-control" name="expiration_date" required>
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
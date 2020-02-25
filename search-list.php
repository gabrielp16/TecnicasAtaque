<?php session_start(); ?>

<?php
	if(!isset($_SESSION['valid'])) {
		header('Location: login.php');
	}
?>

<?php
    include_once("connection.php");
    
    $search = $_GET["search"];
    $search_selector = $_GET["search_selector"];
    $result = mysqli_query($mysqli, "SELECT services.name AS productName , services.qty, services.price, users.name AS usersName , users.email, users.role FROM services INNER JOIN users ON services.users_id = users.id  WHERE $search_selector LIKE '%$search%'"); 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Search</title>

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
                    <div class="col-sm-4">
                        <h2>Búsqueda de servicios</h2>
                    </div>
                    <div class="col-sm-8">
                        <a href="logout.php" class="btn btn-danger">
                            <i class="material-icons">exit_to_app</i> <span>Salir</span>
                        </a>
                        <a href="index.php" class="btn btn-success">
                            <i class="material-icons">home</i> <span>Inicio</span>
                        </a>
                        <form class="form-inline" action="search.php" method="post" name="form1">
                            <div class="input-group">
                                <input class="form-control" type="search" name="search" placeholder="Buscar" aria-label="Search"> 
                                <select name="search-selector" class="form-control" id="search-selector">
                                    <option value="services.name">Servicio</option>
                                    <option value="services.qty">Cantidad</option>
                                    <option value="services.price">Precio</option>
                                    <option value="users.name">Usuario</option>
                                    <option value="users.email">Correo</option>
                                    <option value="users.role">Rol</option>
                                </select>                                
                                <button class="btn btn btn-success my-0" type="submit" name="submit_search">Buscar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <table class="table table-striped table-hover actions">
                <thead>
                    <tr>
                        <th id="name">Nombre del servicio</th>
                        <th id="qty">Cantidad</th>
                        <th id="price">Precio</th>
                        <th id="user">Nombre del usuario</th>
                        <th id="email">Correo del usuario</th>
                        <th id="role">Rol</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
						while($res = mysqli_fetch_assoc($result)) {
					?>
                    <tr>
                        <?php echo "<td>".$res['productName']."</td>"?>
                        <?php echo "<td>".$res['qty']."</td>"?>
                        <?php echo "<td>".$res['price']."</td>"?>
                        <?php echo "<td>".$res['usersName']."</td>"?>
                        <?php echo "<td>".$res['email']."</td>"?>
                        <?php echo "<td>".$res['role']."</td>"?>
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
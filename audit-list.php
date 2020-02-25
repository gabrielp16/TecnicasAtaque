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
    $result = mysqli_query($mysqli, "SELECT * FROM users INNER JOIN audit_process_tracking ON users.id = audit_process_tracking.user_id WHERE $search_selector LIKE '%$search%' ORDER BY date ASC"); 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Audit | Gabriel Peña</title>

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
                        <h2>Auditoria</h2>
                    </div>
                    <div class="col-sm-8">
                        <a href="logout.php" class="btn btn-danger">
                            <i class="material-icons">exit_to_app</i> <span>Salir</span>
                        </a>
                        <a href="index.php" class="btn btn-success">
                            <i class="material-icons">home</i> <span>Inicio</span>
                        </a>
                        <form class="form-inline" action="audit.php" method="post" name="form1">
                            <div class="input-group">
                                <input class="form-control" type="search" name="search" placeholder="Buscar" aria-label="Search"> 
                                <select name="search-selector" class="form-control" id="search-selector">
                                    <option value="name">Nombre</option>
                                    <option value="username">Usuario</option>
                                    <option value="action">Acción</option>
                                    <option value="email">Correo</option>
                                    <option value="role">Rol</option>
                                </select>                                
                                <button class="btn btn btn-success my-0" type="submit" name="submit_audit">Buscar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <table class="table table-striped table-hover actions">
                <thead>
                    <tr>
                        <th id="name">Nombre</th>                        
                        <th id="action">Acción</th>
                        <th id="date">Fecha</th>
                        <th id="description">Descripción</th>
                        <th id="email">Correo</th>
                        <th id="username">Usuario</th>
                        <th id="role">Rol</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
						while($res = mysqli_fetch_assoc($result)) {
					?>
                    <tr>
                        <?php echo "<td>".$res['name']."</td>"?>
                        <?php echo "<td>".$res['action']."</td>"?>
                        <?php echo "<td>".$res['date']."</td>"?>
                        <?php echo "<td>".$res['description']."</td>"?>
                        <?php echo "<td>".$res['email']."</td>"?>
                        <?php echo "<td>".$res['username']."</td>"?>
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
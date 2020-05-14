<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Bienvenido | Gabriel Peña & Manuel Albarran</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="style.css" rel="stylesheet" type="text/css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
    <?php
	if(isset($_SESSION['valid'])) {			
		include("connection.php");					
        $users = mysqli_query($mysqli, "SELECT * FROM users WHERE id=".$_SESSION['id']." ORDER BY id DESC");
        
        while($user = mysqli_fetch_assoc($users)) {
            if ($user['role'] != 'administrador'): 
                $classHide='hide-class';
                $user_data=$user;
            else: 
                $classHide='show-class';
                $user_data=$user;
            endif;
        }
	?>
    <form id="myModal" name="form1" method="post" action="">
        <div class="modal-dialog modal-login">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="avatar">
                        <img src="images/logo.png" alt="Avatar">
                    </div>
                    <h4 class="modal-title"><?php echo $_SESSION['name'] ?></h4>
                    <p class="modal-paragraph">Bienvenido</p>
                </div>
                <?php 
                    if($user_data['active'] == 1){
                ?>
                <div class="modal-body">
                    <div class="form-group">
                        <button class="btn btn-primary btn-lg btn-block login-btn">
                            <a href='view.php?search=&search_selector=products.name&order_type=id&order=DESC'>Listar y/o
                                agregar productos</a>
                        </button>
                        <button class="btn btn-primary btn-lg btn-block login-btn">
                            <a href='search-list.php?search=&search_selector=products.name&order_type=id&order=DESC'>Buscar
                                productos</a>
                        </button>
                        <button class="btn btn-primary btn-lg btn-block login-btn <?php echo $classHide ?>">
                            <a href='roles.php'>Listar y/o crear roles</a>
                        </button>
                        <button class="btn btn-primary btn-lg btn-block login-btn <?php echo $classHide ?>">
                            <a href='audit-list.php?search=&search_selector=name'>Auditar</a>
                        </button>
                        <button class="btn btn-primary btn-lg btn-block login-btn <?php echo $classHide ?>">
                            <a href='users.php'>Listar usuarios</a>
                        </button>
                    </div>
                </div>
                <?php 
                    } else {
                ?>
                <p class="modal-paragraph center">Este usuario se encuentra bloqueado</p>
                <?php 
                    }
                ?>
                <div class="modal-footer">
                    <a href='logout.php'>Salir</a>
                </div>
            </div>
        </div>
    </form>
    <?php	
	    } else {
    ?>
    <form id="myModal" name="form1" method="post" action="">
        <div class="modal-dialog modal-login">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="avatar">
                        <img src="images/logo.png" alt="Avatar">
                    </div>
                    <h4 class="modal-title">Bienvenido</h4>
                    <p class="modal-paragraph">Se debe estar registrado para ingresa.</p>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <button class="btn btn-primary btn-lg btn-block login-btn">
                            <a href="login.php">Ingresar</a>
                        </button>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary btn-lg btn-block login-btn">
                            <a href="register.php">Registrarse</a>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <?php
	    }
	?>
</body>

</html>
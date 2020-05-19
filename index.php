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
        $users = mysqli_query($mysqli, "SELECT users.name, users.active , roles.* FROM users INNER JOIN roles ON users.role = roles.id WHERE users.id=".$_SESSION['id']);
        
        while($user = mysqli_fetch_assoc($users)) {
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
                    if($user['active'] == 1){
                ?>
                <div class="modal-body">
                    <div class="form-group">
                        <?php if ( $user['products'] == 1 ){ ?>
                        <button class="btn btn-primary btn-lg btn-block login-btn">
                            <a href='view.php?search=&search_selector=products.name&order_type=id&order=DESC'>Listar y/o
                                agregar productos</a>
                        </button>
                        <?php } ?>

                        <?php if ( $user['roles'] == 1 ){ ?>
                        <button class="btn btn-primary btn-lg btn-block login-btn <?php echo $classHide ?>">
                            <a href='roles.php'>Listar y/o crear roles</a>
                        </button>
                        <?php } ?>

                        <?php if ( $user['audit'] == 1 ){ ?>
                        <button class="btn btn-primary btn-lg btn-block login-btn <?php echo $classHide ?>">
                            <a href='audit-list.php?search=&search_selector=name'>Auditar</a>
                        </button>
                        <?php } ?>

                        <?php if ( $user['users'] == 1 ){ ?>
                        <button class="btn btn-primary btn-lg btn-block login-btn <?php echo $classHide ?>">
                            <a href='users.php'>Listar usuarios</a>
                        </button>
                        <?php } ?>
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
    }	
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
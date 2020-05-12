<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ingreso | Gabriel Peña & Manuel Albarran</title>

    <link href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link href="style.css" rel="stylesheet" type="text/css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>

<body>
    <?php 
	
        include("connection.php");

        if(isset($_POST['submit'])) {
            $user = mysqli_real_escape_string($mysqli, $_POST['username']);
            $pass = mysqli_real_escape_string($mysqli, $_POST['pass']);

            if($user == "" || $pass == "") {
                echo "Either username or password field is empty.";
                echo "<br/>";
                echo "<a href='login.php'>Go back</a>";
            } else {
                $result = mysqli_query($mysqli, "SELECT * FROM users WHERE username='$user' AND pass=md5('$pass')")
                            or die("Could not execute the select query.");
                
                $row = mysqli_fetch_assoc($result);
                
                if(is_array($row) && !empty($row)) {
                    $validuser = $row['username'];
                    $_SESSION['valid'] = $validuser;
                    $_SESSION['name'] = $row['name'];
                    $_SESSION['id'] = $row['id'];
                } else {
    ?>
    <form id="myModal" name="form1" method="post" action="">
        <div class="modal-dialog modal-login">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="avatar">
                        <img src="images/logo.png" alt="Avatar">
                    </div>
                    <p class="modal-paragraph">Usuario o contraseña invalida.</p>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <button class="btn btn-primary btn-lg btn-block login-btn">
                            <a href='login.php'>Regresar</a>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <?php
                }
                if(isset($_SESSION['valid'])) {
                    header('Location: index.php');
                }
            }
        } else {
    ?>

    <!-- Modal HTML -->
    <form id="myModal" name="form1" method="post" action="">
        <div class="modal-dialog modal-login">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="avatar">
                        <img src="images/logo.png" alt="Avatar">
                    </div>
                    <h4 class="modal-title">Ingreso</h4>
                </div>
                <div class="modal-body">
                    <form action="/examples/actions/confirmation.php" method="post">
                        <div class="form-group">
                            <input type="text" class="form-control" name="username" placeholder="Usuario"
                                required="required">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="pass" placeholder="Contraseña"
                                required="required">
                        </div>
                        <div class="form-group">
                            <button type="submit" name="submit"
                                class="btn btn-primary btn-lg btn-block login-btn">Ingresar</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <a href="index.php">Inicio</a>
                    |
                    <a href="register.php">Registrarse</a>
                </div>
            </div>
        </div>
    </form>
    <?php
	}
?>
</body>

</html>
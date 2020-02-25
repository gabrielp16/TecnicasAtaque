<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registro</title>

    <link href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="style.css" rel="stylesheet" type="text/css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
    <?php
		include("connection.php");
        $roles = mysqli_query($mysqli, "SELECT * FROM roles;");   

		if(isset($_POST['submit'])) {
			$name = $_POST['name'];
			$email = $_POST['email'];
			$user = $_POST['username'];
            $pass = $_POST['pass'];
            $role = $_POST['role'];

			if($user == "" || $pass == "" || $name == "" || $email == "" || $role == "") {
	?>

    
    <form id="myModal" name="form1" method="post" action="">
        <div class="modal-dialog modal-login">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="avatar">
                        <img src="images/logo.png" alt="Avatar">
                    </div>
                    <p class="modal-paragraph">Todos los campos deben ser llenados. Todos o al menos uno esta vacio.</p>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <button class="btn btn-primary btn-lg btn-block login-btn">
                            <a href='register.php'>Registrarse</a>
                        </button>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href='logout.php'>Salir</a>
                </div>
            </div>
        </div>
    </form>
    <?php
			} else {
				mysqli_query($mysqli, "INSERT INTO users (name, email, username, pass, role) VALUES('$name', '$email', '$user', md5('$pass'), '$role')")
					or die("No se pudo realizar la operación.");
	?>
    <form id="myModal" name="form1" method="post" action="">
        <div class="modal-dialog modal-login">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="avatar">
                        <img src="images/logo.png" alt="Avatar">
                    </div>
                    <h4 class="modal-title"><?php echo $name ?></h4>
                    <p class="modal-paragraph">Bienvenido - Registro exitoso</p>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <button class="btn btn-primary btn-lg btn-block login-btn">
                            <a href='login.php'>Ingresar</a>
                        </button>
                    </div>
                </div>
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
                    <h4 class="modal-title">Registro</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" name="name" placeholder="Nombre" required="required">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="email" placeholder="Correo" required="required">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="username" placeholder="Usuario"
                            required="required">
                    </div>
                    <div class="form-group">
                        <select name="role" class="form-control" id="role-selector">
                        <?php
                            while($role = mysqli_fetch_assoc($roles)) {
                                echo "<option value='".$role['name']."'>".$role['name']."</option>";
                            }
                        ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="pass" placeholder="Contraseña"
                            required="required">
                    </div>
                    <div class="form-group">
                        <button type="submit" name="submit"
                            class="btn btn-primary btn-lg btn-block login-btn">Registrarse</button>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="index.php">Inicio</a>
                    |
                    <a href="login.php">Ingresar</a>
                </div>
            </div>
        </div>
    </form>
    <?php
}
?>
</body>

</html>
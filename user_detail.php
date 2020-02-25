<?php session_start(); ?>

<?php
	if(!isset($_SESSION['valid'])) {
		header('Location: login.php');
	}
?>

<?php
	include_once("connection.php");
    $result = mysqli_query($mysqli, "SELECT users.*, user_detail.* FROM users INNER JOIN user_detail ON users.id=user_detail.user_id WHERE users.id=".$_GET['id']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lista de roles | Gabriel Peña</title>

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
                        <h2>Detalle de usuario</h2>
                    </div>
                    <div class="col-sm-6">
                        <a href="logout.php" class="btn btn-danger">
                            <i class="material-icons">exit_to_app</i> <span>Salir</span>
                        </a>
                        <a href="users.php" class="btn btn-success">
                            <i class="material-icons">home</i> <span>Usuarios</span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="form-group row user-detail">
                <div class="col-sm-10">
                    <?php
						while($res = mysqli_fetch_assoc($result)) {
                            ?>
                    <label class="col-sm-2 col-form-label">Nombre</label>
                    <p><?php echo $res['name']?></p>

                    <label class="col-sm-2 col-form-label">Usuario</label>
                    <p><?php echo $res['username']?></p>

                    <label class="col-sm-2 col-form-label">Correo</label>
                    <p><?php echo $res['email']?></p>

                    <label class="col-sm-2 col-form-label">Identificacion</label>
                    <p><?php echo $res['dni']?></p>

                    <label class="col-sm-2 col-form-label">Direccion</label>
                    <p><?php echo $res['address']?></p>

                    <label class="col-sm-2 col-form-label">Padres</label>
                    <p><?php echo $res['parent_names']?></p>

                    <label class="col-sm-2 col-form-label">Estudios</label>
                    <p><?php echo $res['bachelor_degree']?></p>

                    <label class="col-sm-2 col-form-label">Redes sociales</label>
                    <p><?php echo $res['social_media']?></p>

                    <h3>Links para los archivos</h3>
                    <label class="col-sm-2 col-form-label">Imagen</label>
                    <i><a href="images/logo.png">Logo app</a></i>

                    <label class="col-sm-2 col-form-label">Video</label>
                    <i><a href="videos/Explicacion_video.mp4">Explicacion_video.mp4</a></i>

                    <label class="col-sm-2 col-form-label">Video</label>
                    <i><a href="files/Actividad_1-_AtaqueSocial.docx">Actividad_1-_AtaqueSocial.docx</a></i>

                    <?php
						}
					?>

                </div>
            </div>
        </div>
    </div>
</body>

</html>
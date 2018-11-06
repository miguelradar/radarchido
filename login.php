<?php

	namespace App;

	require_once  './vendor/autoload.php';

	use App\Sys\Debug;
	use App\Sys\Conexion;

	// Inicia o reanuda una sesion de usuario
	session_start();

	// $_SESSION variable global creada traz sesion start
	if(!empty($_SESSION) && !empty($_SESSION['correo'])){
		header('Location: ./home.php');
	}

	$conexion = new Conexion;
	// $_GET | $_POST
	// $_GET en url
	// $_POST viajan en cabeza del http

	if($_POST){
		$correo = $_POST['correo'];
		$pass = $_POST['pass'];

		$query = "SELECT * FROM usuario WHERE correo = '$correo'";

		// Se ejecuta la consulta
		$respuesta  =$conexion->query($query);

		if(!$respuesta){
			Debug::parar($conexion->error);
		}else{
			// consulta de usuario
			if($usuario = $respuesta->fetch_assoc()){ // Agarramos el primer row del resultado [0]
				$pass = hash('sha256', $pass);

				if(hash_equals($usuario['pass'], $pass)){
					$alerta = 'Usuario inisio sesion con exito';
					$_SESSION['id'] = $usuario['id'];
					$_SESSION['correo'] = $usuario['correo'];
					
					header('Location: ./home.php');
				}else{
					$alerta = 'claves erroneas';
				}
			}else{
				$alerta = 'Usuario no existe';
			}
		}
	}

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>Login</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
			integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<link rel="stylesheet" href="./assets/css/style.css">
	</head>
	<body class="body-fondo">
		<div class="container">
			<!-- Clase container es la que da relacion con el viewport
				necesaria por bootstrap -->
			<div class="row">
				<!-- clase row declarar renglones -->
				<div class="col-12 col-md-6 offset-md-3 bg-white form-card">
					<!-- clases col dependeindo de cuantas columnas vallamos a usar
						segun el grid de bootstrap (12 columnas) -->
					<h2>Inicio de sesion</h2>
					<?php
						if(!empty($alerta)){
							echo "<p>$alerta</p>";
						}
					?>
					<form method="post" action="login.php">
						<!-- clase form group agrupa elementos de una forma -->
						<div class="form-group">
							<label for="correo">Correo</label>
							<input id="correo" class="form-control" type="email" name="correo">
						</div>
						<div class="form-group">
							<label for="pass">Contraseña</label>
							<input id="pass" class="form-control" type="password" name="pass">
						</div>
						<center>
							<!-- clase Btn es para estilizar botones tambien parte de bootstrap -->
							<button type="submit" class="btn btn-info">
								Ingresar
							</button>
						</center>
					</form>
					<hr> <!-- hr pone una linea de separacion -->
					<center>
						<small><i>*En caso de no tener una cuenta registrate dando
						<!-- anchor => ir a un url | crear un link -->
						<a href="./index.php">Click aqui!</a></i></small>
					</center>
				</div>
			</div>
		</div>
	</body>
</html>

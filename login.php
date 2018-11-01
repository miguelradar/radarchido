<?php

	namespace App;

	require_once  './vendor/autoload.php';

	use App\Sys\Debug;

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
					<form method="post" action="index.php">
						<!-- clase form group agrupa elementos de una forma -->
						<div class="form-group">
							<label for="usuario">Usuario</label>
							<input id="usuario" class="form-control" type="text" name="usuario">
						</div>
						<div class="form-group">
							<label for="constrasenia">Contraseña</label>
							<input id="constrasenia" class="form-control" type="password" name="constrasenia">
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

<?php

	namespace App;
	
	require_once './vendor/autoload.php';
	
	use App\Sys\Debug;
	use App\Sys\Conexion;
	
	$conexion = new Conexion;
	
	if(!empty($_POST)){
		// La forma se envio
		
		$nombre = $_POST['nombre'];
		$usuario = $_POST['usuario'];
		$password = $_POST['pass'];
		
		// Expresiones regulare
		if(!preg_match('/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,}$/', $password)){
			$respuesta = '6 caracteres como minimo conteniendo mayusculas, minusculas y numeros';
		}else if(!preg_match('/^([A-Za-z\d]){4,}$/', $usuario)){
			$respuesta = 'Nombre de usuario tiene que tener como minimo 4 caracteres';
		}else{
			$respuesta = 'Usuario validado';
			
			// Agregar a la DB el usuario
		}
	}
	
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>Registro</title>
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
					<h2>Registro de usuario</h2>
					<?php if(!empty($respuesta)) : ?>
						<p><?php echo $respuesta; ?></p>
					<?php endif; ?>
					<form method="post" action="index.php">
						<!-- clase form group agrupa elementos de una forma -->
						<div class="form-group">
							<label for="nombre">Nombre completo</label>
							<input id="nombre" class="form-control" type="text" name="nombre" required>
						</div>
						<div class="form-group">
							<label for="usuario">Usuario</label>
							<input id="usuario" class="form-control" type="text" name="usuario" required>
						</div>
						<div class="form-group">
							<label for="pass">Contraseña</label>
							<input id="pass" class="form-control"  name="pass" required>
						</div>
						<center>
							<!-- clase Btn es para estilizar botones tambien parte de bootstrap -->
							<button type="submit" class="btn btn-info">
								Registrarme
							</button>
						</center>
					</form>
					<hr>
					<center>
						<small><i>*En caso de ya tener una cuenta inicia sesion dando
						<!-- anchor => ir a un url -->
						<a href="./login.php">Click aqui!</a></i></small>
					</center>
				</div>
			</div>
		</div>
	</body>
</html>
	
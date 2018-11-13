<?php

	namespace App;

	require_once './vendor/autoload.php';

	use App\Sys\Debug;
	use App\Sys\Conexion;
	use App\Sys\Database;
	use Illuminate\Database\Capsule\Manager as DB;
	
	$db = new Database;
	
	// MVC - modelo - vista - controlador
	// ORM - Object-Relational mapping
	
	$usuario = DB::table('usuario');
	
	if(false){
		$usuario = $usuario->where('id','<>',1)->get();
	}else{
		$usuario = $usuario->first();
	}

	session_start();

	if(!empty($_SESSION) && !empty($_SESSION['correo'])){
		header('Location: ./home.php');
	}

	$conexion = new Conexion;

	if(!empty($_POST)){
		// La forma se envio

		$nombre = $_POST['nombre'];
		$correo = $_POST['correo']; // 16 index correo no esta definido
		$pass = $_POST['pass'];

		// Expresiones regulare para validar contraseña
		if(!preg_match('/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,}$/', $pass)){
			$alerta = '6 caracteres como minimo conteniendo mayusculas, minusculas y numeros';
		}else{
			$alerta = 'Usuario validado';

			// Comprobamos si el usuario existe
			$query = "SELECT * FROM usuario WHERE correo = '$correo'";

			$respuesta = $conexion->query($query);
			// Debug::parar($conexion);

			if($respuesta->num_rows > 0){
				$alerta = 'Usuario ya existe';
			}else{
				// Encriptamos la contraseña
				$pass = hash('sha256', $pass);

				$insert = "INSERT INTO usuario(nombre, correo, pass) VALUES ('$nombre','$correo','$pass')";

				$respuesta = $conexion->query($insert);

				if($respuesta !== true){
					$alerta = 'Ocurrio un error a registrar el usuario';
				}else{
					$alerta = 'Usuario creado con exito';
				}
			}
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
					<?php if(!empty($alerta)) : ?>
						<p><?php echo $alerta; ?></p>
					<?php endif; ?>
					<form method="post" action="index.php">
						<!-- clase form group agrupa elementos de una forma -->
						<div class="form-group">
							<label for="nombre">Nombre completo</label>
							<input id="nombre" class="form-control" type="text" name="nombre" required>
						</div>
						<div class="form-group">
							<label for="correo">Correo</label>
							<input id="correo" class="form-control" type="email" name="correo" required>
						</div>
						<div class="form-group">
							<label for="pass">Contraseña</label>
							<input id="pass" class="form-control" type="password" name="pass" required>
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

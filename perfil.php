<?php

	namespace App;
	
	require_once './vendor/autoload.php';
	
	use App\Sys\Debug;
	use App\Sys\Servicio;
	use App\Sys\Conexion;
	
	$conexion = new Conexion;
	$servicio = new Servicio;
	
	// Tarea - buscar como prevenir el sql injection AQUI vvv
	$usuario_id = !empty($_GET['id']) ? Servicio::decode($_GET['id']) : 0;
	
	$consulta_usuario = $conexion->query("SELECT * FROM usuario WHERE id = $usuario_id");
	
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" 
			integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	</head>
	<body>
		<div class="container">
			<div class="row">
				<div class="col-md-10 offset-md-1">
					<?php 
					
					if(empty($consulta_usuario) || $consulta_usuario->num_rows == 0){
						echo "ERROR 404";
					}else{
						$usuario = $consulta_usuario->fetch_assoc();
						echo sprintf('<p>Usuario: <b>%s</b></p>', $usuario['nombre']);
						echo sprintf('<p>Descripcion: <b>%s</b></p>', $usuario['descripcion'] ? : 'N/A');
					} 
					
					?>
				</div>
			</div>
		</div>
	</body>
</html>
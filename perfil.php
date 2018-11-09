<?php

	namespace App;
	
	require_once './vendor/autoload.php';
	
	use App\Sys\Debug;
	use App\Sys\Servicio;
	use App\Sys\Conexion;
	
	$conexion = new Conexion;
	$servicio = new Servicio;
	
	session_start();
	
	$usuario_id = !empty($_GET['data']) ? Servicio::decode($_GET['data']): 0;
	$usuario_id = $usuario_id->id;
	$usuario_id = $conexion->real_escape_string($usuario_id);
	
	// Consulta vulnerable
	// $consulta_usuario = $conexion->query("SELECT * FROM usuario WHERE id = $usuario_id");
	
	if(!empty($_POST)){
		// Toda la informacion del usuario
		$data = [
			'nombre' => !empty($_POST['nombre']) ? $_POST['nombre'] : '',
			'descripcion' => !empty($_POST['desc']) ? $_POST['desc'] : '',
			'imagen' => ''
		];
		
		// La forma fue enviada
		$imagen_nombre = basename($_FILES['foto-perfil']['name']);
		$target = 'public/' . $imagen_nombre;
		$ext = strtolower(pathinfo($target, PATHINFO_EXTENSION));
		
		if(in_array($ext,['jpg','png','jpeg'])){
			if(move_uploaded_file($_FILES['foto-perfil']['tmp_name'], $target)){
				// GUARDAR en la base de datos
				$data['imagen'] = $imagen_nombre;
			}
		}
		
		$update = $conexion->prepare('UPDATE usuario SET nombre = ?, descripcion = ?, imagen = ? WHERE id = ?');
		$update->bind_param('sssi',$data['nombre'],$data['descripcion'], $data['imagen'], $usuario_id);
		$update->execute();
		$respuesta = $update->get_result();
		$update->close();
	}
	
	$query = $conexion->prepare("SELECT * FROM usuario WHERE id = ?");
	$query->bind_param('i', $usuario_id);
	$query->execute();
	$consulta_usuario = $query->get_result();
	$query->close();
	
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
						if($usuario['imagen']) : ?>
							<div>
								<img src="public/<?php echo $usuario['imagen']; ?>">
							</div>
						<?php endif;
						echo sprintf('<p>Usuario: <b>%s</b></p>', $usuario['nombre']);
						echo sprintf('<p>Descripcion: <b>%s</b></p>', $usuario['descripcion'] ? : 'N/A');
					
						if($_SESSION['correo'] == $usuario['correo']) : ?>
							<hr>
							<h3>Editar usuario</h3>
							<!-- ecntype es requerido para trabajar formas con archivos (upload) -->
							<form method="post" enctype="multipart/form-data">
								<div class="form-group">
									<label for="nombre">Nombre de usuario</label>
									<input type="text" id="nombre" class="form-control" name="nombre" value="<?php echo $usuario['nombre']; ?>" required>
								</div>
								<div class="form-group">
									<label for="desc">Descripcion</label>
									<input type="text" id="desc" class="form-control" name="desc" value="<?php echo $usuario['descripcion']; ?>">
								</div>
								<div class="form-group">
									<input type="file" name="foto-perfil">
								</div>
								<center>
									<button type="submit" class="btn btn-success">GUARDAR</button>
								</center>
							</form>
						<?php endif;
					} 
					
					?>
				</div>
			</div>
		</div>
	</body>
</html>
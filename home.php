<?php

	namespace App;
	
	require_once './vendor/autoload.php';
	
	use \stdClass;
	use App\Sys\Debug;
	use App\Sys\Conexion;
	use App\sys\Servicio;
	
	/*
	uso de cookies
	
	setcookie('tmp2',serialize([1,2,3,4,5]),time() + 83000,'/');
	
	echo $_COOKIE['tmp2'];
	
	unset($_COOKIE['tmp2']);
	
	setcookie('tmp','',time()-1,'/');
	die();*/

	// Tarea - Hacer una pagina para cada perfil de usuario
	//			que pueda ver la imagen y descripcion
	  
	/* Fechas
		$fecha = time(); // timestamp
		$fecha = date('d/m/Y H:i', $fecha); // formater la fecha
	  
	  echo "<pre>";
	  die(var_dump($fecha)); */ 

	  session_start();

	  // Si no existe sesion mandar a login
	  if(empty($_SESSION) || empty($_SESSION['correo'])){
		header('Location: ./login.php');
	  }

	  if(!empty($_POST)){
		// Forma para cerrar sesion
		if(!empty($_POST['logout']) && $_POST['logout'] == 1){
		  unset($_SESSION['id']);
		  unset($_SESSION['correo']);

		  header('Location: ./login.php');
		}
	  }
	
	$mysql = new Conexion;
	$servicios = new Servicio;
	
	$query = "SELECT * FROM usuario ORDER BY id DESC";
	
	$lista_usuarios = $mysql->query($query);
	
	// ** Forma de hacer solicitudes entre servidores (servicios)
	/*$solicitud = curl_init();
	
	curl_setopt($solicitud, CURLOPT_URL, 'http://localhost:8081/form');
	curl_setopt($solicitud, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($solicitud, CURLOPT_SSL_VERIFYPEER, false);
	
	$resultado = curl_exec($solicitud);*/
 ?>

 <!DOCTYPE html>
 <html>
  <head>
	 <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" 
		integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<script>
		// Se interpreta javascript
	</script>
  </head>
  <body>
	<?php include 'include/navbar.php'; ?>
	<!--  
		**** Pueden descomentar esto para ver la forma con la que les explique 
			los tipos inputs y el modelo de cajas
		
		tipos de displays:
		*- block - ocupa todo el ancho posible
		*- inline-block - solo ocupa el ancho que abarque el contenido
		*- inline - lo trata como palabra (sin margen y sin padding)
		*- none - no dibuja el elemento en el DOM
		
		modelo de cajas:
			margin: 50px;
			border: 23px solid #da81db;
			padding: 10px;
			
		position: relative
		position: absolute
	
	<div style="position:relative;overflow:hidden">
		Hola soy Miguel y esta es mi pagina web
		<div style="position:absolute">
			Texto que estorba
		</div>
		<script>
			// codigo javascript
		</script>
	</div>
	<form>
		<input type="text" name="buscador" value="<?php echo !empty($_GET['buscador']) ? $_GET['buscador'] : ''; ?>"><!--
		<button type="submit">
			Buscar
		</button>
		<?php 
		
		if(!empty($_POST['tipo'])){
			$selected = 'selected';
		}else{
			$selected = '';
		}
		
		$buscador_tipo = !empty($_POST['tipo']) ? 'selected' : ''; ?>
		<select name="tipo">
			<option value="1" <?php echo !empty($_GET['tipo']) && $_GET['tipo'] == 1 ? 'selected' : ''; ?>>Admin</option>
			<option value="2" <?php echo !empty($_GET['tipo']) && $_GET['tipo'] == 2 ? 'selected' : ''; ?>>Moderador</option>
			<option value="3" <?php echo !empty($_GET['tipo']) && $_GET['tipo'] == 3 ? 'selected' : ''; ?>>Usuario</option>
		</select>
		<textarea rows="10" name="desc"><?php echo !empty($_GET['desc']) ? $_GET['desc'] : ''; ?></textarea>
		<br>
		<hr>
		<h3>Checkbox de muestra</h3>
		<label>Aceptas los terminos<input type="checkbox" name="aceptas" value="1" checked></label><br>
		<label>Cambiar de vida<input type="checkbox" name="cambio" value="1"></label>
		<br>
		<hr>
		<h3>Radio buttons de muestra</h3>
		<label>Opcion 1<input type="radio" name="opt" value="1"></label>
		<label>Opcion 2<input type="radio" name="opt" value="2"></label>
		<label>Opcion 3<input type="radio" name="opt" value="3" checked></label>
		<input hidden name="escondido">
		<input type="date" name="fecha">
	</form>
	-->
	<div class="container">
		<div class="row">
			<div class="col-md-10 offset-md-1">
				<h1>Home de la App</h1>
				<p>Bienvenido <?php echo $_SESSION['correo']; ?></p>
				
				<hr>
				
				<h3>Lista de usuarios</h3>
				<table class="table">
					<thead>
						<tr>
							<th>ID</th>
							<th>Correo</th>
							<th>Nombre</th>
						</tr>
					</thead>
					<tbody>
						<?php // text-center
						
							if(empty($lista_usuarios)){
								echo "<tr><td style='text-align:center' colspan='3'>Sin usuarios</td></tr>";
							}else{
								// Regresar todo los resultados como un arreglo
								// $usuarios = $lista_usuarios->fetch_all(MYSQLI_ASSOC);
								
								while($usuario = $lista_usuarios->fetch_assoc()){
								?>
									<tr>
										<td><?php echo $usuario['id']; ?></td>
										<td><?php echo $usuario['correo']; ?></td>
										<td><a href="./perfil.php?data=<?php echo Servicio::encode(['id' => $usuario['id']]); ?>"><?php echo $usuario['nombre']; ?></a></td>
									</tr>
								<?php }
							}
						
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<!--
	<div>
		<table>
			<thead>
				<tr>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td></td>
				</tr>
			</tbody>
			<tfoot>
				<tr>
					<td></td>
				</tr>
			</tfoot>
		</table>
	</div>
	-->
  </body>
 </html>

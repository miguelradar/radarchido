<?php

  

  // Tarea - pagina para el perfil del usuario en sesion
  // Agregar variable para Nombre

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

 ?>

 <!DOCTYPE html>
 <html>
  <body>
	<!--  tipos de displays:
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
	-->
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
		--><button type="submit">
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
	</form>
    <h1>Home de la App</h1>
    <p>Bienvenido <?php echo $_SESSION['correo']; ?></p>
    <form method="post">
      <input type="hidden" class="" name="logout" value="1">
      <button type="submit" onclick="alert('Vuelve pronto')">
        Cerrar sesion
      </button>
    </form>
  </body>
 </html>

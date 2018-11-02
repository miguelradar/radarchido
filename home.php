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
    <h1>Home de la App</h1>
    <p>Bienvenido <?php echo $_SESSION['correo']; ?></p>
    <form method="post">
      <input type="hidden" name="logout" value="1">
      <button type="submit">
        Cerrar sesion
      </button>
    </form>
  </body>
 </html>

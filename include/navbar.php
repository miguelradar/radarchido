<?

	namespace App\Include;
	
	require_once '../vendor/autoload.php';
	
	use app\sys\Servicio;
	
	$_serv_navbar_ = new Servicio;
	
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
	<a class="navbar-brand" href="<?php echo "{$_serv_navbar_->link}home.php"; ?>">RADAR</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse" id="navbarText">
		<ul class="navbar-nav mr-auto">
		</ul>
		<span class="navbar-text">
			<form method="post">
				<input type="hidden" class="" name="logout" value="1">
					<button type="submit" class="btn btn-danger" onclick="alert('Vuelve pronto')">
					Cerrar sesion
					</button>
			</form>
		</span>
	</div>
</nav>
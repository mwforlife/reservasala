<?php
session_start();
if (!isset($_SESSION['id'])) {
	header('Location: index.php');
}

include 'php/controller.php';

$c = new Controller();

?>

<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="utf-8">
	<title>Reserva Sala Computación</title>
	<meta name="author" content="Your Name">
	<meta name="description" content="Example description">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/animate.min.css">
	<link rel="stylesheet" href="css/colores.css">
	<link rel="stylesheet" href="css/jquery-ui.structure.min.css">
	<link rel="stylesheet" href="css/jquery-ui.theme.min.css">
	<link rel="stylesheet" href="css/estilo_reserva.css">
	<link rel="icon" type="image/x-icon" href="img/log.png"/>
</head>

<body>
<div class="mis-reservas">
	<div class="details">
		<h6 class="text-center">Reservas de Hoy</h6>
		
		<?php
		$lista = $c->listarreservashoy($_SESSION['id']);
		if (count($lista) > 0) {
			for ($i=0; $i < count($lista); $i++) { 
				$r = $lista[$i];
				echo '<div class="reserva">';
				echo '<div class="bloque">';
				echo '<h6 class="name">'.$r->getBloque().'</h6>';
				echo '<h6 class="curso">Curso: '.$r->getCurso().'</h6>';
				if ($r->getSala()==1) {
					echo '<h6 class="sala">Laboratorio Computación</h6>';
				}else{
					echo '<h6 class="sala">Sala Computación</h6>';
				}
				echo '<h6 class="asignatura">Asignatura: '.$r->getAsignatura().'</h6>';
				echo '</div>';
				echo '</div>';
			}
	 	} else {
			echo '<h6 class="text-center">No hay reservas registradas por hoy</h6>';
		}
		?>

		
		
		
	</div>
		
	</div>
	<header class="header fixed-top">
		<nav class="nav--menu d-flex justify-content-between align-items-center">
		
			<div class="logo--menu">
				<img src="img/log.png" alt="" class="img--menu">
			</div>
			
			<div class="menu">
			
				<ul class="menu--items d-flex list-unstyled gap-3">
					<li class="menu--item"><a href="#" class="menu--link text-decoration-none" type="button" data-bs-toggle="modal" data-bs-target="#modalreserva"><i class="fa-solid fa-business-time"></i> Reservar</a></li>
					<li class="menu--item"><a href="#" class="menu--link text-decoration-none" type="button" data-bs-toggle="modal" data-bs-target="#modallista"><i class="fa-solid fa-clock"></i> Mis Reservas</a></li>
					<li class="menu--item"><a href="close.php" class="menu--link text-decoration-none"><i class="fa-solid fa-arrow-right-to-bracket"></i> Cerrar Sesión</a></li>
				</ul>
				
			</div>
		</nav>
	</header>
	
	<main class="content-reserve">
		<h3 class="welcome">Bienvenid@, <?php echo $_SESSION['nombre']." ".$_SESSION['apellido']; ?></h3>
		<h2 class="subtitle">Registra Su Hora para evitar retrasos en sus actividades</h2>
		<img src="img/lab.png" alt="" class="lab--img">
	</main>
	
	
	
	
	
	<footer class="text-center fixed-bottom bg-dark text-white" style="padding: 20px;">
		<h4 style="font-size:20px;">&copy CopyRight - Colegio Graneros 2022</h4>
	</footer>
	
	
	<!-- Modal Reserva-->
	<div class="modal fade" id="modalreserva" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	  <div class="modal-dialog modal-lg modal-dialog-centered">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title" id="staticBackdropLabel">Reserva</h5>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		  </div>
		  <form action="" id="reservaForm">
			  <div class="modal-body">
				<div class="row">
					<div class="col-md-6 col-lg-6">
						<label for="">Cantidad de Alumnos:</label>
						<input type="number" min="0" oninput="desplegarsalas()" name="cantidad" id="cantidad" placeholder="Cantidad de Alumnos" class="form-control">
					</div>
					<div class="col-md-6 col-lg-6">
						<label for="">Sala:</label>
						<select name="sala" id="sala" class="form-control">
							<option value="0">Seleccione:</option>
						</select>
					</div>
					<div class="col-md-12">
					    <label for="">Curso:</label>
					    <select name="curso" id="curso" class="form-control">
					        <?php
								$lista = $c->listarcursos();
								for ($i=0; $i < count($lista); $i++) { 
									$cu = $lista[$i];
									echo "<option value='".$cu->getId()."' >".$cu->getNombre()."</option>";
								}
							?>
					    </select>
					</div>
				</div>
				<div class="row">
				<div class="col-md-6 col-lg-6">
					<label for="">Asignatura:</label>
					<input type="text" id="asignatura" name="asignatura" placeholder="Asignatura:" class="form-control">
				</div>
					<div class="col-md-6 col-lg-6">
						<label for="">Fecha:</label>
						<input type="text" onchange="desplegarbloques()" name="date" id="date" class="form-control">
					</div>
					<hr/>
					<div id="blocks" class="col-md-12 col-lg-12 d-flex justify-content-center flex-wrap gap-3">
						
						<input type="radio" class="btn-check" name="options" id="option1" autocomplete="off" checked>
						<label class="btn btn-success" for="option1">Bloque 1<br/>
						08:00</label>
						
						
						<input type="radio" class="btn-check" name="options" id="option1" autocomplete="off" checked>
						<label class="btn btn-success" for="option1">Bloque 1<br/>
						08:00</label>
						
						
						
					</div>
				</div>
			  </div>
			  <div class="modal-footer">
				<button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Restablecer</button>
				<button type="submit" class="btn btn-primary">Registrar</button>
			  </div>
		  </form>
		</div>
	  </div>
	</div>
	
	
	<!-- Modal Lista-->
		<div class="modal fade" id="modallista" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		  <div class="modal-dialog modal-lg modal-dialog-centered">
			<div class="modal-content">
			  <div class="modal-header">
				<h5 class="modal-title" id="staticBackdropLabel">Mis Reservas</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			  </div>
			  <div id="reserva__list" class="modal-body d-flex flex-wrap justify-content-center gap-3">
				
								<?php
								$lista = $c->listarreserva($_SESSION['id']);

								if (count($lista) > 0) {
								for ($i=0; $i < count($lista); $i++) { 
									$r = $lista[$i];
									echo '<div class="reserve">';
									echo '<div class="bloque">';
									echo '<h6 class="name">'.$r->getBloque().'</h6>';
									echo "<h6 class='name'>Fecha: ".$r->getFecha()."</h6>";
									echo '<h6 class="curso">Curso: '.$r->getCurso().'</h6>';
									if ($r->getSala()==1) {
										echo '<h6 class="sala">Laboratorio Computación</h6>';
									}else{
										echo '<h6 class="sala">Sala Computación</h6>';
									}
									echo '<h6 class="asignatura">Asignatura: '.$r->getAsignatura().'</h6>';
									echo '</div>';
									echo '</div>';
								}
								}else{
									echo '<h6 class="name">No hay reservas registradas</h6>';
								}
								?>

					

			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa-solid fa-close"></i></button>
			  </div>
			</div>
		  </div>
		</div>
	
	<!-----------------JavaScript---------------------->
	<script src="js/jquery-3.6.0.js"></script>
	<script src="js/jquery-ui.js"></script>
	<script src="js/MooTools-Core-1.6.0.js"></script>
	<script src="js/bootstrap.bundle.js"></script>
	<script type="text/javascript" src="js/anime.min.js"></script>
	<script src="js/favicons.js"></script>
	<script src="js/sweetalert2.all.min.js"></script>
	<script src="js/jquery-ui.min.js"></script>
	<script src="js/funciones.js"></script>
	<script src="js/query.js"></script>
</body>

</html>
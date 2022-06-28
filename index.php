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
	<link rel="stylesheet" href="css/estilo.css">
	<link rel="stylesheet" href="css/toastify.css">
	<link rel="icon" type="image/x-icon" href="img/log.png"/>
</head>

<body>
<div class="preloader">
	<div class="subpreloader"></div>
</div>

	<main class="content-login">
	<img src="img/log.png" alt="" class="img--login">
		<h1 class="login-title">Sistema de reserva</h1>
		<h1 class="login-title">Sala Computación</h1>
		<form action="" id="LoginForm" class="login--form">
		
			<div class="row justify-content-center gap-2">
				<div class="col-md-6 col-lg-12">
					<h2  class="login-subtitle">Login <i class="fa-solid fa-user-check"></i></h2>

				</div>
				<div class="col-md-6 col-lg-12">
					<label for="">Correo:</label>
					<input type="email" id="login__email" name="login__email" class="form-control" placeholder="Ingrese su Correo">
				</div>
				<div class="col-md-6 col-lg-12">
					<label for="">Contraseña:</label>
					<input type="password" id="login__password" name="login__password" placeholder="Ingrese su Contraseña" class="form-control">
				</div>
				<div class="col-md-12 col-lg-12 remember">
				    <a href="#" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#remember__modal" class="remember__link">¿Olvidaste tu contraseña? <i class="fa-solid fa-refresh"></i> </a><br/>
				    ¿Aún no estás registrado? <a href="#" type="button" class="register__link text-white" data-bs-toggle="modal" data-bs-target="#register__modal">Registrarse <i class="fa-solid fa-user-plus"></i></a>
				</div>
				<div class="col-md-12 col-lg-6 d-flex justify-content-center gap-4">
					<button type="reset" class="btn btn-lg btn-warning">Restablecer</button>
					<button type="submit" class="btn btn-lg btn-success">Entrar <i class="fa-solid fa-arrow-right-long"></i></button>
				</div>
			</div>
		</form>
	</main>
	
	
	
	
<!-- Modal -->
<div class="modal fade" id="remember__modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Restablecer Contraseña</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="" id="resetForm">
          
      <div class="modal-body">
        <div class="row">
            <div class="col">
                <label for="">Correo:</label>
                <input type="email" id="email__reset" name="email__reset" placeholder="Ingrese su Correo" class="form-control">
            </div>
            <div class="col-md-13">
            	<div style="display: none; margin: 0; padding: 0;" class="alert alert-success text-success" id="alertdiv">
            	
            	</div>
            	<button type="button" id="btncambiar" style="display: none" onclick="cambiar()" class="btn-warning btn"> <i class="fa-solid fa-refresh"></i> Cambiar Correo</button>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" id="btn__reset" class="btn btn-success">Restablecer</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="register__modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Registro de Usuario</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="registerForm" action="">
      <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <label for="">RUT:</label>
                <input type="text" id="ruttxt" name="ruttxt" placeholder="11.111.111-1" class="form-control">
            </div>
            <div class="col-md-6">
                <label for="">Nombre:</label>
                <input type="text" id="nomtxt" name="nomtxt" placeholder="Ingrese su Nombre" class="form-control">
            </div>
            <div class="col-md-6">
                <label for="">Apellido:</label>
                <input type="text" id="apetxt" name="apetxt" class="form-control" placeholder="Ingrese su Apellido">
            </div> 
            <div class="col-md-12">
                <label for="">Correo:</label>
                <input type="email" id="ematxt" name="ematxt" class="form-control" placeholder="mail@colegiograneros.cl">
            </div>
            <div class="col-md-12">
                <label for="">Contraseña</label>
                <input type="password" id="pastxt" name="pastxt" placeholder="Ingrese su Contraseña" class="form-control">
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="reset" class="btn btn-secondary">Restablecer</button>
        <button type="submit" class="btn btn-success">Registrar</button>
      </div>
      </form>
    </div>
  </div>
</div>	
	
	
	<!-----------------JavaScript---------------------->
	<script src="js/jquery-3.6.0.js"></script>
	<script src="js/MooTools-Core-1.6.0.js"></script>
	<script src="js/bootstrap.bundle.js"></script>
	<script type="text/javascript" src="js/anime.min.js"></script>
	<script src="js/favicons.js"></script>
	<script src="js/sweetalert2.all.min.js"></script>
	<script src="js/jquery.mask.min.js"></script>
	<script src="js/funciones.js"></script>
</body>

</html>
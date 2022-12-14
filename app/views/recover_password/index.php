<!DOCTYPE html>
<html lang="en">

<head>
	<title>Login</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous" />
	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet" />

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />

	<link rel="stylesheet" href="public/css/style.css" />
</head>

<body>
	<!-- modal modalSuccessful -->
	<div class="modal fade" id="contraseñaCambiada" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modalSuccessLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="d-flex justify-content-center">
						<img src="public/img/confim1.jpg" alt="confirmacio_img" />
					</div>
					<div class="d-flex justify-content-center">
						<h5>Contraseña cambiada con exito!</h5>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- modal modalSuccessful -->
	<div class="modal fade" id="modalSuccess" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modalSuccessLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="d-flex justify-content-center">
						<img src="public/img/confim1.jpg" alt="confirmacio_img" />
					</div>
					<div class="d-flex justify-content-center">
						<h5>Codigo enviado al correo!</h5>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- modal modalError -->
	<div class="modal fade" id="modalError" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modalErrorLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="d-flex justify-content-center">
						<img src="public/img/error1.jpg" alt="confirmacio_img" />
					</div>
					<div class="d-flex justify-content-center">
						<h5>Error al recuperar contraseña!</h5>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- recuperar contraseña -->
	<section class="ftco-section" id="seccion_recuperacion_envio">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-12 col-lg-10">
					<div class="wrap d-md-flex justify-content-center">
						<div class="login-wrap p-4 p-md-5">
							<div class="d-flex">
								<div class="w-100 d-flex justify-content-center">
									<h3 class="mb-4">Recuperar Contraseña</h3>
								</div>
							</div>
							<form action="#" class="signin-form">
								<div class="form-group mb-3">
									<label class="label" for="email">Email</label>
									<input type="email" class="form-control" placeholder="Email" id="email" required />
									<div id="emailInvalid" style="color: red; display: none">
										<p>Email invalido por favor escribalo nuevamente</p>
									</div>
									<div id="campoBlanco1" style="color: red; display: none">
										<p>Ambos campos no pueden estar en blanco</p>
									</div>
									<div id="emailNoExiste" style="color: red; display: none">
										<p>Email no existe!</p>
									</div>
								</div>
								<div class="form-group mb-3">
									<label class="label" for="username">Username</label>
									<input type="text" class="form-control" placeholder="Username" id="username" required />
									<div id="userInvalid" style="color: red; display: none">
										<p>
											Username incorrecto no debe tener caracteres
											especiales
										</p>
									</div>
									<div id="campoBlanco2" style="color: red; display: none">
										<p>Ambos campos no pueden estar en blanco</p>
									</div>
									<div id="usuarioNoExiste" style="color: red; display: none">
										<p>Usuario no existe!</p>
									</div>
								</div>
							</form>
							<div class="form-group">
								<button type="button" class="form-control btn btn-primary rounded submit px-3" id="btnEnviarRecuperar">
									Recuperar Contraseña
								</button>
							</div>
							<p class="text-center">
								<a href="../index.html">Volver al Login</a>
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- introduccion de codigo de recuperacion -->
	<section class="ftco-section" id="seccion_introducir_codigo" style="display: none">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-12 col-lg-10">
					<div class="wrap d-md-flex justify-content-center">
						<div class="login-wrap p-4 p-md-5">
							<div class="d-flex">
								<div class="w-100 d-flex justify-content-center">
									<h3 class="mb-4">Recuperar Contraseña</h3>
								</div>
							</div>
							<form action="#" class="signin-form">
								<div class="form-group mb-3">
									<label class="label" for="codigo_recuperacion">introduzca el codigo</label>
									<input type="number" class="form-control" placeholder="Codigo" id="codigo_recuperacion" required />
									<div id="codInvalid" style="color: red; display: none">
										<p>Codigo invalido debe tener 6 digitos</p>
									</div>
									<div id="campoBlancoCod" style="color: red; display: none">
										<p>Campo no pueden estar en blanco</p>
									</div>
									<div id="codigoNoExiste" style="color: red; display: none">
										<p>Codigo no existe!</p>
									</div>
									<div id="codigoUsado" style="color: red; display: none">
										<p>Codigo ya fue usado!</p>
									</div>
								</div>
							</form>
							<div class="form-group">
								<button type="button" class="form-control btn btn-primary rounded submit px-3" id="btnValidarCodigo">
									Validar codigo
								</button>
							</div>
							<p class="text-center">
								<a href="../index.html">Volver al Login</a>
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- recuperacion de pass -->
	<section class="ftco-section" id="seccion_recuperar" style="display: none">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-12 col-lg-10">
					<div class="wrap d-md-flex justify-content-center">
						<div class="login-wrap p-4 p-md-5">
							<div class="d-flex">
								<div class="w-100 d-flex justify-content-center">
									<h3 class="mb-4">Recuperar Contraseña</h3>
								</div>
							</div>
							<form action="#" class="signin-form">
								<div class="form-group mb-3">
									<label class="label" for="email">Nueva Password</label>
									<input type="password" class="form-control" placeholder="Password" id="passRecuperar" required />
									<div id="passRecuperarInvalid" style="color: red; display: none">
										<p>
											Password incorrecta tiene que tener un tamaño minimo
											de 6 caracteres
										</p>
									</div>
								</div>
								<div class="form-group mb-3">
									<label class="label" for="username">Validar Password</label>
									<input type="password" class="form-control" placeholder="Validar Password" id="validPassRecuperar" required />
									<div id="passValidRecuperarInvalid" style="color: red; display: none">
										<p>
											Password incorrecta tiene que tener un tamaño minimo
											de 6 caracteres
										</p>
									</div>
									<div id="coincidenciaInvalidRecuperarPass" style="color: red; display: none">
										<p>No coinciden los password</p>
									</div>
								</div>
							</form>
							<div class="form-group">
								<button type="button" class="form-control btn btn-primary rounded submit px-3" id="btnRecuperar">
									Restablecer Contraseña
								</button>
							</div>
							<p class="text-center">
								<a href="../index.html">Volver al Login</a>
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
	<script src="public/js/jquery.min.js"></script>
	<script src="public/js/popper.js"></script>
	<script src="public/js/bootstrap.min.js"></script>
	<script src="public/js/main.js"></script>
	<script src="public/js/script_show.js"></script>
	<script src="public/js/script_recuperar_contraseña.js"></script>
</body>

</html>
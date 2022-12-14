<!DOCTYPE html>
<html lang="en">

<head>
	<title>Login</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous" />
	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet" />

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />

	<link rel="stylesheet" href="../public/css/style.css" />
</head>

<body>
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
						<img src="../public/img/confim1.jpg" alt="confirmacio_img" />
					</div>
					<div class="d-flex justify-content-center">
						<h5>Usuario registrado con exito!</h5>
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
						<img src="../public/img/error1.jpg" alt="confirmacio_img" />
					</div>
					<div class="d-flex justify-content-center">
						<h5>Error al registrar usuario!</h5>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- seccion registro-->
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-12 col-lg-10">
					<div class="wrap d-md-flex justify-content-center">
						<div class="login-wrap p-4 p-md-5">
							<div class="d-flex">
								<div class="w-100 d-flex justify-content-center">
									<h3 class="mb-4">Registrate ahora</h3>
								</div>
							</div>
							<form action="#" class="signin-form">
								<div class="form-group mb-3">
									<label class="label" for="nombres">Nombres</label>
									<input type="text" class="form-control" placeholder="Nombre" id="nombres" required />
									<div id="nombreInvalid" style="color: red; display: none">
										<p>
											Nombres invalido no se admiten caracteres especiales
										</p>
									</div>
								</div>
								<div class="form-group mb-3">
									<label class="label" for="apellidos">Apellidos</label>
									<input type="text" class="form-control" placeholder="Apellidos" id="apellidos" required />
									<div id="apellidoInvalid" style="color: red; display: none">
										<p>
											Apellidos invalido no se admiten caracteres
											especiales
										</p>
									</div>
								</div>
								<div class="form-group mb-3">
									<label class="label" for="identificacion">Indentificacion</label>
									<input type="number" class="form-control" placeholder="Identificacion" id="identificacion" required maxlength="20" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" />
									<div id="indentificacionInvalid" style="color: red; display: none">
										<p>
											Identificador no puede quedar en blanco o tener mas
											de 20 digitos
										</p>
									</div>
								</div>
								<div class="form-group mb-3">
									<label class="label" for="tipoUsuario">Tipo de Usuario</label>
									<select class="form-control" aria-label="Default select example" id="tipoUsuario" style="color: #6c757d"></select>
									<div id="tipoInvalid" style="color: red; display: none">
										<p>Seleccion un tipo de usuario</p>
									</div>
								</div>
								<div class="form-group mb-3">
									<label class="label" for="programa">Programa o dependencia</label>
									<select class="form-control" aria-label="Default select example" id="tipoDependencia" style="color: #6c757d"></select>
									<div id="dependenciaInvalid" style="color: red; display: none">
										<p>Seleccion un tipo de usuario</p>
									</div>
								</div>

								<div class="form-group mb-3">
									<label class="label" for="email">Email</label>
									<input type="email" class="form-control" placeholder="Email" id="email" required />
									<div id="emailInvalid" style="color: red; display: none">
										<p>Email invalido por favor escribalo nuevamente</p>
									</div>
									<div id="emailRegistrado" style="color: red; display: none">
										<p>Email ya se encuentra registrado</p>
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
									<div id="userRegistrado" style="color: red; display: none">
										<p>Username ya se encuentra registrado</p>
									</div>
								</div>
								<div class="form-group mb-3">
									<label class="label" for="password">Password</label>
									<input type="password" class="form-control" placeholder="Password" id="password" required />
									<div id="passInvalid" style="color: red; display: none">
										<p>
											Password incorrecta tiene que tener un tama??o minimo
											de 6 caracteres
										</p>
									</div>
								</div>
								<div class="form-group mb-3">
									<label class="label" for="validPassword">Confirma Password</label>
									<input type="password" class="form-control" placeholder="Confirma Password" id="validPassword" required />
								</div>
								<div id="passValidInvalid" style="color: red; display: none">
									<p>
										Password incorrecta tiene que tener un tama??o minimo de
										6 caracteres
									</p>
								</div>
								<div id="coincidenciaInvalid" style="color: red; display: none">
									<p>No coinciden los password</p>
								</div>
							</form>
							<div class="form-group">
								<button type="button btn-register" class="form-control btn btn-primary rounded submit px-3" id="btnRegistrar">
									Registrate
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

	<script src="../public/js/jquery.min.js"></script>
	<script src="../public/js/popper.js"></script>
	<script src="../public/js/bootstrap.min.js"></script>
	<script src="../public/js/main.js"></script>
	<script src="../public/js/script_show.js"></script>
	<script src="../public/js/script_registro.js"></script>
</body>

</html>
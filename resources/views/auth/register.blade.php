<!doctype html>
<html lang="es">
<head>
<title>W2W Inventory</title>
<meta content="" name="description">
<meta content="" name="keywords">

	<!-- Favicons -->
	<link href="{{ asset('W2WInventory/assets/img/W2WInventoryIcon.png') }}" rel="icon">
	<link href="{{ asset('W2WInventory/assets/img/W2WInventoryIcon.png') }}" rel="apple-touch-icon">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">	
	<link rel="stylesheet" href="W2WLogin/css/style.css">

</head>
<body>
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center"></div>
				<div class="row justify-content-center">
					<div class="col-md-12 col-lg-10">
						<div class="wrap d-md-flex">
							<div class="img" id="log_img" style="background-image: url(W2WLogin/images/W2WInventoryIcon.png);">
						</div>
						<div class="login-wrap p-4 p-md-5">
							<div class="d-flex">
								<div class="w-100">
									<h3 class="mb-4">Registrarse</h3>
								</div>
								<div class="w-100">
									<p class="social-media d-flex justify-content-end">
										<a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-facebook"></span></a>
										<a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-twitter"></span></a>
									</p>
								</div>
							</div>
							<form method="POST" action="{{ route('register') }}" class="signin-form">
								@csrf
								<div class="form-group mb-3">
									<label class="label" for="name">Nombre</label>
									<div class="mb-3">
										<input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autocomplete="name" autofocus>
										@error('name')
											<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
										@enderror
									</div>
								</div>
								<div class="form-group mb-3">
									<label class="label" for="email">Correo electronico</label>
									<div class="mb-3">
										<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email">
										@error('email')
											<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
										@enderror
									</div>
								</div>
								<div class="form-group mb-3">
									<label class="label" for="password">Contraseña</label>
									<div class="mb-3">
										<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">
										@error('password')
											<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
										@enderror
									</div>
								</div>
								<div class="form-group mb-3">
									<label class="label" for="password">Confirmar contraseña</label>
									<div class="mb-3">
									<input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
										@error('password')
											<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
										@enderror
									</div>
								</div>
                                <input id="type_users_id" type="hidden" class="form-control" name="type_users_id" value="2">
								<div class="row mb-0">
									<div class="col-md-6 offset-md-4">
										<button type="submit" class="btn btn-primary">Registrarse</button>
									</div>
								</div>
                                <div class="text-center p-t-136" style="margin-top: 8%;">
									<a class="txt2" href="{{ url('/login') }}">
                                        <i class="fa fa-long-arrow-left" aria-hidden="true"></i>
										¿Ya tienes cuenta? Inicia sesión
									</a>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<script src="W2WLogin/js/jquery.min.js"></script>
	<script src="W2WLogin/js/popper.js"></script>
	<script src="W2WLogin/js/bootstrap.min.js"></script>
	<script src="W2WLogin/js/main.js"></script>
</body>
</html>

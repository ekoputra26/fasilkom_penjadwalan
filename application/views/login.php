
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
	<link rel="icon" href="<?= images_url('unsri.png')?>">
    <title>PENJADWALAN</title>
  
	<link rel="stylesheet" href="<?= backend_url('assets/vendor_components/bootstrap/dist/css/bootstrap.min.css')?>">
	<link rel="stylesheet" href="<?= backend_url('css/horizontal-menu.css')?>">
	<link rel="stylesheet" href="<?= backend_url('css/style.css')?>">
	<link rel="stylesheet" href="<?= backend_url('css/skin_color.css')?>">	

</head>
<body class="hold-transition theme-fruit bg-img" style="background-image: url('<?= backend_url('images/auth-bg/bg-2.jpg')?>');">
	
	<div class="h-p100">
		<div class="row align-items-center justify-content-md-center h-p100">
			<div class="col-lg-8 col-12">
				<div class="row justify-content-center no-gutters">
					<div class="col-xl-4 col-lg-7 col-md-6 col-12">
						<div class="content-top-agile p-10">
							<div class="logo">
								<a href="#" class="aut-logo my-40 d-block">
									<img src="<?= images_url('unsri.png')?>" height="75" alt="">
								</a>
							</div>
							<h2 class="text-white">Sign in your session</h2>						
						</div>
						<div class="p-30">
							<form action="<?= base_url('login')?>" method="post">
								<div class="form-group">
									<div class="input-group mb-3">
										<div class="input-group-prepend">
											<span class="input-group-text text-white bg-transparent"><i class="ti-user"></i></span>
										</div>
										<input type="text"  name="username" class="form-control pl-15 bg-transparent text-white plc-white" placeholder="Username">
									</div>
								</div>
								<div class="form-group">
									<div class="input-group mb-3">
										<div class="input-group-prepend">
											<span class="input-group-text text-white bg-transparent"><i class="ti-lock"></i></span>
										</div>
										<input type="password" name="password" class="form-control pl-15 bg-transparent text-white plc-white" placeholder="Password">
									</div>
								</div>
								  <div class="row">
									<div class="col-6">
									  <div class="checkbox text-white">
										<input type="checkbox" id="basic_checkbox_1" class="filled-in chk-col-danger" checked="">
										<label for="basic_checkbox_1">Remember Me</label>
									  </div>
									</div>
									<div class="col-6">
									 <div class="fog-pwd text-right">
									  </div>
									</div>
									<div class="col-12 text-center">
									  <button type="submit" name="login" value="login" class="btn btn-warning btn-outline mt-10">SIGN IN</button>
									</div>
								  </div>
							</form>														

					
							
							<div class="text-center text-white">
								<p class="mt-15 mb-0">&copy; 2021</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script src="<?= backend_url('assets/vendor_components/jquery-3.3.1/jquery-3.3.1.js')?>"></script>
	<script src="<?= backend_url('assets/vendor_components/screenfull/screenfull.js')?>"></script>
	<script src="<?= backend_url('assets/vendor_components/popper/dist/popper.min.js')?>"></script>
	<script src="<?= backend_url('assets/vendor_components/bootstrap/dist/js/bootstrap.min.js')?>"></script>

</body>
</html>

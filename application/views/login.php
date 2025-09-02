<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
	<div class="container py-3  d-flex align-items-center justify-content-center" style="height:100vh">

		<form action="<?= base_url('actionLogin') ?>" method="post" class="col-lg-6 col-sm-6 col-12">
			<div class="row  shadow-lg p-3 mb-5 bg-body rounded ">

				<h2 class="text-center">Sign In</h2>
				<?= !empty($msg) ? $msg : '' ?>

				<?php if ($this->session->flashdata('success')) { ?>
					<div class="alert alert-success text-center">
						<strong><?php echo $this->session->flashdata('success') ?></strong>
					</div>
				<?php } elseif ($this->session->flashdata('error')) { ?>
					<div class="alert alert-danger text-center">
						<strong><?php echo $this->session->flashdata('error') ?></strong>
					</div>
				<?php } ?>

				<div class="col-lg-12 col-sm-12 col-12">
					<label class="mb-2">Email<span class="text-danger">*</span></label>
					<input type="email" class="form-control" name="email" placeholder="Email" autocomplete="off">
					<span class="text-danger"><?= form_error('email'); ?></span>
				</div>

				<div class="col-lg-12 col-sm-12 col-12 mb-3">
					<label class="mb-2">Password<span class="text-danger">*</span></label>
					<input type="password" class="form-control" name="password" placeholder="Password"
						autocomplete="off">
					<span class="text-danger"><?= form_error('password'); ?></span>
				</div>

				<div class="col-lg-12 col-sm-12 col-12 mb-3">
					<button type="submit" class="btn btn-primary col-12">Login</button>
				</div>
				<!-- <div class="col-lg-12 col-sm-12 col-12 mb-3 text-center">
					<span>Are you new user?<span> <a href="<?= base_url('welcome/register') ?>" class="btnLogIn">Sign
								Up</a>

				</div> -->
			</div>
		</form>
	</div>


	<style>
		.btnLogIn {
			text-decoration: none;
			font-weight: 700;

		}
	</style>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

	<script>
		setTimeout(function() {
			$('.alert').fadeOut()
		}, 3000)
	</script>
</body>

</html>
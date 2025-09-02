<?php
if (empty($this->session->userdata('userId'))) {
	redirect('');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Dashboard</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>

	<nav class="navbar navbar-expand-sm navbar-dark bg-dark">
		<div class="container-fluid">

			<div class="collapse navbar-collapse" id="mynavbar">
				<ul class="navbar-nav me-auto">
					<li class="nav-item">
						<a class="nav-link" href="<?= base_url('dashboard') ?>">Dashboard</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="<?= base_url('event-list') ?>">Event</a>
					</li>

					<li class="nav-item">
						<a class="nav-link" href="<?= base_url('upcoming-event') ?>">Upcoming Event</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="<?= base_url('upcoming-event') ?>">Approver</a>
					</li>

				</ul>
				<form class="d-flex">
					<h6 style="color:white;margin-right:10px;"><?= ucwords($this->session->userdata('name')) ?></h6>
					<a class="btn btn-danger" href="<?= base_url('logout') ?>">LogOut</a>
				</form>
			</div>
		</div>
	</nav>

	<script>
		setTimeout(function() {
			$('.alert').alert('close')
		}, 5000)
	</script>
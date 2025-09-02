<?php $this->load->view('layout/header'); ?>
<div class="container mt-3">

	<div class="row">
		<h3>Welcome, <?= $this->session->userdata('name') ?></h3>
	</div>
</div>

</body>

</html>
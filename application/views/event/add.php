<?php $this->load->view('header'); ?>
<div class="container mt-3">

	<div class="row">

		<div class="container py-3  d-flex align-items-center justify-content-center ">
			<form action="<?= base_url('saveEvent') ?>" class=" col-lg-6 col-sm-6 col-12" method="POST"
				enctype="multipart/form-data" autocomplete="off">
				<div class="row  shadow-lg p-3 mb-5 bg-body rounded ">
					<h2 class="text-center">Event</h2>

					<div class="col-lg-12 col-sm-12 col-12">
						<label class="mb-2">Name<span class="text-danger">*</span></label>
						<input type="text" class="form-control mb-3" name="name" placeholder="Enter Name"
							autocomplete="off"
							value="<?= !empty($getData->name) ? $getData->name : set_value('name') ?>">
						<span class="text-danger"><?= form_error('name'); ?></span>
					</div>

					<div class="col-lg-12 col-sm-12 col-12 mb-3">
						<label class="mb-2">Start Date<span class="text-danger">*</span> </label>
						<input type="date" class="form-control" name="start_date" placeholder="Start Date"
							autocomplete="off"
							value="<?= !empty($getData->start_date) ? $getData->start_date : set_value('start_date') ?>">
						<span class="text-danger"><?= form_error('start_date'); ?></span>
					</div>

					<div class="col-lg-12 col-sm-12 col-12 mb-3">
						<label class="mb-2">End Date<span class="text-danger">*</span> </label>
						<input type="date" class="form-control" name="end_date" placeholder="End Date"
							autocomplete="off"
							value="<?= !empty($getData->end_date) ? $getData->end_date : set_value('end_date') ?>">
						<span class="text-danger"><?= form_error('end_date'); ?></span>
					</div>
					<div class="col-lg-12 col-sm-12 col-12 mb-3">
						<label class="mb-2">Description<span class="text-danger">*</span> </label>
						<textarea name="description" id=""
							class="form-control"><?= !empty($getData->description) ? $getData->description : set_value('description') ?></textarea>
						<span class="text-danger"><?= form_error('description'); ?></span>
					</div>
					<input type="hidden" name="id" value="<?= !empty($getData->id) ? $getData->id : '' ?>">

					<div class="col-lg-12 col-sm-12 col-12 w-50 mb-3 d-flex justify-content-start">
						<button type="submit" class="btn btn-primary col-12 me-3">Submit</button>
						<a href="<?= base_url('event') ?>" class="btn btn-secondary col-12">Cancel</a>
					</div>

				</div>
			</form>
		</div>


		<style>
			.btnLogIn {
				text-decoration: none;
				font-weight: 700;

			}
		</style>


	</div>
</div>
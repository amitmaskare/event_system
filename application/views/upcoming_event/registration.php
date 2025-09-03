<?php $this->load->view('layout/header'); ?>
<div class="container mt-3">

	<div class="row">

		<div class="container py-3  d-flex align-items-center justify-content-center ">
			<form action="<?= base_url('saveRegistration') ?>" class=" col-lg-6 col-sm-6 col-12" method="POST"
				id="dynamicForm" enctype="multipart/form-data" autocomplete="off">
				<div class="row  shadow-lg p-3 mb-5 bg-body rounded ">
					<h2 class="text-center">Event Registration</h2>

					<div class="col-lg-12 col-sm-12 col-12">
						<label class="mb-2">Event Name<span class="text-danger">*</span></label>
						<input type="text" class="form-control mb-3"
							value="<?= !empty(ucwords($getEvent->name)) ? $getEvent->name : '' ?>" autocomplete="off"
							readonly>
					</div>
					<?php
					if (!empty($registration)): foreach ($registration as $reg):
							$required = $reg->required == '1' ? '' : '';
							$option = explode(',', $reg->field_options);
							$field_name = "field_" . $reg->id;
					?>
							<div class="col-lg-12 col-sm-12 col-12">
								<label class="mb-2"><?= ucwords($reg->label) ?><span
										class="text-danger"><?= $reg->required == '1' ? '*' : ''; ?></span></label>
								<?php if ($reg->field_type == 'dropdown'): ?>
									<select name="<?= $field_name ?? '' ?>" class="form-control mb-3" id="<?= $field_name ?>"
										<?= $required ?>>
										<option value="">Select</option>
										<?php if (!empty($option)): foreach ($option as $key): ?>
												<option value="<?= $key ?>"><?= ucwords($key) ?></option>
										<?php endforeach;
										endif; ?>
									</select>
								<?php else: ?>
									<input type="<?= $reg->field_type ?? '' ?>" class="form-control mb-3" id="<?= $field_name ?>"
										name="<?= $field_name ?>" autocomplete="off" <?= $required ?>>
								<?php endif; ?>
							</div>
					<?php endforeach;
					endif; ?>

					<input type="hidden" name="event_id" value="<?= !empty($getEvent->id) ? $getEvent->id : '' ?>">

					<div class="col-lg-12 col-sm-12 col-12 w-50 mb-3 d-flex justify-content-start">
						<button type="submit" class="btn btn-primary col-12 me-3">Submit</button>
						<a href="<?= base_url('upcoming-event') ?>" class="btn btn-secondary col-12">Cancel</a>
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
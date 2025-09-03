<?php $this->load->view('layout/header'); ?>
<div class="container mt-3">

	<div class="row">

		<div class="container py-3  d-flex align-items-center justify-content-center ">
			<form action="<?= base_url('saveEvent') ?>" method="POST" enctype="multipart/form-data" autocomplete="off">
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

					<div class="col-md-12 mt-3">
						<h5>Define Quotas</h5>
						<div class="">
							<table class="table table-hover">
								<thead>
									<tr>
										<th>Role</th>
										<th>max participants</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody id="quotaTable">
									<?php if (!empty($quotalist)): foreach ($quotalist as $index => $quota): ?>
											<tr id="row<?= $index + 1 ?>">
												<td><select name="quota_role[]" class="form-control" required>
														<option value="">Select</option>
														<option value="employee"
															<?= $quota->role == 'employee' ? 'selected' : '' ?>>
															Employee</option>
														<option value="manager"
															<?= $quota->role == 'manager' ? 'selected' : '' ?>>
															Manager</option>
														<option value="director"
															<?= $quota->role == 'director' ? 'selected' : '' ?>>
															Director</option>
														<option value="external"
															<?= $quota->role == 'external' ? 'selected' : '' ?>>
															External</option>

													</select></td>
												<td><input type="text" class="form-control" name="max_participants[]" required
														value="<?= $quota->max_participants ?? '' ?>">
												</td>
												<td>
													<a href="javascript:void(0)" onclick="appendCurrentCell(1);"
														class="btn btn-sm btn-info mr-2" title="Add Row">Add</a>
													<a href="javascript:void(0)" class="btn btn-sm btn-danger"
														onclick="deleteCurrentCell(1);" title="Delete Row"> Remove</a>
												</td>
											</tr>
										<?php endforeach;
									else: ?>
										<tr id="row1">
											<td><select name="quota_role[]" class="form-control" required>
													<option value="">Select</option>
													<option value="employee">Employee</option>
													<option value="manager">Manager</option>
													<option value="director">Director</option>
													<option value="external">External</option>

												</select></td>
											<td><input type="text" class="form-control" name="max_participants[]" required>
											</td>
											<td>
												<a href="javascript:void(0)" onclick="appendCurrentCell(1);"
													class="btn btn-sm btn-info mr-2" title="Add Row">Add</a>
												<a href="javascript:void(0)" class="btn btn-sm btn-danger"
													onclick="deleteCurrentCell(1);" title="Delete Row"> Remove</a>
											</td>
										</tr>
									<?php endif; ?>

								</tbody>

							</table>
						</div>
					</div>
					<div class="col-md-12 mt-3">
						<h5>Form Nodes</h5>
						<div class="">
							<table class="table table-hover">
								<thead>
									<tr>
										<th>Label</th>
										<th>Field Name</th>
										<th>Field Type</th>
										<th>Field Option</th>
										<th>Required</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody id="formTable">
									<?php if (!empty($formlist)): foreach ($formlist as $index => $row): ?>
											<tr id="formrow<?= $index + 1 ?>">
												<td><input type="text" class="form-control" name="label[]" required
														value="<?= $row->label ?? '' ?>"></td>
												<td><input type="text" class="form-control" name="field_name[]" required
														value="<?= $row->field_name ?? '' ?>"></td>
												<td>
													<select name="field_type[]" class="form-control" required onchange="showOption(this.value,<?= $index + 1 ?>)">
														<option value="">Select</option>
														<option value="text"
															<?= $row->field_type == 'text' ? 'selected' : '' ?>>Text
														</option>
														<option value="email"
															<?= $row->field_type == 'email' ? 'selected' : '' ?>>
															Email</option>
														<option value="number"
															<?= $row->field_type == 'number' ? 'selected' : '' ?>>
															Number</option>
														<option value="dropdown"
															<?= $row->field_type == 'dropdown' ? 'selected' : '' ?>>Dropdown
														</option>
													</select>
												</td>
												<td id="optionField<?= $index + 1 ?>">
													<?php if ($row->field_type == 'dropdown'): ?>
														<input type="text" class="form-control"
															name="field_options[<?= $index + 1 ?>]" value="<?= $row->field_options ?? '' ?>" required>
													<?php endif; ?>
												</td>
												<td>
													<select name="required[]" class="form-control">
														<option value="1" <?= $row->required == '1' ? 'selected' : '' ?>>Yes
														</option>
														<option value="0" <?= $row->required == '0' ? 'selected' : '' ?>>No
														</option>
													</select>
												</td>

												<td>
													<a href="javascript:void(0)" onclick="appendForm(1);"
														class="btn btn-sm btn-info mr-2" title="Add Row">Add</a>
													<a href="javascript:void(0)" class="btn btn-sm btn-danger"
														onclick="deleteForm(1);" title="Delete Row"> Remove</a>
												</td>
											</tr>
										<?php endforeach;
									else: ?>
										<tr id="formrow1">
											<td><input type="text" class="form-control" name="label[]" required></td>
											<td><input type="text" class="form-control" name="field_name[]" required></td>
											<td>
												<select name="field_type[]" class="form-control" required
													onchange="showOption(this.value,1)">
													<option value="">Select</option>
													<option value="text">Text</option>
													<option value="email">Email</option>
													<option value="number">Number</option>
													<option value="dropdown">Dropdown</option>
												</select>
											</td>
											<td id="optionField1">
											</td>
											<td>
												<select name="required[]" class="form-control">
													<option value="1">Yes</option>
													<option value="0">No</option>
												</select>
											</td>

											<td>
												<a href="javascript:void(0)" onclick="appendForm(1);"
													class="btn btn-sm btn-info mr-2" title="Add Row">Add</a>
												<a href="javascript:void(0)" class="btn btn-sm btn-danger"
													onclick="deleteForm(1);" title="Delete Row"> Remove</a>
											</td>
										</tr>
									<?php endif; ?>

								</tbody>

							</table>
						</div>
					</div>
					<div class="col-md-12 mt-3">
						<h5>Approval Bands</h5>
						<div class="">
							<table class="table table-hover">
								<thead>
									<tr>
										<th>Band Order</th>
										<th>Role</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody id="bandTable">
									<?php if (!empty($bandlist)): foreach ($bandlist as $index => $val): ?>
											<tr id="bandrow<?= $index + 1 ?>">

												<td><input type="text" class="form-control" name="band_order[]" required
														value="<?= $val->band_order ?? '' ?>">
												</td>
												<td><select name="band_role[]" class="form-control" required>
														<option value="">Select</option>
														<option value="manager"
															<?= $val->role == 'manager' ? 'selected' : '' ?>>
															Manager</option>
														<option value="director"
															<?= $val->role == 'director' ? 'selected' : '' ?>>
															Director</option>

													</select></td>
												<td>
													<a href="javascript:void(0)" onclick="appendBand(1);"
														class="btn btn-sm btn-info mr-2" title="Add Row">Add</a>
													<a href="javascript:void(0)" class="btn btn-sm btn-danger"
														onclick="deleteBand(1);" title="Delete Row"> Remove</a>
												</td>
											</tr>
										<?php endforeach;
									else: ?>
										<tr id="bandrow1">

											<td><input type="text" class="form-control" name="band_order[]" required>
											</td>
											<td><select name="band_role[]" class="form-control" required>
													<option value="">Select</option>
													<option value="manager">Manager</option>
													<option value="director">Director</option>

												</select></td>
											<td>
												<a href="javascript:void(0)" onclick="appendBand(1);"
													class="btn btn-sm btn-info mr-2" title="Add Row">Add</a>
												<a href="javascript:void(0)" class="btn btn-sm btn-danger"
													onclick="deleteBand(1);" title="Delete Row"> Remove</a>
											</td>
										</tr>
									<?php endif; ?>

								</tbody>

							</table>
						</div>
					</div>


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

<script src="<?= base_url('assets/event.js') ?>"></script>
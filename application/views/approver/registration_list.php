<?php $this->load->view('layout/header'); ?>
<div class="container mt-3">

	<div class="row">
		<h3> Registration Events</h3>
		<?php if ($this->session->flashdata('success')): ?>
			<div class="alert alert-success text-center">
				<strong><?php echo $this->session->flashdata('success') ?></strong>
			</div>
		<?php elseif ($this->session->flashdata('error')): ?>
			<div class="alert alert-danger text-center">
				<strong><?php echo $this->session->flashdata('error') ?></strong>
			</div>
		<?php endif; ?>

		<table class="table table-striped">
			<thead>
				<tr>
					<th>#</th>
					<th>Event Name</th>
					<th>Registration Name</th>
					<th>Band Order</th>
					<th>Registered Date</th>
					<th>Status</th>
				</tr>
			</thead>
			<tbody>
				<?php if (!empty($approver)): foreach ($approver as  $index => $item):
						$status = $item->status == 'pending' ? 'btn-warning' : ($item->status == 'approved' ? 'btn-success' : ($item->status == 'rejected' ? 'btn-danger' : ''));

				?>
						<tr>
							<td><?= $index + 1; ?></td>
							<td><?= ucwords($item->event_name) ?></td>
							<td><?= ucwords($item->user_name) ?></td>
							<td><?= $item->band_order ?></td>
							<td><?= date('d M Y H:i a', strtotime($item->registered_at)) ?></td>
							<td>
								<a href="javascript:void(0)" onclick="changeStatus(<?= $item->id ?>,<?= $item->band_id ?>)"
									class="btn btn-sm <?= $status ?? '' ?>"><?= ucfirst($item->status) ?></a>

							</td>
						</tr>
					<?php endforeach;
				else: ?>
					<tr>
						<td colspan="6" class="text-center">
							No Data Found
						</td>

					</tr>
				<?php endif; ?>

			</tbody>
		</table>

	</div>
</div>

<!-- The Modal -->
<div class="modal" id="myModal">
	<div class="modal-dialog">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title">Change Status</h4>
				<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
			</div>

			<!-- Modal body -->
			<form action="<?= base_url('approval') ?>" method="post">
				<div class="modal-body">

					<label for="">Decision<span class="text-danger">*</span></label>
					<select name="decision" id="" class="form-control" required>
						<option value="">Select</option>
						<option value="approved">Approved</option>
						<option value="rejected">Rejected</option>
					</select>
					<label for="">Remark</label>
					<textarea name="remarks" class="form-control" rows="3"></textarea>

					<input type="hidden" name="registration_id" id="registration_id">
					<input type="hidden" name="band_id" id="band_id">
				</div>

				<!-- Modal footer -->
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Submit</button>
					<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
				</div>
			</form>

		</div>
	</div>
</div>

<script>
	function changeStatus(reg_id, band_id) {
		$('#myModal').show();
		$('#registration_id').val(reg_id);
		$('#band_id').val(band_id);
	}
</script>
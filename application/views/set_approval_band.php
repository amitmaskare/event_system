<?php $this->load->view('layout/header'); ?>
<div class="container mt-3">

	<div class="row">
		<h3> Set Approval Band</h3>
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
					<th>Approved By</th>
					<th>Band Order</th>
					<th>Status</th>
					<th>Remark</th>
					<th>Approved Date</th>
				</tr>
			</thead>
			<tbody>
				<?php if (!empty($set_approval_band)): foreach ($set_approval_band as  $index => $item):
						$status = $item->decision == 'approved' ? 'btn-success' : ($item->decision == 'rejected' ? 'btn-danger' : '');

				?>
						<tr>
							<td><?= $index + 1; ?></td>
							<td><?= ucwords($item->event_name) ?></td>
							<td><?= ucwords($item->register_name) ?></td>
							<td><?= ucwords($item->approved_by) ?></td>
							<td><?= $item->band_order ?></td>
							<td>
								<a href="javascript:void(0)" class="btn btn-sm <?= $status ?? '' ?>"><?= ucfirst($item->decision) ?></a>

							</td>
							<td><?= $item->remarks ?></td>
							<td><?= date('d M Y H:i A', strtotime($item->approved_at)) ?></td>
						</tr>
					<?php endforeach;
				else: ?>
					<tr>
						<td colspan="8" class="text-center">No Data Found</td>

					</tr>
				<?php endif; ?>

			</tbody>
		</table>

	</div>
</div>
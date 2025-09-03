<?php $this->load->view('layout/header'); ?>
<div class="container mt-3">

	<div class="row">
		<h3> Upcoming Events</h3>
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
					<th>Description</th>
					<th>Last Date</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php if (!empty($upcomingEvent)): foreach ($upcomingEvent as  $index => $item):
						$checkStatus = $this->Commonmodel->getSingle('registrations', "event_id='" . $item->id . "' and user_id='" . $this->session->userdata('userId') . "'");
						$status = $checkStatus->status == 'pending' ? 'btn-warning' : ($checkStatus->status == 'approved' ? 'btn-success' : ($checkStatus->status == 'rejected' ? 'btn-danger' : ''));
				?>
						<tr>
							<td><?= $index + 1; ?></td>
							<td><?= ucwords($item->name) ?></td>
							<td><?= ucfirst($item->description) ?></td>
							<td><?= date('d M Y', strtotime($item->end_date)) ?></td>
							<td>
								<?php if (!empty($checkStatus)): ?>
									<a href="javascript:void(0)"
										class="btn btn-sm <?= $status ?? '' ?>"><?= ucfirst($checkStatus->status) ?></a>
								<?php else: ?>
									<a href="<?= base_url('event/registration/' . $item->id) ?>"
										class="btn btn-sm btn-warning">Event
										Registration</a>
								<?php endif; ?>
							</td>
						</tr>
					<?php endforeach;
				else: ?>
					<tr>
						<td colspan="5" class="text-center">No Data Found</td>

					</tr>
				<?php endif; ?>

			</tbody>
		</table>

	</div>
</div>
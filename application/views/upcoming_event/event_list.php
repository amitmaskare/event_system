<?php $this->load->view('header'); ?>
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
				<?php if (!empty($upcomingEvent)): foreach ($upcomingEvent as  $index => $item): ?>
						<tr>
							<td><?= $index + 1; ?></td>
							<td><?= ucwords($item->name) ?></td>
							<td><?= ucfirst($item->description) ?></td>
							<td><?= date('d M Y', strtotime($item->end_date)) ?></td>
							<td>
								<a href="<?= base_url('event/registration/' . $item->id) ?>"
									class="btn btn-sm btn-warning">Event
									Registration</a>

							</td>
						</tr>
					<?php endforeach;
				else: ?>
					<tr>
						<td ncolspan="4" class="text-center">No Data Found</td>

					</tr>
				<?php endif; ?>

			</tbody>
		</table>

	</div>
</div>
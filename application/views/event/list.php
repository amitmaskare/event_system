<?php $this->load->view('layout/header'); ?>
<div class="container mt-3">

	<div class="row">
		<h3>Events</h3>
		<?php if ($this->session->flashdata('success')): ?>
			<div class="alert alert-success text-center">
				<strong><?php echo $this->session->flashdata('success') ?></strong>
			</div>
		<?php elseif ($this->session->flashdata('error')): ?>
			<div class="alert alert-danger text-center">
				<strong><?php echo $this->session->flashdata('error') ?></strong>
			</div>
		<?php endif; ?>
		<a href="<?= base_url('event/add') ?>" class="btn btn-sm btn-primary w-25 btn-float">Add</a>
		<table class="table table-striped">
			<thead>
				<tr>
					<th>#</th>
					<th>Event Name</th>
					<th>Start Date</th>
					<th>End Date</th>
					<th>Description</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php if (!empty($eventList)): foreach ($eventList as  $index => $item): ?>
						<tr>
							<td><?= $index + 1; ?></td>
							<td><?= ucwords($item->name) ?></td>
							<td><?= date('d M Y', strtotime($item->start_date)) ?></td>
							<td><?= date('d M Y', strtotime($item->start_date)) ?></td>
							<td><?= ucfirst($item->description) ?></td>
							<td>
								<a href="<?= base_url('event/edit/' . $item->id) ?>" class="btn btn-sm btn-warning">Edit</a>
								<a href="<?= base_url('event/delete/' . $item->id) ?>" class="btn btn-sm btn-danger"
									onclick="return confirm('Are you sure you want to delete event?');">Delete</a>
							</td>
						</tr>
					<?php endforeach;
				else: ?>
					<tr>
						<td ncolspan="6" class="text-center">No Data Found</td>

					</tr>
				<?php endif; ?>

			</tbody>
		</table>

	</div>
</div>
<div class="pagetitle">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h1><?= $title ?></h1>
    <a href="<?= base_url($base.'/add'); ?>" class="btn btn-primary ml-auto">Add Data</a>
  </div>
  <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card p-3">
            <div class="card-body">
              <table class="table datatable">
                <thead>
                  <tr>
					<th>ID</th>
				  	<?php foreach ($columns as $key => $column): ?>
                    <th <?= isset($column['attr']) ? $column['attr'] : ''; ?>><?= $column['title']; ?></th>
					<?php endforeach; ?>
					<th data-sortable="false">Action</th>
                  </tr>
                </thead>
                <tbody>
					<?php foreach ($data as $key => $item): ?>
					<tr>
						<td><?= $key+1; ?></td>
						<?php foreach ($columns as $column): ?>
						<td><?= $item[$column['key']]; ?></td>
						<?php endforeach; ?>
						<td>
							<a href="<?= base_url($base.'/detail/'.$item['id']); ?>" class="btn btn-info text-white"><i class="bi bi-eye"></i></a>
							<a href="<?= base_url($base.'/edit/'.$item['id']); ?>" class="btn btn-warning text-white"><i class="bi bi-pencil-square"></i></a>
							<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" onclick="$('#form-delete input').attr('value','<?= $item['id']; ?>')">
							<i class="bi bi-trash"></i>
							</button>
						</td>
                  	</tr>
					  <?php endforeach; ?>
				</tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
</div>
<div class="modal fade" id="deleteModal" tabindex="-1">
	<div class="modal-dialog modal-sm modal-dialog-centered">
		<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title">Delete Data</h5>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		</div>
		<div class="modal-body">
			Are you sure to delete this data?
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
			<form id="form-delete" action="<?= base_url($base.'/delete'); ?>" method="POST">
				<input type="hidden" name="id" value="">
				<button type="submit" class="btn btn-danger">Delete</button>
			</form>
		</div>
		</div>
	</div>
</div>

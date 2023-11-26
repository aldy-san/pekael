<div class="pagetitle">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h1><?= $title ?></h1>
	<?php if (!isset($access) || in_array('ADD', $access)):?>
    <a href="<?= base_url($base.'/add'); ?>" class="btn btn-primary ml-auto">Tambah Data</a>
	<?php endif; ?>
  </div>
  <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card p-3">
            <div class="card-body overflow-auto">
              <table class="table datatable">
                <thead>
                  <tr>
					<th>NO</th>
				  	<?php foreach ($columns as $key => $column): ?>
                    <th class="text-nowrap" <?= isset($column['attr']) ? $column['attr'] : ''; ?>><span class="text-nowrap"><?= $column['title']; ?></span></th>
					<?php endforeach; ?>
					<th data-sortable="false" data-cellClass>Aksi</th>
                  </tr>
                </thead>
                <tbody>
					<?php foreach ($data as $key => $item): ?>
					<tr>
						<td><?= $key+1; ?></td>
						<?php foreach ($columns as $column): ?>
						<td>
							<?php if($column['type'] === 'modal' || $item[$column['key']]): ?>
								<?php if($column['type'] === 'string'): ?>
									<?= $item[$column['key']]; ?>
								<?php elseif ($column['type'] === 'file'): ?>
									<?php if($item[$column['key']]): ?>
										<a href="<?= base_url('/files/'.$item[$column['key']]); ?>" target="_blank" class="btn btn-info text-white">Lihat File</a>
									<?php else: ?>
										<b>-</b>
									<?php endif; ?>
								<?php elseif ($column['type'] === 'status'): ?>
									<strong class="text-uppercase text-success"><?= $item[$column['key']]; ?></strong>
								<?php elseif ($column['type'] === 'modal'): ?>
									<?php if ( str_contains($column['condition'], $item['status'])):?>
										<button type="button" class="ms-1 me-1 btn btn-warning text-white" data-bs-toggle="modal" data-bs-target="<?= $column['key']; ?>" onclick="<?= 'modalHandler(\''.$column['key'].'\','.$item['id'].')'; ?>" >
											Lihat Data
										</button>
									<?php else: ?>
										<small class="text-danger text-nowrap"><?= isset($column['default']) ? $column['default'] : ''; ?></small>
									<?php endif; ?>
								<?php endif; ?>
							<?php else: ?>
								<small class="text-danger text-nowrap"><?= isset($column['default']) ? $column['default'] : ''; ?></small>
							<?php endif; ?>
						</td>
						<?php endforeach; ?>
						<td>
							<div class="d-flex g-3">
								<?php if (!isset($access) || in_array('DETAIL', $access)):?>
									<a href="<?= base_url($base.'/detail/'.$item['id']); ?>" class="ms-1 me-1 btn btn-info text-white"><i class="bi bi-eye"></i></a>
								<?php endif; ?>
								<?php if (!isset($access) || in_array('EDIT', $access)):?>
								<a href="<?= base_url($base.'/edit/'.$item['id']); ?>" class="ms-1 me-1 btn btn-warning text-white"><i class="bi bi-pencil-square"></i></a>
								<?php endif; ?>
								<?php if (!isset($access) || in_array('DELETE', $access)):?>
								<button type="button" class="ms-1 me-1 btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" onclick="$('#form-delete input').attr('value','<?= $item['id']; ?>')">
								<i class="bi bi-trash"></i>
								</button>
								<?php endif; ?>
							</div>
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
			<h5 class="modal-title">Hapus Data</h5>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		</div>
		<div class="modal-body">
			Apakah anda yakin ingin menghapus data?
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
			<form id="form-delete" action="<?= base_url($base.'/delete'); ?>" method="POST">
				<input type="hidden" name="id" value="">
				<button type="submit" class="btn btn-danger">Hapus</button>
			</form>
		</div>
		</div>
	</div>
</div>
<script>
function modalHandler(target, id) {
	const data = <?= json_encode($data); ?>;
	const selected = data.find(item => item.id);
	const inputs = document.querySelectorAll(target + ' input');
	inputs.forEach(item => {
		item.value = selected[item.name]
	});
	const files = document.querySelectorAll(target + ' a');
	files.forEach(item => {
		item.href = '<?= base_url('/files/'); ?>' + selected[item.getAttribute('data-name')]
	});
}
</script>
<?php
$this->load->view('modal/seminar');
$this->load->view('modal/nilai');
?>

<div class="page-heading px-5">
	<?php if(isset($warning)):?>
		<div class="alert alert-warning"><?= $warning; ?></div>
	<?php else:?>
	<div class="d-flex justify-content-between align-items-center mb-4">
		<h1><?= $title ?></h1>
		<?php if (!isset($access) || in_array('ADD', $access)):?>
		<a href="<?= base_url($base.'/add'); ?>" class="btn btn-primary ml-auto">Tambah Data</a>
		<?php endif; ?>
	</div>
	<section class="section">
		<div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="table1">
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
												<a href="<?= base_url('/files/'.$item[$column['key']]); ?>" target="_blank" class="btn btn-primary text-white">Lihat File</a>
											<?php else: ?>
												<b>-</b>
											<?php endif; ?>
										<?php elseif ($column['type'] === 'status'): ?>
											<?php if($item[$column['key']] === 'diajukan'): ?>
											<strong class="text-uppercase badge bg-secondary"><?= $item[$column['key']]; ?></strong>
											<?php elseif($item[$column['key']] === 'ditolak'): ?>
											<strong class="text-uppercase badge bg-danger"><?= $item[$column['key']]; ?></strong>
											<?php elseif($item[$column['key']] === 'diterima'): ?>
											<strong class="text-uppercase badge bg-success"><?= $item[$column['key']]; ?></strong>
											<?php endif; ?>
										<?php elseif ($column['type'] === 'modal'): ?>
											<button type="button" class="ms-1 me-1 btn btn-primary text-white" data-bs-toggle="modal" data-bs-target="<?= $column['key']; ?>" onclick="<?= 'modalHandler(\''.$column['key'].'\','.$item['id'].')'; ?>" >
													Lihat Data
												</button>
										<?php endif; ?>
									<?php else: ?>
										<small class="text-danger text-nowrap"><?= isset($column['default']) ? $column['default'] : ''; ?></small>
									<?php endif; ?>
								</td>
								<?php endforeach; ?>
								<td>
									<div class="d-flex g-3">
										<?php if (!isset($access) || in_array('DETAIL', $access)):?>
											<a href="<?= base_url($base.'/detail/'.$item['id']); ?>" class="ms-1 me-1 btn btn-info text-white"><i class="bi bi-card-checklist"></i></a>
										<?php endif; ?>
										<?php if (!isset($access) || in_array('EDIT', $access)):?>
										<a href="<?= base_url($base.'/edit/'.$item['id']); ?>" class="ms-1 me-1 btn btn-warning text-white <?= $item['status'] !== 'diajukan' ? 'disabled' : ''; ?>"><i class="bi bi-pencil-fill"></i></a>
										<?php endif; ?>
										<?php if (!isset($access) || in_array('DELETE', $access)):?>
										<button type="button" class="ms-1 me-1 btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" onclick="$('#form-delete input').attr('value','<?= $item['id']; ?>')">
										<i class="bi bi-trash2-fill"></i>
										</button>
										<?php endif; ?>
										<?php if($user['role'] === 'admin' && $item['status'] === 'diajukan'): ?>
										<button type="button" class="ms-1 me-1 btn btn-success d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#approveModal" onclick="$('#form-approve input').attr('value','<?= $item['id']; ?>')">
										<i class="bi bi-check-square me-2 mb-2"></i> <span>Diterima</span>
										</button>
										<button type="button" class="ms-1 me-1 btn btn-danger d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#rejectModal" onclick="$('#form-reject input').attr('value','<?= $item['id']; ?>')">
										<i class="bi bi-slash-circle me-2 mb-2"></i> <span>Ditolak</span>
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
    </section>
	<?php endif; ?>
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
<div class="modal fade" id="approveModal" tabindex="-1">
	<div class="modal-dialog modal-sm modal-dialog-centered">
		<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title">Terima Judul</h5>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		</div>
		<?= form_open_multipart(base_url($base.'/approve'), array('onkeydown' => "return event.key != 'Enter';", 'data-parsley-validate' => '', 'id' => "form-approve")) ?>
			<div class="modal-body">
				<p class="text-center">Apakah anda yakin ingin menyetejui judul ini?</p>
				<div class="form-group">
					<input class="form-control" type="file" id="surat_tugas" name="surat_tugas" accept="application/pdf" data-parsley-required="true">
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
					<input type="hidden" name="id" value="">
					<button type="submit" class="btn btn-success">Terima</button>
				</div>
			</div>
		<?= form_close(); ?>
	</div>
</div>
<div class="modal fade" id="rejectModal" tabindex="-1">
	<div class="modal-dialog modal-sm modal-dialog-centered">
		<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title">Terima Judul</h5>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		</div>
		<form id="form-reject" action="<?= base_url($base.'/reject'); ?>" method="POST">
			<div class="modal-body">
				<p class="text-center">Apakah anda yakin ingin menolak judul ini?</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
					<input type="hidden" name="id" value="">
					<button type="submit" class="btn btn-danger">Tolak</button>
				</div>
			</div>
		</form>
	</div>
</div>
<script>
function modalHandler(target, id) {
	const data = <?= json_encode($data); ?>;
	const selected = data.find(item => Number(item.id) === id);
	const inputs = document.querySelectorAll(target + ' input');
	console.log(inputs)
	console.log(selected)
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
$this->load->view('modal/berkas');
?>

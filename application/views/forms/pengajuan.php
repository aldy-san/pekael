<div class="page-heading px-5">
    <div class="page-title mb-3">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3><?= $title; ?></h3>
            </div>
        </div>
    </div>
	<?= form_open_multipart(isset($data) ? base_url($base.'/edit/'.$data['id']) : base_url($base.'/add'), array('onkeydown' => "return event.key != 'Enter';", ' data-parsley-validate' => '', 'class' => 'row g-3')) ?>
    <section class="section card p-3">
        <div class="row">
			<div class="col-12">
				<label for="judul" class="form-label">Judul</label>
				<div class="form-group">
					<input type="text" name="judul" class="form-control" id="judul"  <?= $isEdit ? '': 'disabled'; ?> value="<?= isset($data) ? $data['judul'] : ''; ?>" data-parsley-required="true">
				</div>
			</div>
			<div class="col-12">
				<label for="permasalahan" class="form-label">Permasalahan</label>
				<div class="form-group">
					<textarea class="form-control" name="permasalahan" id="permasalahan" <?= $isEdit ? '': 'disabled'; ?> rows="5" data-parsley-required="true"><?= isset($data) ? $data['permasalahan'] : ''; ?></textarea>
				</div>
			</div>
			<div class="col-6">
				<label for="tanggal" class="form-label">Tanggal Pengajuan</label>
				<div class="form-group">
					<input type="date" name="tanggal" class="form-control" id="tanggal" <?= $isEdit ? '': 'disabled'; ?> value="<?= $data['tanggal']; ?>" data-parsley-required="true">
				</div>
			</div>
			<div class="col-6">
				<label for="proposal" class="col-sm-6 col-form-label">File Pra-Proposal</label>
				<div class="col-sm-12">
					<?php if($isEdit) :?>
					<div class="form-group">
						<input class="form-control" type="file" id="proposal" name="proposal" accept="application/pdf" <?= isset($data) && $data['proposal'] ? '' : 'data-parsley-required="true"'; ?>>
					</div>
					<?php endif; ?>
					<?php if(isset($data) && $data['proposal']) :?>
					<a href="<?= base_url('/files/'.$data['proposal']); ?>" target="_blank" class="btn btn-info text-white mt-2">Lihat File</a>
					<?php else: ?>
					<small class="text-danger mt-2 d-flex">(Belum ada data)</small>
					<?php endif; ?>
				</div>
			</div>
			<div class="col-12 mt-4">
				<?php if($isEdit): ?>
				<button type="submit" class="btn btn-primary">Simpan Data</button>
				<?php endif; ?>
			</div>
        </div>
    </section>
	<?= form_close(); ?>
</div>

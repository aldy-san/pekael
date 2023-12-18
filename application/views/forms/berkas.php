<div class="page-heading px-5">
    <div class="page-title mb-3">
        <div class="row">
			<?php if(is_null($data)):?>
			<div class="alert alert-warning">Anda belum memasukkan berkas persyaratan.</div>
			<?php endif; ?>
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Berkas Persyaratan</h3>
                <h6>Masukkan berkas persyaratan</h6>
            </div>
        </div>
    </div>
	<?= form_open_multipart(base_url($base.'/edit/'), array('onkeydown' => "return event.key != 'Enter';", ' data-parsley-validate' => '', 'class' => 'row g-3')) ?>
    <section class="section card p-3">
        <div class="row">
			<input type="hidden" name="trigger">
			<?php foreach ($list_file as $key => $value) :?>
			<div class="col-md-4">
				<label for="<?= $value['key']; ?>-formFile" class="col-sm-6 col-form-label"><?= $value['title']; ?></label>
				<div class="col-sm-12">
					<?php if($isEdit) :?>
					<div class="form-group">
						<input class="form-control" type="file" id="<?= $value['key']; ?>-formFile" name="<?= $value['key']; ?>" accept="application/pdf" <?= isset($data) && $data[$value['key']] ? '' : 'data-parsley-required="true"'; ?>>
					</div>
					<?php endif; ?>
					<?php if(isset($data) && $data[$value['key']]) :?>
					<a href="<?= base_url('/files/'.$data[$value['key']]); ?>" target="_blank" class="btn btn-info text-white mt-2">Lihat File</a>
					<?php else: ?>
					<small class="text-danger mt-2 d-flex">(Belum ada data)</small>
					<?php endif; ?>
				</div>
			</div>
			<?php endforeach?>
			<div class="col-12 mt-4">
				<?php if($isEdit): ?>
				<button type="submit" class="btn btn-primary">Simpan Data</button>
				<?php else: ?>
					<a href="<?= base_url('/berkas/edit'); ?>" class="btn btn-warning">Edit Data</a>
				<?php endif; ?>
			</div>
        </div>
    </section>
	<?= form_close(); ?>
</div>

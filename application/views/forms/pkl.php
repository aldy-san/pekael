<div class="pagetitle">
  <div>
    <h1 class="mb-4"><?= $title; ?></h1>
		<nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item text-uppercase"><a href="<?= base_url($base); ?>"><?= $base; ?></a></li>
          <li class="breadcrumb-item active"><?= $title; ?></li>
        </ol>
      </nav>
  </div>
	<section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card p-3">
            <div class="card-body p-3">
				<?= form_open_multipart(isset($data) ? base_url($base.'/edit/'.$data['id']) : base_url($base.'/add'), array('onkeydown' => "return event.key != 'Enter';", 'novalidate' => '', 'class' => 'row g-3 needs-validation')) ?>
				<!--<form class="row g-3 needs-validation" novalidate action="<?= isset($data) ? base_url($base.'/edit/'.$data['id']) : base_url($base.'/add'); ?>" method="POST" class="row g-3">-->
                <div class="col-md-12">
                  <div class="form-floating">
                    <input type="text" name="perusahaan" class="form-control" placeholder="Perusahaan" value="<?= isset($data) ? $data['perusahaan'] : ''; ?>" <?= $isEdit ? '': 'disabled'; ?> required>
                    <label for="perusahaan">Perusahaan</label>
					<div class="invalid-feedback">
                      Perusahaan harus diisi
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
					<div class="form-floating mb-3">
					<input type="date" class="form-control" name="periode_mulai" value="<?= isset($data) ? $data['periode_mulai'] : ''; ?>" <?= $isEdit ? '': 'disabled'; ?> required>
                    <label for="floatingSelect">Periode Mulai</label>
						<div class="invalid-feedback">
							Periode Mulai harus diisi
						</div>
                  </div>
                </div>
                <div class="col-md-6">
					<div class="form-floating mb-3">
					<input type="date" class="form-control" name="periode_akhir" value="<?= isset($data) ? $data['periode_akhir'] : ''; ?>" <?= $isEdit ? '': 'disabled'; ?> required>
                    <label for="floatingSelect">Periode Akhir</label>
						<div class="invalid-feedback">
							Periode Akhir harus diisi
						</div>
                  </div>
                </div>
				<div class="row col-md-8 mb-3">
					<label for="formFile" class="col-sm-2 col-form-label">Berkas Syarat</label>
                  	<div class="col-sm-7">
						<?php if($isEdit) :?>
						<input class="form-control" type="file" id="formFile" name="berkas_syarat" accept="application/pdf">
						<?php endif; ?>
						<?php if(isset($data) && $data['berkas_syarat']) :?>
						<a href="<?= base_url('/files/'.$data['berkas_syarat']); ?>" target="_blank" class="btn btn-info text-white mt-2">See Uploaded File</a>
						<?php endif; ?>
                  	</div>
                </div>
				<?php if ($isEdit): ?>
                <div>
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
				<?php endif; ?>
                <?= form_close(); ?>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
</div>

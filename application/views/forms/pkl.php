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
			  <div class="card-body">
				<h5 class="card-title">Data PKL</h5>
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
						<a href="<?= base_url('/files/'.$data['berkas_syarat']); ?>" target="_blank" class="btn btn-info text-white mt-2">Lihat File</a>
						<?php else: ?>
						<small class="text-danger mt-2 d-flex">(Belum ada)</small>
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
          <div class="card p-3">
            <div class="card-body">
              	<h5 class="card-title">Dosen Pembimbing</h5>
				<?= form_open_multipart(isset($data) ? base_url($base.'/edit/'.$data['id']) : base_url($base.'/add'), array('onkeydown' => "return event.key != 'Enter';", 'novalidate' => '', 'class' => 'row g-3 needs-validation')) ?>
				<!--<form class="row g-3 needs-validation" novalidate action="<?= isset($data) ? base_url($base.'/edit/'.$data['id']) : base_url($base.'/add'); ?>" method="POST" class="row g-3">-->
                <div class="col-md-8">
					<div class="form-floating mb-3">
                      <select class="form-select" id="floatingSelect" <?= $isEdit ? '': 'disabled'; ?>>
						<?php foreach ($dosen as $value) :?>
                        <option value="<?= $value['id']; ?>"><?= $value['name']; ?></option>
						<?php endforeach; ?>
                      </select>
                      <label for="floatingSelect">Dosen Pembimbing</label>
                    </div>
                </div>
				<div class="row col-md-8 mb-3">
					<label for="formFile" class="col-sm-3 col-form-label">Surat Tugas</label>
                  	<div class="col-sm-9">
						<?php if($isEdit) :?>
						<input class="form-control" type="file" id="formFile" name="surat_tugas" accept="application/pdf" >
						<?php endif; ?>
						<?php if(isset($data) && $data['surat_tugas']) :?>
						<a href="<?= base_url('/files/'.$data['surat_tugas']); ?>" target="_blank" class="btn btn-info text-white mt-2">Lihat file</a>
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
          <div class="card p-3">
            <div class="card-body">
              	<h5 class="card-title">Pengajuan Seminar</h5>
				<?= form_open_multipart(isset($data) ? base_url($base.'/edit/'.$data['id']) : base_url($base.'/add'), array('onkeydown' => "return event.key != 'Enter';", 'novalidate' => '', 'class' => 'row g-3 needs-validation')) ?>
				<!--<form class="row g-3 needs-validation" novalidate action="<?= isset($data) ? base_url($base.'/edit/'.$data['id']) : base_url($base.'/add'); ?>" method="POST" class="row g-3">-->
				<div class="col-md-12">
                  <div class="form-floating">
                    <input type="text" name="judul_laporan" class="form-control" placeholder="Judul Laporan" value="<?= isset($data) ? $data['judul_laporan'] : ''; ?>" <?= $isEdit ? '': 'disabled'; ?> required>
                    <label for="judul_laporan">Judul Laporan</label>
					<div class="invalid-feedback">
                      Judul Laporan harus diisi
                    </div>
                  </div>
                </div>
				<div class="col-md-6">
					<div class="form-floating">
					<input type="datetime-local" class="form-control" name="tanggal_seminar" value="<?= isset($data) ? $data['tanggal_seminar'] : ''; ?>" <?= $isEdit ? '': 'disabled'; ?> required>
                    <label for="floatingSelect">Tanggal seminar</label>
						<div class="invalid-feedback">
							Tanggal seminar harus diisi
						</div>
                  </div>
                </div>
				<div class="col-md-6">
					<div class="form-floating">
						<input type="text" name="ruang_seminar" class="form-control" placeholder="Ruang Seminar" value="<?= isset($data) ? $data['ruang_seminar'] : ''; ?>" <?= $isEdit ? '': 'disabled'; ?> required>
						<label for="ruang_seminar">Ruang Seminar</label>
						<div class="invalid-feedback">
						Ruang Seminar harus diisi
						</div>
					</div>
                </div>
				<div class="row col-md-8 mt-3">
					<label for="formFile" class="col-sm-3 col-form-label">File Laporan</label>
                  	<div class="col-sm-9">
						<?php if($isEdit) :?>
						<input class="form-control" type="file" id="formFile" name="file_laporan" accept="application/pdf">
						<?php endif; ?>
						<?php if(isset($data) && $data['file_laporan']) :?>
						<a href="<?= base_url('/files/'.$data['file_laporan']); ?>" target="_blank" class="btn btn-info text-white mt-2">Lihat File</a>
						<?php else: ?>
						<small class="text-danger mt-2 d-flex">(Belum ada)</small>
						<?php endif; ?>
                  	</div>
                </div>
				<div class="row col-md-8 mt-3">
					<label for="formFile" class="col-sm-3 col-form-label">Berkas Seminar</label>
                  	<div class="col-sm-9">
						<?php if($isEdit) :?>
						<input class="form-control" type="file" id="formFile" name="berkas_seminar" accept="application/pdf">
						<?php endif; ?>
						<?php if(isset($data) && $data['berkas_seminar']) :?>
						<a href="<?= base_url('/files/'.$data['berkas_seminar']); ?>" target="_blank" class="btn btn-info text-white mt-2">Lihat File</a>
						<?php else: ?>
						<small class="text-danger mt-2 d-flex">(Belum ada)</small>
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
          <div class="card p-3">
            <div class="card-body">
              	<h5 class="card-title">Data Nilai</h5>
				<?= form_open_multipart(isset($data) ? base_url($base.'/edit/'.$data['id']) : base_url($base.'/add'), array('onkeydown' => "return event.key != 'Enter';", 'novalidate' => '', 'class' => 'row g-3 needs-validation')) ?>
				<!--<form class="row g-3 needs-validation" novalidate action="<?= isset($data) ? base_url($base.'/edit/'.$data['id']) : base_url($base.'/add'); ?>" method="POST" class="row g-3">-->
				<div class="row col-md-12 mt-3">
					<label for="formFile" class="col-sm-3 col-form-label">Berita Acara</label>
                  	<div class="col-sm-9">
						<?php if($isEdit) :?>
						<input class="form-control" type="file" id="formFile" name="berita_acara" accept="application/pdf">
						<?php endif; ?>
						<?php if(isset($data) && $data['berita_acara']) :?>
						<a href="<?= base_url('/files/'.$data['berita_acara']); ?>" target="_blank" class="btn btn-info text-white mt-2">Lihat File</a>
						<?php else: ?>
						<small class="text-danger mt-2 d-flex">(Belum ada)</small>
						<?php endif; ?>
                  	</div>
                </div>
				<div class="row col-md-12 mt-3">
					<label for="formFile" class="col-sm-3 col-form-label">Nilai Dosen Pembimbing</label>
                  	<div class="col-sm-9">
						<?php if($isEdit) :?>
						<input class="form-control" type="file" id="formFile" name="nilai_dosen" accept="application/pdf">
						<?php endif; ?>
						<?php if(isset($data) && $data['nilai_dosen']) :?>
						<a href="<?= base_url('/files/'.$data['nilai_dosen']); ?>" target="_blank" class="btn btn-info text-white mt-2">Lihat File</a>
						<?php else: ?>
						<small class="text-danger mt-2 d-flex">(Belum ada)</small>
						<?php endif; ?>
                  	</div>
                </div>
				<div class="row col-md-12 mt-3">
					<label for="formFile" class="col-sm-3 col-form-label">Nilai Perusahaan</label>
                  	<div class="col-sm-9">
						<?php if($isEdit) :?>
						<input class="form-control" type="file" id="formFile" name="nilai_perusahaan" accept="application/pdf">
						<?php endif; ?>
						<?php if(isset($data) && $data['nilai_perusahaan']) :?>
						<a href="<?= base_url('/files/'.$data['nilai_perusahaan']); ?>" target="_blank" class="btn btn-info text-white mt-2">Lihat File</a>
						<?php else: ?>
						<small class="text-danger mt-2 d-flex">(Belum ada)</small>
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

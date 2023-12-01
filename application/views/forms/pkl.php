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
						<input type="text" name="perusahaan" class="form-control" placeholder="Perusahaan" value="<?= isset($data) ? $data['perusahaan'] : ''; ?>" <?= $isEdit && $user['role'] === 'mahasiswa' && (!isset($data) || $data['status'] <= 1) ? '': 'disabled'; ?> required>
						<label for="perusahaan">Perusahaan</label>
						<div class="invalid-feedback">
						Perusahaan harus diisi
						</div>
					</div>
					</div>
					<div class="col-md-6">
						<div class="form-floating mb-3">
						<input type="date" class="form-control" name="periode_mulai" value="<?= isset($data) ? $data['periode_mulai'] : ''; ?>" <?= $isEdit && $user['role'] === 'mahasiswa' && (!isset($data) || $data['status'] <= 1) ? '': 'disabled'; ?> required>
						<label for="floatingSelect">Periode Mulai</label>
							<div class="invalid-feedback">
								Periode Mulai harus diisi
							</div>
					</div>
					</div>
					<div class="col-md-6">
						<div class="form-floating mb-3">
						<input type="date" class="form-control" name="periode_akhir" value="<?= isset($data) ? $data['periode_akhir'] : ''; ?>" <?= $isEdit && $user['role'] === 'mahasiswa' && (!isset($data) || $data['status'] <= 1) ? '': 'disabled'; ?> required>
						<label for="floatingSelect">Periode Akhir</label>
							<div class="invalid-feedback">
								Periode Akhir harus diisi
							</div>
					</div>
					</div>
					<div class="row col-md-8 mb-3">
						<label for="formFile" class="col-sm-2 col-form-label">Berkas Syarat</label>
						<div class="col-sm-7">
							<?php if($isEdit && $user['role'] === 'mahasiswa' && (!isset($data) || $data['status'] <= 1)) :?>
							<input class="form-control" type="file" id="formFile" name="berkas_syarat" accept="application/pdf" <?= isset($data) && $data['berkas_syarat'] ? '' : 'required'; ?>>
							<?php endif; ?>
							<?php if(isset($data) && $data['berkas_syarat']) :?>
							<a href="<?= base_url('/files/'.$data['berkas_syarat']); ?>" target="_blank" class="btn btn-info text-white mt-2">Lihat File</a>
							<?php else: ?>
							<small class="text-danger mt-2 d-flex">(Belum ada)</small>
							<?php endif; ?>
						</div>
					</div>
					<?php if ($isEdit && $user['role'] === 'mahasiswa' && (!isset($data) || $data['status'] <= 1)): ?>
					<div>
					<button type="submit" class="btn btn-primary">Submit</button>
					</div>
					<?php endif; ?>
					<?= form_close(); ?>
				</form>
				</div>
			</div>
			<?php if (isset($data) && $data['status'] >= 1): ?>
			<div class="card p-3">
				<div class="card-body">
					<h5 class="card-title">Dosen Pembimbing</h5>
					<?= form_open_multipart(base_url($base.'/edit_dosen/'.$data['id']), array('onkeydown' => "return event.key != 'Enter';", 'novalidate' => '', 'class' => 'row g-3 needs-validation')) ?>
					<div class="col-md-8">
						<div class="form-floating mb-3">
						<select class="form-select" name="id_dosen" id="floatingSelect" <?= $isEdit && $user['role'] === 'admin' && $data['status'] <= 2 ? '': 'disabled'; ?>>
							<option value="" disabled <?= $data['id_dosen'] ? '' : 'selected'; ?>>...</option>
							<?php foreach ($dosen as $value) :?>
							<option value="<?= $value['id']; ?>" <?= $value['id'] === $data['id_dosen'] ? 'selected' : ''; ?>><?= $value['name']; ?></option>
							<?php endforeach; ?>
						</select>
						<label for="floatingSelect">Dosen Pembimbing</label>
						</div>
					</div>
					<div class="row col-md-8 mb-3">
						<label for="formFile" class="col-sm-3 col-form-label">Surat Tugas</label>
						<div class="col-sm-9">
							<?php if($isEdit && $user['role'] === 'admin' && $data['status'] <= 2) :?>
							<input class="form-control" type="file" id="formFile" name="surat_tugas" accept="application/pdf" <?= isset($data) && $data['surat_tugas'] ? '' : 'required'; ?>>
							<?php endif; ?>
							<?php if(isset($data) && $data['surat_tugas']) :?>
							<a href="<?= base_url('/files/'.$data['surat_tugas']); ?>" target="_blank" class="btn btn-info text-white mt-2">Lihat file</a>
							<?php else: ?>
							<small class="text-danger mt-2 d-flex">(Belum ada)</small>
							<?php endif; ?>
						</div>
					</div>
					<?php if ($isEdit && $user['role'] === 'admin' && $data['status'] <= 2): ?>
					<div>
					<button type="submit" class="btn btn-primary">Submit</button>
					</div>
					<?php endif; ?>
					<?= form_close(); ?>
				</form>
				</div>
			</div>
			<?php endif; ?>
			<?php if (isset($data) && $data['status'] >= 2): ?>
			<div class="card p-3">
				<div class="card-body">
					<h5 class="card-title">Laporan & Seminar</h5>
					<?= form_open_multipart(base_url($base.'/edit_laporan/'.$data['id']), array('onkeydown' => "return event.key != 'Enter';", 'novalidate' => '', 'class' => 'row g-3 needs-validation')) ?>
					<div class="col-md-12">
						<div class="form-floating">
							<input type="text" name="judul_laporan" class="form-control" placeholder="Judul Laporan" value="<?= isset($data) ? $data['judul_laporan'] : ''; ?>" <?= $isEdit && $user['role'] === 'mahasiswa' && $data['status'] <= 3 ? '': 'disabled'; ?> required>
							<label for="judul_laporan">Judul Laporan</label>
							<div class="invalid-feedback">
							Judul Laporan harus diisi
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-floating">
							<input type="datetime-local" class="form-control" name="tanggal_seminar" value="<?= isset($data) ? $data['tanggal_seminar'] : ''; ?>" <?= $isEdit && $user['role'] === 'mahasiswa' && $data['status'] <= 3 ? '': 'disabled'; ?> required>
							<label for="floatingSelect">Tanggal seminar</label>
							<div class="invalid-feedback">
								Tanggal seminar harus diisi
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-floating">
							<input type="text" name="ruang_seminar" class="form-control" placeholder="Ruang Seminar" value="<?= isset($data) ? $data['ruang_seminar'] : ''; ?>" <?= $isEdit && $user['role'] === 'mahasiswa' && $data['status'] <= 3 ? '': 'disabled'; ?> required>
							<label for="ruang_seminar">Ruang Seminar</label>
							<div class="invalid-feedback">
							Ruang Seminar harus diisi
							</div>
						</div>
					</div>
					<div class="row col-md-8 mt-3">
						<label for="formFile" class="col-sm-3 col-form-label">File Laporan</label>
						<div class="col-sm-9">
							<?php if($isEdit && $user['role'] === 'mahasiswa' && $data['status'] <= 3) :?>
							<input class="form-control" type="file" id="formFile" name="file_laporan" accept="application/pdf" <?= isset($data) && $data['file_laporan'] ? '' : 'required'; ?>>
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
							<?php if($isEdit && $user['role'] === 'mahasiswa' && $data['status'] <= 3) :?>
							<input class="form-control" type="file" id="formFile" name="berkas_seminar" accept="application/pdf" <?= isset($data) && $data['berkas_seminar'] ? '' : 'required'; ?>>
							<?php endif; ?>
							<?php if(isset($data) && $data['berkas_seminar']) :?>
							<a href="<?= base_url('/files/'.$data['berkas_seminar']); ?>" target="_blank" class="btn btn-info text-white mt-2">Lihat File</a>
							<?php else: ?>
							<small class="text-danger mt-2 d-flex">(Belum ada)</small>
							<?php endif; ?>
						</div>
					</div>
					<div class="row col-md-8 mt-3">
						<label for="formFile" class="col-sm-3 col-form-label">Logbook</label>
						<div class="col-sm-9">
							<?php if($isEdit && $user['role'] === 'mahasiswa' && $data['status'] <= 3) :?>
							<input class="form-control" type="file" id="formFile" name="logbook" accept="application/pdf" <?= isset($data) && $data['logbook'] ? '' : 'required'; ?>>
							<?php endif; ?>
							<?php if(isset($data) && $data['logbook']) :?>
							<a href="<?= base_url('/files/'.$data['logbook']); ?>" target="_blank" class="btn btn-info text-white mt-2">Lihat File</a>
							<?php else: ?>
							<small class="text-danger mt-2 d-flex">(Belum ada)</small>
							<?php endif; ?>
						</div>
					</div>
					<?php if ($isEdit && $user['role'] === 'mahasiswa' && $data['status'] <= 3): ?>
					<div>
					<button type="submit" class="btn btn-primary">Submit</button>
					</div>
					<?php endif; ?>
					<?= form_close(); ?>
				</div>
			</div>
			<?php endif; ?>
			<?php if (isset($data) && $data['status'] >= 3): ?>
			<div class="card p-3">
				<div class="card-body">
					<h5 class="card-title">Dosen Pembimbing</h5>
					<?= form_open_multipart(base_url($base.'/edit_penguji/'.$data['id']), array('onkeydown' => "return event.key != 'Enter';", 'novalidate' => '', 'class' => 'row g-3 needs-validation')) ?>
					<div class="col-md-8">
						<div class="form-floating mb-3">
						<select class="form-select" name="id_penguji" id="floatingSelect" <?= $isEdit && $user['role'] === 'admin' && $data['status'] <= 4 ? '': 'disabled'; ?>>
							<option value="" disabled <?= $data['id_penguji'] ? '' : 'selected'; ?>>...</option>
							<?php foreach ($dosen as $value) :?>
							<option value="<?= $value['id']; ?>" <?= $value['id'] === $data['id_penguji'] ? 'selected' : ''; ?>><?= $value['name']; ?></option>
							<?php endforeach; ?>
						</select>
						<label for="floatingSelect">Dosen Pembimbing</label>
						</div>
					</div>
					<?php if ($isEdit && $user['role'] === 'admin' && $data['status'] <= 4): ?>
					<div>
					<button type="submit" class="btn btn-primary">Submit</button>
					</div>
					<?php endif; ?>
					<?= form_close(); ?>
				</form>
				</div>
			</div>
			<?php endif; ?>
			<?php if (isset($data) && $data['status'] >= 4): ?>
			<div class="card p-3">
				<div class="card-body">
					<h5 class="card-title">Data Nilai
						<?php if($user['role'] === 'mahasiswa'): ?>
						<small class="text-danger">(Upload Nilai jika sudah menyelesaikan seminar)</small>
						<?php endif; ?>
					</h5>
					<?= form_open_multipart(base_url($base.'/edit_nilai/'.$data['id']), array('onkeydown' => "return event.key != 'Enter';", 'novalidate' => '', 'class' => 'row g-3 needs-validation')) ?>
					<input type="hidden" name="trigger">
					<div class="row col-md-12 mt-3">
						<label for="formFile" class="col-sm-3 col-form-label">Berita Acara</label>
						<div class="col-sm-9">
							<?php if($isEdit && $user['role'] === 'mahasiswa' && $data['status'] <= 4) :?>
							<input class="form-control" type="file" id="formFile" name="berita_acara" accept="application/pdf" <?= isset($data) && $data['berita_acara'] ? '' : 'required'; ?>>
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
							<?php if($isEdit && $user['role'] === 'mahasiswa' && $data['status'] <= 4) :?>
							<input class="form-control" type="file" id="formFile" name="nilai_dosen" accept="application/pdf" <?= isset($data) && $data['nilai_dosen'] ? '' : 'required'; ?>>
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
							<?php if($isEdit && $user['role'] === 'mahasiswa' && $data['status'] <= 4) :?>
							<input class="form-control" type="file" id="formFile" name="nilai_perusahaan" accept="application/pdf" <?= isset($data) && $data['nilai_perusahaan'] ? '' : 'required'; ?>>
							<?php endif; ?>
							<?php if(isset($data) && $data['nilai_perusahaan']) :?>
							<a href="<?= base_url('/files/'.$data['nilai_perusahaan']); ?>" target="_blank" class="btn btn-info text-white mt-2">Lihat File</a>
							<?php else: ?>
							<small class="text-danger mt-2 d-flex">(Belum ada)</small>
							<?php endif; ?>
						</div>
					</div>
					<?php if ($isEdit && $user['role'] === 'mahasiswa' && $data['status'] <= 4): ?>
					<div>
					<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#confirmModal">Submit</button>
					<div class="modal fade" id="confirmModal" tabindex="-1">
						<div class="modal-dialog modal-sm modal-dialog-centered">
							<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Simpan Data Nilai</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<div class="modal-body text-center">
								<b class="text-danger">Data tidak akan bisa diubah setelah menyimpan data nilai.</b> 
								<p>Apakah anda yakin ingin menyimpan data nilai?</p>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
								<form id="form-delete" action="<?= base_url($base.'/delete'); ?>" method="POST">
									<input type="hidden" name="id" value="">
									<button type="submit" class="btn btn-success">Iya</button>
								</form>
							</div>
							</div>
						</div>
					</div>
					</div>
					<?php endif; ?>
					<?= form_close(); ?>
				</div>
			</div>
			<?php endif; ?>
        </div>
      </div>
    </section>
</div>

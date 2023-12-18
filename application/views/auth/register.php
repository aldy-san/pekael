<main>
    <div class="container">
      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container mt-4">
          <div class="row justify-content-center">
            <div class="col-lg-8 d-flex flex-column align-items-center justify-content-center">
        		<?php if ($this->session->flashdata('alertForm')): ?>
				<div class="alert alert-danger alert-dismissible fade show" role="alert">
					<?= $this->session->flashdata('alertForm'); ?>
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>
				<?php endif; ?>
				<div class="card mb-3">
					<div class="card-body">
						<div class="pt-4 pb-2">
						<h5 class="card-title text-center pb-0 fs-4">Buat akun anda</h5>
							<p class="text-center small">Masukkan data anda untuk buat akun</p>
						</div>
						<form action="<?=base_url('register')?>" method="POST" data-parsley-validate class="row g-3">
							<div class="col-6">
								<label for="nama" class="form-label">Nama Lengkap</label>
								<div class="form-group">
									<input type="text" name="nama" class="form-control" id="nama" data-parsley-required="true">
								</div>
							</div>
							<div class="col-6">
								<label for="npm" class="form-label">NPM</label>
								<div class="form-group">
									<input type="text" name="npm" class="form-control" id="npm" data-parsley-required="true">
								</div>
							</div>
							<div class="col-12">
								<label for="email" class="form-label">Email</label>
								<div class="form-group">
									<input type="email" name="email" class="form-control" id="email" data-parsley-required="true">
								</div>
							</div>
							<div class="col-6">
								<label for="prodi" class="form-label">Prodi</label>
								<div class="form-group">
									<input type="text" name="prodi" class="form-control" id="prodi" data-parsley-required="true">
								</div>
							</div>
							<div class="col-6">
								<label for="angkatan" class="form-label">Angkatan</label>
								<div class="form-group">
									<input type="number" min="1900" max="<?= date("Y"); ?>" step="1" name="angkatan" class="form-control" id="angkatan" data-parsley-required="true">
								</div>
							</div>
							<div class="col-6">
								<label for="password" class="form-label">Password</label>
								<div class="form-group">
									<input type="password" name="password" class="form-control" id="password" data-parsley-required="true">
								</div>
							</div>
							<div class="col-6">
								<label for="confirm-password" class="form-label">Konfirmasi Password</label>
								<div class="form-group">
									<input type="password" name="confirm-password" class="form-control" id="confirm-password" data-parsley-required="true">
								</div>
							</div>
							<div class="col-12">
								<button class="btn btn-primary w-100" type="submit">Daftar</button>
							</div>
							<div class="col-12">
								<p class="small mb-0">Sudah punya akun? <a href="<?= base_url('login'); ?>">Masuk</a></p>
							</div>
						</form>
					</div>
				</div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </main><!-- End #main -->

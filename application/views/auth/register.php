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
						<form action="<?=base_url('register')?>" method="POST" novalidate class="row g-3 needs-validation">
							<div class="col-5">
								<label for="username" class="form-label">Username (NPM)</label>
								<div class="input-group has-validation">
									<input type="text" name="username" class="form-control" id="username" required>
									<div class="invalid-feedback">Masukkan username!</div>
								</div>
							</div>
							<div class="col-7">
								<label for="name" class="form-label">Nama Lengkap</label>
								<div class="input-group has-validation">
									<input type="text" name="name" class="form-control" id="name" required>
									<div class="invalid-feedback">Masukkan nama lengkap!</div>
								</div>
							</div>
							<div class="col-12">
								<label for="email" class="form-label">Email</label>
								<div class="input-group has-validation">
									<input type="email" name="email" class="form-control" id="email" required>
									<div class="invalid-feedback">Masukkan email yang benar!</div>
								</div>
							</div>
							<div class="col-6">
								<label for="password" class="form-label">Password</label>
								<input type="password" name="password" class="form-control" id="password" required>
								<div class="invalid-feedback">Masukkan password!</div>
							</div>
							<div class="col-6">
								<label for="confirm-password" class="form-label">Konfirmasi Password</label>
								<input type="password" name="confirm-password" class="form-control" id="confirm-password" required>
								<div class="invalid-feedback">Masukkan konfirmasi password!</div>
							</div>
							<div class="col-12">
								<button class="btn btn-primary w-100" type="submit">Login</button>
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

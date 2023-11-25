<main>
    <div class="container">
      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
        		<?php if ($this->session->flashdata('alertForm')): ?>
				<div class="alert alert-<?= $this->session->flashdata('alertType') ? $this->session->flashdata("alertType") : 'danger'; ?> alert-dismissible fade show" role="alert">
					<?= $this->session->flashdata('alertForm'); ?>
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>
				<?php endif; ?>
				<div class="card mb-3">
					<div class="card-body">
						<div class="pt-4 pb-2">
							<h5 class="card-title text-center pb-0 fs-4">Masuk ke akun anda</h5>
							<p class="text-center small">Masukkan username & password untuk login</p>
						</div>
						<form action="<?=base_url('login')?>" method="POST" novalidate class="row g-3 needs-validation">
							<div class="col-12">
								<label for="username" class="form-label">Username/NIP/NPM</label>
								<div class="input-group has-validation">
									<input type="text" name="username" class="form-control" id="username" required>
									<div class="invalid-feedback">Masukkan username!</div>
								</div>
							</div>
							<div class="col-12">
								<label for="password" class="form-label">Password</label>
								<input type="password" name="password" class="form-control" id="password" required>
								<div class="invalid-feedback">Masukkan password!</div>
							</div>
							<div class="col-12">
								<button class="btn btn-primary w-100" type="submit">Login</button>
							</div>
							<div class="col-12">
								<p class="small mb-0">Belum punya akun? <a href="<?= base_url('register'); ?>">Buat akun</a></p>
							</div>
						</form>
					</div>
				</div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </main>

<div class="page-heading px-5">
    <div class="page-title mb-3">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Profil</h3>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-center align-items-center flex-column">
                            <h3 class="mt-3"><?= $user['nama']; ?></h3>
                            <p class="text-small"><?= $user['email']; ?></p>
                        </div>
                    </div>
                </div>
				<?php if($user['role'] === 'mahasiswa'): ?>
				<div class="card">
					<div class="card-body">
						<h3>Edit Profil</h3>
						<form action="<?= base_url('profile/edit'); ?>" method="POST" data-parsley-validate>
							<div class="row">
								<div class="col-6">
									<label for="nama" class="form-label">Nama Lengkap</label>
									<div class="form-group">
										<input type="text" name="nama" class="form-control" id="nama" value="<?= $user['nama']; ?>" data-parsley-required="true">
									</div>
								</div>
								<div class="col-6">
									<label for="npm" class="form-label">NPM</label>
									<div class="form-group">
										<input type="text" name="npm" class="form-control" id="npm" value="<?= $user['npm']; ?>" data-parsley-required="true">
									</div>
								</div>
								<div class="col-6">
									<label for="prodi" class="form-label">Prodi</label>
									<div class="form-group">
										<input type="text" name="prodi" class="form-control" id="prodi" value="<?= $user['prodi']; ?>" data-parsley-required="true">
									</div>
								</div>
								<div class="col-6">
									<label for="angkatan" class="form-label">Angkatan</label>
									<div class="form-group">
										<input type="number" min="1900" max="<?= date("Y"); ?>" step="1" name="angkatan" class="form-control" id="angkatan" value="<?= $user['angkatan']; ?>" data-parsley-required="true">
									</div>
								</div>
							</div>
							<div class="form-group">
								<button type="submit" class="btn btn-primary">Simpan Data</button>
							</div>
						</form>
					</div>
				</div>
				<?php endif; ?>
				<div class="card">
					<div class="card-body">
						<h3>Edit Password</h3>
						<form action="<?= base_url('profile/change-password'); ?>" method="POST" data-parsley-validate>
							<div class="row">
								<div class="col-4">
									<label for="old-password" class="form-label">Password Lama</label>
									<div class="form-group">
										<input type="password" name="old-password" class="form-control" id="old-password"  placeholder="Password Lama" data-parsley-required="true">
									</div>
								</div>
								<div class="col-4">
									<label for="password" class="form-label">Password Baru</label>
									<div class="form-group">
										<input type="password" name="password" class="form-control" id="password"  placeholder="Password" data-parsley-required="true">
									</div>
								</div>
								<div class="col-4">
									<label for="confirm-password" class="form-label">Konfirmasi Password</label>
									<div class="form-group">
										<input type="password" name="confirm-password" class="form-control" id="confirm-password"  placeholder="Password Baru" data-parsley-required="true">
									</div>
								</div>
							</div>
							<div class="form-group">
								<button type="submit" class="btn btn-primary">Simpan Data</button>
							</div>
						</form>
					</div>
				</div>
            </div>
            <div class="col-12 col-lg-8">
            </div>
        </div>
    </section>
</div>

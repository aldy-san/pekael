<section class="section profile">
      <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
              <img src="<?= $user['photo'] ? base_url('photos/'.$user['photo']) : base_url('assets/cms/img/img-placeholder.png'); ?>" alt="Profile" class="object-fit-cover rounded-circle" style="aspect-ratio:1;">
              <h2><?= $user['name']; ?></h2>
              <h3 class="text-capitalize"><?= $user['role']; ?></h3>
            </div>
          </div>
        </div>
        <div class="col-xl-8">
          <div class="card">
            <div class="card-body pt-3">
              <ul class="nav nav-tabs nav-tabs-bordered">
                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Detail</button>
                </li>
                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profil</button>
                </li>
                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Ubah Password</button>
                </li>
              </ul>
              <div class="tab-content pt-2">
                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                  <h5 class="card-title">Detail Profil</h5>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Full Name</div>
                    <div class="col-lg-9 col-md-8"><?= $user['name']; ?></div>
                  </div>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Username</div>
                    <div class="col-lg-9 col-md-8"><?= $user['username']; ?></div>
                  </div>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Email</div>
                    <div class="col-lg-9 col-md-8"><?= $user['email']; ?></div>
                  </div>
                </div>
                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
										<?= form_open_multipart('profile/edit', array('novalidate' => '', 'class' => 'row g-3 needs-validation')) ?>
                    <div class="row mb-3">
                      <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Foto Profil</label>
                      	<div class="col-md-8 col-lg-9">
                        	<img src="<?= $user['photo'] ? base_url('photos/'.$user['photo']) : base_url('assets/cms/img/img-placeholder.png'); ?>" alt="Profile" class="object-fit-cover" style="aspect-ratio:1;">
												</div>
                    </div>
										<div class="row mb-3">
											<label for="file" class="col-md-4 col-lg-3 col-form-label">Upload Gambar</label>
												<div class="col-md-8">
												<input class="form-control" type="file" id="file" name="file" accept="image/*">
											</div>
										</div>
                    <div class="row mb-3">
                      <label for="email" class="col-md-4 col-lg-3 col-form-label">Nama Lengkap</label>
                      <div class="col-md-8">
                        <input name="name" type="text" class="form-control" id="name" value="<?= $user['name']; ?>" required>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                      <div class="col-md-8">
                        <input name="email" type="email" class="form-control" id="email" value="<?= $user['email']; ?>" required>
                      </div>
                    </div>
                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
										<?= form_close(); ?>
                </div>
                <div class="tab-pane fade pt-3" id="profile-change-password">
                  <form action="<?= base_url('profile/change-password'); ?>" method="POST">
                    <div class="row mb-3">
                      <label for="old-password" class="col-md-4 col-lg-3 col-form-label">Password saat ini</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="old-password" type="password" class="form-control" id="old-password">
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="password" class="col-md-4 col-lg-3 col-form-label">Password Baru</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="password" type="password" class="form-control" id="password">
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="confirm-password" class="col-md-4 col-lg-3 col-form-label">Konfirmasi Password baru</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="confirm-password" type="password" class="form-control" id="confirm-password">
                      </div>
                    </div>
                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Ubah Password</button>
                    </div>
                  </form>
                </div>
			  </div>
            </div>
          </div>
        </div>
      </div>
    </section>

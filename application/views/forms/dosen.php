<div class="pagetitle">
  <div>
    <h1 class="mb-4"><?= $title; ?></h1>
		<nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item text-capitalize"><a href="<?= base_url($base); ?>"><?= $base; ?></a></li>
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
                <div class="col-md-6">
                  <div class="form-floating">
                    <input type="text" name="username" class="form-control" placeholder="NIP" value="<?= isset($data) ? $data['username'] : ''; ?>" <?= $isEdit ? '': 'disabled'; ?> required>
                    <label for="username">NIP</label>
										<div class="invalid-feedback">
                      NIP harus diisi!
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-floating">
                    <input type="text" name="name" class="form-control" placeholder="Nama Dosen" value="<?= isset($data) ? $data['name'] : ''; ?>" <?= $isEdit ? '': 'disabled'; ?> required>
                    <label for="name">Nama Dosen</label>
									<div class="invalid-feedback">
                      Nama Dosen harus diisi!
                    </div>
                  </div>
                </div>
								<?php if (!isset($data)): ?>
                <div class="col-md-6">
                  <div class="form-floating">
                    <input type="text" name="password" class="form-control" placeholder="Nama Dosen" value="<?= isset($data) ? $data['password'] : ''; ?>" <?= $isEdit ? '': 'disabled'; ?> required>
                    <label for="password">Password</label>
									<div class="invalid-feedback">
                      Password harus diisi!
                    </div>
                  </div>
                </div>
								<?php endif; ?>
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

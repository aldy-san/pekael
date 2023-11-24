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
							<form class="row g-3 needs-validation" novalidate action="<?= isset($data) ? base_url($base.'/edit/'.$data['id']) : base_url($base.'/add'); ?>" method="POST" class="row g-3">
                <div class="col-md-12">
                  <div class="form-floating">
                    <input type="text" name="name" class="form-control" placeholder="Program" value="<?= isset($data) ? $data['name'] : ''; ?>" <?= $isEdit ? '': 'disabled'; ?> required>
                    <label for="name">Program Name</label>
										<div class="invalid-feedback">
                      Program Name is Required
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
									<div class="form-floating mb-3">
									<input type="date" class="form-control" name="start_date" value="<?= isset($data) ? $data['start_date'] : ''; ?>" <?= $isEdit ? '': 'disabled'; ?> required>
                    <label for="floatingSelect">Start Date</label>
										<div class="invalid-feedback">
											Start Date is Required
										</div>
                  </div>
                </div>
                <div class="col-md-6">
									<div class="form-floating mb-3">
									<input type="date" class="form-control" name="end_date" value="<?= isset($data) ? $data['end_date'] : ''; ?>" <?= $isEdit ? '': 'disabled'; ?> required>
                    <label for="floatingSelect">End Date</label>
										<div class="invalid-feedback">
											End Date is Required
										</div>
                  </div>
                </div>
								<?php if ($isEdit): ?>
                <div>
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
								<?php endif; ?>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
</div>

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
							<!--<form class="row g-3 needs-validation" novalidate action="<?= isset($data) ? base_url($base.'/edit/'.$data['id']) : base_url($base.'/add'); ?>" method="POST" class="row g-3">-->
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
								<div class="row col-md-6 mb-3">
									<label for="formFile" class="col-sm-2 col-form-label">File Upload</label>
                  <div class="col-sm-10">
										<input class="form-control" type="file" id="formFile" name="file" accept="application/pdf">
										<?php if($data['file']) :?>
										<a href="<?= base_url('/files/'.$data['file']); ?>" target="_blank" class="btn btn-info text-white mt-2">See Uploaded File</a>
										<?php endif; ?>
                  </div>
                </div>
								<div class="row col-md-6 mb-3">
                  <label for="formFile2" class="col-sm-2 col-form-label">File Upload 2</label>
                  <div class="col-sm-10">
                    <input class="form-control" type="file" id="formFile2" name="file2" accept="application/pdf" >
										<?php if($data['file2']) :?>
										<a href="<?= base_url('/files/'.$data['file2']); ?>" target="_blank" class="btn btn-info text-white mt-2">See Uploaded File</a>
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

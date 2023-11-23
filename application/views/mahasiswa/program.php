<div class="pagetitle">
  <h1 class="mb-4">Program</h1>
  <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Data Program</h5>
              <table class="table datatable">
                <thead>
                  <tr>
                    <th>
						ID
                    </th>
                    <th>
						Program
                    </th>
                    <th data-type="date" data-format="YYYY-DD-MM">Start Date</th>
                    <th data-type="date" data-format="YYYY-DD-MM">End Date</th>
                  </tr>
                </thead>
				<?php
					foreach ($program as $key => $value) :
				?>
                <tbody>
					<tr>
                    <td><?= $key+1; ?></td>
                    <td><?= $value['name']; ?></td>
                    <td><?= $value['start_date']; ?></td>
                    <td><?= $value['end_date']; ?></td>
                  </tr>
				</tbody>
				<?php
					endforeach;
				?>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
</div>

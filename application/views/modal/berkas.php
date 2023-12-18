<?php $list_file =  [
			[
				'title' => 'Form Lab',
				'key' => 'form_lab'
			],
			[
				'title' => 'Transkrip',
				'key' => 'transkrip'
			],
			[
				'title' => 'KRS',
				'key' => 'krs'
			],
			[
				'title' => 'Nilai Laporan PKL',
				'key' => 'nilai_laporan_pkl'
			],
			[
				'title' => 'Nilai Laporan MSIB',
				'key' => 'nilai_laporan_msib'
			],
			[
				'title' => 'Jurnal Nasional',
				'key' => 'jurnal_nasional'
			],
			[
				'title' => 'Jurnal Internasional',
				'key' => 'jurnal_internasional'
			],
			[
				'title' => 'Review Jurnal',
				'key' => 'review_jurnal'
			],
			[
				'title' => 'Point SKPM',
				'key' => 'point_skpm'
			],
		]; ?>
<div class="modal fade" id="berkasModal" tabindex="-1">
	<div class="modal-dialog modal-lg modal-dialog-centered">
		<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title">Data Berkas Persyaratan</h5>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		</div>
		<div class="modal-body">
			<div class="row g-3">
				<?php foreach ($list_file as $key => $value) :?>
				<div class="row col-md-4 mt-3">
					<label for="formFile" class="col-sm-12 col-form-label"><?= $value['title']; ?></label>
					<div class="col-sm-12">
						<a href="" target="_blank" data-name="<?= $value['key']; ?>" class="btn btn-info text-white mt-2">Lihat File</a>
					</div>
				</div>
				<?php endforeach; ?>
			</div>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
		</div>
		</div>
	</div>
</div>

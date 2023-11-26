<div class="modal fade" id="seminarModal" tabindex="-1">
	<div class="modal-dialog modal-lg modal-dialog-centered">
		<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title">Data Laporan & Seminar</h5>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		</div>
		<div class="modal-body">
			<div class="row g-3">
				<div class="col-md-12">
					<div class="form-floating">
						<input type="text" name="judul_laporan" class="form-control" placeholder="Judul Laporan" value="" disabled>
						<label for="judul_laporan">Judul Laporan</label>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-floating">
						<input type="datetime-local" class="form-control" name="tanggal_seminar" value="" disabled>
						<label for="floatingSelect">Tanggal seminar</label>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-floating">
						<input type="text" name="ruang_seminar" class="form-control" placeholder="Ruang Seminar" value="" disabled>
						<label for="ruang_seminar">Ruang Seminar</label>
					</div>
				</div>
				<div class="row col-md-12 mt-3">
					<label for="formFile" class="col-sm-3 col-form-label">File Laporan</label>
					<div class="col-sm-9">
						<a href="" target="_blank" data-name="file_laporan" class="btn btn-info text-white mt-2">Lihat File</a>
					</div>
				</div>
				<div class="row col-md-12 mt-3">
					<label for="formFile" class="col-sm-3 col-form-label">Berkas Seminar</label>
					<div class="col-sm-9">
						<a href="" target="_blank" data-name="berkas_seminar" class="btn btn-info text-white mt-2">Lihat File</a>
					</div>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
		</div>
		</div>
	</div>
</div>

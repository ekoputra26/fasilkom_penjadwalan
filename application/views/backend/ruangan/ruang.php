<div class="content-wrapper">
	<div class="container-full">
		<div class="content-header">
			<div class="d-flex align-items-center justify-content-between">
				<div class="d-md-block d-none">
					<h3 class="page-title br-0"><?= $title ?></h3>
					<div class="d-inline-block align-items-center">
						<nav>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="<?= base_url()?>"><i class="mdi mdi-home-outline"></i> Dashboard</a></li>
								<li class="breadcrumb-item" aria-current="page"><?= $groupTitle ?></li>
								<li class="breadcrumb-item active" aria-current="page"><?= $title ?></li>
							</ol>
						</nav>
					</div>

				</div>
			</div>
		</div>

		<section class="content">
			<div class="row">

				<div class="col-12">
					<div class="box">
						<div class="box-header">
							<h3 class="box-title">Data <?= $title ?></h3>
							<div class="box-controls pull-right">
								<button class="btn btn-info" href="#" data-target="#modalForm" data-toggle="modal" id="createData">Tambah Data</button>
							</div>                
						</div>
						<div class="box-body">
							<div class="table-responsive">
								<table class="table table-bordered table-striped mytables" id="mydata-tables">
									<thead>
										<tr>
											<th>Gedung</th>
											<th class="text-center">Kode Ruang</th>
											<th class="text-center">Lantai</th>
											<th class="text-center">Status</th>
											<th class="text-center">Jenis</th>
											<th class="text-center">Latitude</th>
											<th class="text-center">Longitude</th>
											<th>Keterangan</th>
											<th class="text-center">QRCode</th>
											<th class="text-center">Aksi</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td class="display-none"></td>
											<td class="display-none"></td>
											<td class="display-none"></td>
											<td class="display-none"></td>
											<td class="text-center"><h3 class="text-primary">&nbsp;</h3></td>
											<td class="display-none"></td>
											<td class="display-none"></td>
											<td class="display-none"></td>
											<td class="display-none"></td>
											<td class="display-none"></td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>  
			</div>  
		</section>
	</div>
</div>


<div class="modal fade" id="modalForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modalTite">Loading...</h5>
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<input type="hidden" id="ruang-id">
							<label>Gedung  <sup class="text-danger">*</sup></label>
							<select id="gedung-id" class="form-control">
								<option value="">--Pilih Gedung--</option>
								<?php foreach($gedung as $i): ?>
									<option value="<?= $i->gedung_id ?>"><?= $i->gedung_nama ?></option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Kode Ruang  <sup class="text-danger">*</sup></label>
							<input type="text" class="form-control" id="ruang-kode" placeholder="Kode Ruang">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Lantai</label>
							<input type="number" class="form-control" id="ruang-lantai" placeholder="Lantai">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Status  <sup class="text-danger">*</sup></label>
							<select id="ruang-status" class="form-control">
								<option value="">--Pilih Status--</option>
								<option value="Baik">Baik</option>
								<option value="Rusak">Rusak</option>
								<option value="N/A">N/A</option>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Jenis  <sup class="text-danger">*</sup></label>
							<select id="ruang-jenis" class="form-control">
								<option value="">--Pilih Jenis--</option>
								<option value="Kelas">Kelas</option>
								<option value="Kantor">Kantor</option>
								<option value="Ruang Rapat">Ruang Rapat</option>
								<option value="Ruang Sidang">Ruang Sidang</option>
								<option value="Lab">Lab</option>
							</select>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<label>Keterangan</label>
							<textarea class="form-control" placeholder="Keterangan" id="ruang-keterangan"></textarea>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Latitude  <sup class="text-danger">*</sup></label>
							<input type="text" class="form-control" id="ruang-latitude" placeholder="Latitude">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Longitude  <sup class="text-danger">*</sup></label>
							<input type="text" class="form-control" id="ruang-longitude" placeholder="Longitude">
						</div>
					</div>
					<div class="col-md-12 text-center mt-1">
						<div class="form-group">
							<p id="ruang-text-geo" class="text-danger"></p>
							<button class="btn btn-sm btn-success" id="ruang-geolocation">Generate Location</button>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer modal-footer-uniform">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary float-right" id="save_changes">Save changes</button>
			</div>
		</div>
	</div>
</div>



<div class="modal fade" id="modalQR" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modalTite">QRCode</h5>
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group"  id="ruang-imgQr">
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer modal-footer-uniform text-center">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
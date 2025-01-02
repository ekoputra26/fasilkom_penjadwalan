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
											<th>Ruang</th>
											<th class="text-center">Nama Barang</th>
											<th class="text-center">NUP</th>
											<th class="text-center">Merek</th>
											<th class="text-center">Kondisi</th>
											<th>Keterangan</th>
											<th class="text-center">Aksi</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td class="display-none"></td>
											<td class="display-none"></td>
											<td class="display-none"></td>
											<td class="text-center"><h3 class="text-primary">&nbsp;</h3></td>
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
							<input type="hidden" id="barang-id">
							<label>Ruang  <sup class="text-danger">*</sup></label>
							<select id="ruang-id" class="form-control">
								<option value="">--Pilih Ruang--</option>
								<?php foreach($ruang as $i): ?>
									<option value="<?= $i->ruang_id ?>"><?= $i->ruang_kode ?></option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<label>Nama Barang  <sup class="text-danger">*</sup></label>
							<input type="text" class="form-control" id="barang-nama" placeholder="Nama Barang">
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<label>NUP  <sup class="text-danger">*</sup></label>
							<input type="text" class="form-control" id="barang-nup" placeholder="NUP">
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<label>Merek</label>
							<input type="text" class="form-control" id="barang-merek" placeholder="Merek">
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<label>Kondisi  <sup class="text-danger">*</sup></label>
							<select id="barang-kondisi" class="form-control">
								<option value="">--Pilih Status--</option>
								<option value="Baik">Baik</option>
								<option value="Sedang">Sedang</option>
								<option value="Buruk">Buruk</option>
							</select>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<label>Keterangan</label>
							<textarea class="form-control" placeholder="Keterangan" id="barang-keterangan"></textarea>
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
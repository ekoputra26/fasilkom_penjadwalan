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
											<th>Nama</th>
											<th>Username</th>
											<th>Prodi</th>
											<th>Role</th>
											<th class="text-center">Aksi</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td class="display-none"></td>
											<td class="display-none"></td>
											<td class="text-center"><h3 class="text-primary">&nbsp;</h3></td>
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


<div class="modal fade" id="modalForm"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
							<label>Nama  <sup class="text-danger">*</sup></label>
							<input type="hidden" class="form-control" id="user-id" />
							<input type="text" class="form-control" placeholder="Nama" id="user-nama" required="" />
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<label>Username  <sup class="text-danger">*</sup></label>
							<input type="text" class="form-control" placeholder="Username" id="user-username" required="" />
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<label>Role  <sup class="text-danger">*</sup></label>
							<select id="user-role" required class="form-control">
								<option value="">--Pilih Role--</option>
								<option value="Pimpinan">Pimpinan</option>
								<option value="Superadmin">Superadmin</option>
								<option value="Prodi">Prodi</option>
								<option value="Dosen">Dosen</option>
							</select>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<label>Password  <sup class="text-danger">*</sup></label>
							<input type="password" class="form-control" placeholder="Password" id="user-password" required="" />
							<small class="text-danger info-pass"></small>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<label>Re-Password  <sup class="text-danger">*</sup></label>
							<input type="password" class="form-control" placeholder="Re-Password" id="user-repassword" required="" />
							<small class="text-danger info-pass"></small>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<label>Fakultas  <sup class="text-danger">*</sup></label>
							<select id="user-fakultas" class="form-control select2" style="width:100%">
								<option value="">--Pilih Fakultas--</option>
							</select>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<label>Jurusan  <sup class="text-danger">*</sup></label>
							<select id="user-jurusan" class="form-control select2" style="width:100%" disabled>
								<option value="">--Pilih Jurusan--</option>
							</select>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<label>Prodi  <sup class="text-danger">*</sup></label>
							<select id="user-prodi" class="form-control select2" style="width:100%" disabled>
								<option value="">--Pilih Prodi--</option>
							</select>
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
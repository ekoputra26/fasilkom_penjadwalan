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

				<div class="col-xl-12 col-12">
					<div class="box">
						<div class="box-body">
							<ul class="nav nav-tabs justify-content-center" role="tablist" id="tab-jadwal">
								<li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#palembang" role="tab"><span><i class="fa fa-calendar-check-o"></i></span> <span class="hidden-xs-down ml-15">Kampus Palembang</span></a> </li>
								<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#indralaya" role="tab"><span><i class="fa fa-clock-o"></i></span> <span class="hidden-xs-down ml-15">Kampus Indralaya</span></a> </li>
								<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#ogan" role="tab"><span><i class="fa fa-cogs"></i></span> <span class="hidden-xs-down ml-15">Kampus Ogan</span></a> </li>
								<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#jakabaring" role="tab"><span><i class="fa fa-bullseye"></i></span> <span class="hidden-xs-down ml-15">Kampus Jakabaring</span></a> </li>
								<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#km5" role="tab"><span><i class="fa fa-server"></i></span> <span class="hidden-xs-down ml-15">Kampus KM 5</span></a> </li>
							</ul>
							<div class="tab-content">
								<div class="tab-pane active" id="palembang" role="tabpanel">
								</div>
								<div class="tab-pane" id="indralaya" role="tabpanel">
								</div>
								<div class="tab-pane" id="ogan" role="tabpanel">
								</div>
								<div class="tab-pane" id="jakabaring" role="tabpanel">
								</div>
								<div class="tab-pane" id="km5" role="tabpanel">
								</div>
							</div>
							<div id="div-calender">
								<div id='calendar'></div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-12">
					<div class="box">
						<div class="box-header">
							<h3 class="box-title">Data <?= $title ?></h3>
							<div class="box-controls pull-right">
								<!-- <button class="btn btn-info" href="#" data-target="#modalForm" data-toggle="modal" id="createData">Tambah Data</button> -->
							</div>                
						</div>
						<div class="box-body">
							<div class="table-responsive">
								<table class="table table-bordered table-striped mytables" id="mydata-tables">
									<thead>
										<tr>
											<th class="text-center" rowspan="2">Hari</th>
											<th class="text-center" colspan="2">Jam</th>
											<th class="text-center" rowspan="2">Ruang</th>
											<th class="text-center" rowspan="2">SKS</th>
											<th class="text-center" rowspan="2">Semester</th>
											<th class="text-center" rowspan="2">Kelas</th>
											<th class="text-center" rowspan="2">Mata Kuliah</th>
											<th class="text-center" rowspan="2">Kode</th>
											<th class="text-center" rowspan="2">Nama Dosen</th>
											<th class="text-center" rowspan="2">Aksi</th>
										</tr>
										<tr>
											<th class="text-center">Masuk</th>
											<th class="text-center">Keluar</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td class="display-none"></td>
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
		<section class="content">
			<div class="row">
				<div class="col-xl-12 col-12">
					<div class="box">
						<div class="box-header" >
							<h4 id="judul-filter"> Filter Jadwal Berdasarkan Semua Prodi dan Tahun Ajaran Sekarang </h4>
						</div>
						<div class="box-body">
							<div id="div-calender">
								<div id='calendar_report'></div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-12">
					<div class="box">
						<div class="box-header">
							<h3 class="box-title">Data <?= $title ?></h3>
							<div class="box-controls pull-right">
								<!-- <button class="btn btn-info" href="#" data-target="#modalForm" data-toggle="modal" id="createData">Tambah Data</button> -->
							</div>
						</div>
						<div class="box-body">
							<div class="table-responsive">
								<table class="table table-bordered table-striped mytables" id="mydata-tables">
									<thead>
										<tr>
											<th class="text-center" rowspan="2">Hari</th>
											<th class="text-center" colspan="2">Jam</th>
											<th class="text-center" rowspan="2">Ruang</th>
											<th class="text-center" rowspan="2">SKS</th>
											<th class="text-center" rowspan="2">Kelas</th>
											<th class="text-center" rowspan="2">Mata Kuliah</th>
											<th class="text-center" rowspan="2">Nama Dosen</th>
											<th class="text-center" rowspan="2">Aksi</th>
										</tr>
										<tr>
											<th class="text-center">Masuk</th>
											<th class="text-center">Keluar</th>
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
					<div class="col-md-4">
						<div class="form-group">
							<input type="hidden" id="jadwal-id">
							<label>Hari <sup class="text-danger">*</sup></label>
							<?php $hari = ['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu']; ?>
							<select id="jadwal-hari" class="form-control" disabled>
								<option value="">--Pilih Hari--</option>
								<?php foreach($hari as $i): ?>
									<option value="<?= $i ?>"><?= $i ?></option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label>Jam Masuk <sup class="text-danger">*</sup></label>
							<input type="time" class="form-control" id="jadwal-masuk" disabled>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label>Jam Keluar <sup class="text-danger">*</sup></label>
							<input type="time" class="form-control" id="jadwal-keluar" disabled>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<label>Ruang <sup class="text-danger">*</sup></label>
							<select id="ruang-id" class="form-control " disabled>
								<option value="">--Pilih Ruang--</option>
								<?php foreach($ruang as $i): ?>
									<option value="<?= $i->ruang_id ?>"><?= $i->ruang_kode ?></option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<label>Mata Kuliah <sup class="text-danger">*</sup></label>
							<select id="mk-id" class="form-control select2" style="width: 100%;"  >
								<?php foreach($mata_kuliah as $i): ?>
									<option value="<?= $i->mk_id ?>"><?= $i->mk_nama ?></option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<label>Dosen <sup class="text-danger">*</sup></label>
							<select id="dosen-id" class="form-control select2" multiple="multiple" data-placeholder="--Pilih Dosen--" style="width: 100%;">
								<?php foreach($dosen as $i): ?>
									<option value="<?= $i->dosen_id ?>"><?= $i->dosen_nama ?></option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label>Kelas <sup class="text-danger">*</sup></label>
							<input type="text" class="form-control" id="jadwal-kelas" placeholder="Kelas">
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label>Semester <sup class="text-danger">*</sup></label>
							<input type="text" class="form-control" id="jadwal-semester" placeholder="Semester">
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label>SKS <sup class="text-danger">*</sup></label>
							<input type="number" class="form-control" id="jadwal-sks" placeholder="SKS">
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

<div class="modal fade" id="report-filter" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modalTite">Filter Berdasarkan Data</h5>
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label>Tahun Ajaran <sup class="text-danger">*</sup></label>
							<select id="tahun-id" class="form-control">
								<?php foreach($semua_tahun as $tahun): ?>
									<option value="<?= $tahun->ta_id ?>" <?=  ($tahun->ta_status == 'Aktif') ??  print 'selected'; ?> ><?= $tahun->ta_nama ?></option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<label>Pilih Prodi <sup class="text-danger">*</sup></label>
							<select id="prodi-id" class="form-control">
								<option value="all">Semua Prodi</option>
								<?php foreach($semua_prodi as $prodi): ?>
									<option value="<?= $prodi->prodi_id ?>"><?= $prodi->prodi_nama ?></option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer modal-footer-uniform">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
				<button type="button" class="btn btn-primary float-right" id="filter-jadwal">Filter</button>
			</div>
		</div>
	</div>
</div>
<!-- 
<div class="modal fade" id="modal-new-jadwal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
					<div class="col-md-4">
						<div class="form-group">
							<input type="hidden" id="jadwal-id">
							<label>Hari <sup class="text-danger">*</sup></label>
							<?php $hari = ['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu']; ?>
							<select id="jadwal-hari" class="form-control" disabled>
								<option value="">--Pilih Hari--</option>
								<?php foreach($hari as $i): ?>
									<option value="<?= $i ?>"><?= $i ?></option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label>Jam Masuk <sup class="text-danger">*</sup></label>
							<input type="time" class="form-control" id="jadwal-masuk" >
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label>Jam Keluar <sup class="text-danger">*</sup></label>
							<input type="time" class="form-control" id="jadwal-keluar" disabled>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<label>Ruang <sup class="text-danger">*</sup></label>
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
							<label>Mata Kuliah <sup class="text-danger">*</sup></label>
							<select id="mk-id" class="form-control">
								<option value="">--Pilih Mata Kuliah--</option>
								<?php foreach($mata_kuliah as $i): ?>
									<option value="<?= $i->mk_id ?>"><?= $i->mk_nama ?></option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<label>Dosen <sup class="text-danger">*</sup></label>
							<select id="dosen-id" class="form-control">
								<option value="">--Pilih Dosen--</option>
								<?php foreach($dosen as $i): ?>
									<option value="<?= $i->dosen_id ?>"><?= $i->dosen_nama ?></option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label>Kelas <sup class="text-danger">*</sup></label>
							<input type="text" class="form-control" id="jadwal-kelas" placeholder="Kelas">
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label>Semester <sup class="text-danger">*</sup></label>
							<input type="text" class="form-control" id="jadwal-semester" placeholder="Semester">
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label>SKS <sup class="text-danger">*</sup></label>
							<input type="number" class="form-control" id="jadwal-sks" placeholder="SKS">
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
 -->

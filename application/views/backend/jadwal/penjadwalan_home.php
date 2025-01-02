
			<div class="row">

				<div class="col-xl-12 col-12">
					<div class="box">
						<div class="box-body">
							<ul class="nav nav-tabs justify-content-center" role="tablist" id="tab-jadwal">
								<li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#palembang" role="tab"><span><i class="fa fa-calendar-check-o"></i></span> <span class="hidden-xs-down ml-15">Kampus Palembang</span></a> </li>
								<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#indralaya" role="tab"><span><i class="fa fa-clock-o"></i></span> <span class="hidden-xs-down ml-15">Kampus Indralaya</span></a> </li>
							</ul>
							<div class="tab-content">

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
														<th class="text-center" rowspan="2" width="10%">Ruang</th>
														<th class="text-center" rowspan="2">SKS</th>
														<th class="text-center" rowspan="2">Kelas</th>
														<th class="text-center" rowspan="2" width="30%">Mata Kuliah</th>
														<th class="text-center" rowspan="2">Kode</th>
														<th class="text-center" rowspan="2" width="30%">Nama Dosen</th>
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
						</div>
					</div>
				</div>
			</div>
<?php

<div class="content-wrapper">
	<div class="container-full">
		<div class="content-header">
			<div class="d-flex align-items-center justify-content-between">
				<div class="d-md-block d-none">
					<h3 class="page-title br-0">Dashboard</h3>
				</div>
			</div>
		</div>

		<section class="content">
			<div class="row">
				<div class="col-xl-12 col-12">
					<div class="card">
						<div class="card-header">
							<h4 class="card-title">Dashboard</h4>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-xl-5 col-md-12 col-12 mb-1 br-1">
									<canvas id="bar-chart1" height="145"></canvas>
								</div>
								<div class="col-xl-5 col-md-8 mb-1">
									<div class="row">
										<div class="col-xl-12 col-12">
											<canvas id="nested-pie" height="400" width="650" ></canvas>
										</div>
									</div>
								</div>
								<div class="col-xl-2 col-md-3 col-12 mb-1">
									<div class="box">
										<div class="box-header bg-gradient-fruit text-white text-center"><span class="font-size-20"><b>TOTAL</b></span></div>
										<div class="box-body text-center">
											<div class="mb-10" style="cursor: pointer;" onclick="window.open('<?= base_url('ruangan/gedung') ?>', '_blank');">
												<h1 class="font-size-40 text-primary"><i class="mdi mdi-file-document"></i></h1>
												<h2 class="mb-0 font-weight-700"><?= $total_gedung ?></h2>
												<span class="badge badge-pill badge-primary px-10 mt-2">Jumlah Gedung</span>
											</div>
											<hr>
											<div class="mb-10" style="cursor: pointer;" onclick="window.open('<?= base_url('ruangan/ruang') ?>', '_blank');">
												<h1 class="font-size-40 text-success"><i class="mdi mdi-file-document"></i></h1>
												<h2 class="mb-0 font-weight-700"><?= $total_ruang ?></h2>
												<span class="badge badge-pill badge-success px-10 mt-2">Jumlah Ruang</span>
											</div>
										</div>
									</div>

								</div>
							</div>
						</div>
					</div>
				</div>


				<div class="col-xl-12 col-12">
					<div class="box">
						<div class="box-body">
							<ul class="nav nav-tabs justify-content-center" role="tablist">
								<li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home12" role="tab"><span><i class="fa fa-calendar-check-o"></i></span> <span class="hidden-xs-down ml-15">Ruangan Aktif</span></a> </li>
								<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile12" role="tab"><span><i class="fa fa-clock-o"></i></span> <span class="hidden-xs-down ml-15">Ruangan Terjadwal</span></a> </li>
								<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#tab-peralatan" role="tab"><span><i class="fa fa-cogs"></i></span> <span class="hidden-xs-down ml-15">Peralatan</span></a> </li>
							</ul>
							<div class="tab-content tabcontent-border">
								<div class="tab-pane active" id="home12" role="tabpanel">
									<div class="p-15">
										<div class="row">
											<div class="col-md-12">
												<div class="card">
													<div class="box-header">
														<h4 class="box-title">MONITORING RUANGAN KELAS</h4>
														<ul class="box-controls pull-right">
															<li><span class="pt-1 mx-1 badge badge-danger" >RUSAK</span></li>
															<li><span class="pt-1 mx-1 badge badge-warning"  style="background:#c9b400 !important">TERISI</span></li>
															<li><span class="pt-1 mx-1 badge badge-success" >SEDANG DIGUNAKAN</span></li>
														</ul>
													</div>
													<div class="card-body">
														<div class="table-responsive ">
															<table class="table table-bordered" id="tableAktif">

															</table>
														</div>

														<div class="row">
															<div class="col-md-12 text-center">
																<div class="portfolio-item-wrap" id="svgfile">
																	<object data="" type="image/svg+xml" id="alphasvg"  height="700"></object>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>

									</div>
								</div>
								<div class="tab-pane" id="profile12" role="tabpanel">
									<div class="p-15">
										<div class="row">
											<div class="col-md-12">
												<div class="card">
													<div class="box-header">
														<h4 class="box-title">MONITORING RUANGAN KELAS</h4>
														<ul class="box-controls pull-right">
															<li><span class="pt-1 mx-1 badge badge-danger" >RUSAK</span></li>
															<li><span class="pt-1 mx-1 badge badge-warning"  style="background:#c9b400 !important">TERISI</span></li>
															<li><span class="pt-1 mx-1 badge badge-success" >SEDANG DIGUNAKAN</span></li>
														</ul>
													</div>
													<div class="card-body">

														<div class="table-responsive tableFixHead">
															<table class="table table-bordered ">
																<thead>
																<tr class="bg-primary">
																	<th rowspan="2" class="text-center">HARI/JAM</th>
																	<th rowspan="2" class="text-center">RUANG/LAB</th>

																	<?php foreach($jam as $i) : ?>
																		<th colspan="12" class="text-center"><?= $i; ?></th>
																	<?php endforeach; ?>
																</tr>
																<tr class="bg-primary">
																	<?php foreach($jam as $i) : ?>
																		<?php for($j=0;$j<12;$j++){ ?>
																			<th class="text-center"><?= $j * 5 ; ?></th>
																		<?php } ?>
																	<?php endforeach; ?>
																</tr>
																</thead>
																<tbody>
																<?php foreach($jadwalAktif as $i) :?>
																	<tr>
																		<td rowspan="<?= count($i['ruang'])?>" class="text-center bg-primary"><?= $i['hari'] ?></td>
																		<?php

																		?>
																		<td class="text-center <?= $i['ruang'][0]['ruang_status'] == 'Rusak' ? 'bg-danger' : 'bg-primary-1'?>"><?= $i['ruang'][0]['ruang_kode'] ?></td>
																		<?php foreach($i['ruang'][0]['jadwal']['timeline'] as $tl) :?>
																			<?= $tl ?>
																		<?php endforeach; ?>
																	</tr>

																	<?php for($rg=1;$rg<count($i['ruang']);$rg++) :?>
																		<tr>
																			<td class="text-center <?= $i['ruang'][$rg]['ruang_status'] == 'Rusak' ? 'bg-danger' : 'bg-primary-1'?>"><?= $i['ruang'][$rg]['ruang_kode'] ?></td>
																			<?php foreach($i['ruang'][$rg]['jadwal']['timeline'] as $tl) :?>
																				<?= $tl ?>
																			<?php endforeach; ?>
																		</tr>
																	<?php endfor; ?>
																<?php endforeach; ?>
																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="tab-pane" id="tab-peralatan" role="tabpanel">
									<div class="p-15">
										<div class="table-responsive">
											<table class="table table-bordered table-striped mytables">
												<thead>
												<tr>
													<th class="text-center" rowspan="2">NO</th>
													<th class="text-center" rowspan="2">JENIS</th>
													<th class="text-center" colspan="3">KONDISI</th>
												</tr>
												<tr>
													<th class="text-center">BAIK</th>
													<th class="text-center">SEDANG</th>
													<th class="text-center">BURUK</th>
												</tr>
												</thead>
												<tbody>
												<?php foreach($data_barang as $v => $i) :?>
													<tr>
														<td class="text-center"><?= ($v+1) ?></td>
														<td class="text-center"><?= $i['barang']->barang_nama ?></td>

														<?php foreach($i['detail'] as $x => $j) :?>
															<td class="text-center">
																<div class="d-flex justify-content-between">
																	<small><?= $j->barang_kondisi ?></small>
																	<div><?= round(($j->total/$i['barang']->total)*100,2) ?>% <i class="fa fa-level-up"></i></div>
																</div>
																<div class="progress progress-xs mt-0 mb-10">
																	<div class="progress-bar progress-bar-striped progress-bar-<?= $this->libunsripenjadwalan->getColorBarang($j->barang_kondisi); ?>" role="progressbar" aria-valuenow="<?= round(($j->total/$i['barang']->total)*100,2) ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= round(($j->total/$i['barang']->total)*100,2) ?>%">
																	</div>
																</div>
															</td>
														<?php endforeach; ?>
													</tr>

												<?php endforeach; ?>
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

			<!--  -->


		</section>
	</div>
</div>



<div class="modal fade" id="modalRuangKelas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modalTitle">Loading...</h5>
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row" id="appendDetailRuangKelas"></div>
			</div>
			<div class="modal-footer modal-footer-uniform">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

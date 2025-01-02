<div class="wrapper">
	<div class="art-bg">
		<img src="<?= images_url()?>art1.svg" alt="" class="art-img light-img">
		<img src="<?= images_url()?>art2.svg" alt="" class="art-img dark-img">
		<img src="<?= images_url()?>art-bg.svg" alt="" class="wave-img light-img">
		<img src="<?= images_url()?>art-bg2.svg" alt="" class="wave-img dark-img">
	</div>

	<header class="main-header">
		<div class="inside-header clearfix">
			<nav class="main-nav" role="navigation">
				<h2 class="nav-brand"><a href="<?= base_url()?>"><img src="<?= images_url('unsri.png')?>" class="max-w-50" alt="Logo"></a></h2>

				<button class="topbar-toggler" id="mobile_topbar_toggler"><i class="mdi mdi-dots-horizontal"></i></button>
				<input id="main-menu-state" type="checkbox" />
				<label class="main-menu-btn" for="main-menu-state">
					<span class="main-menu-btn-icon"></span> Toggle main menu visibility
				</label>

				<ul id="main-menu" class="sm sm-blue">
					<li><a href="<?= base_url()?>"  class="<?= $title == 'Dashboard' ? 'current' : '' ?>"><i class="ti-dashboard mx-5"></i>DASHBOARD</a></li>
					<li><a href="#" class="<?= $groupTitle == 'Data Jadwal' ? 'current' : '' ?>"><i class="ti-files mx-5"></i>Data Jadwal</a>
						<ul>
							<li><a href="<?= base_url('jadwal/tahun-ajaran')?>" class="<?= $title == 'Tahun Ajaran' ? 'current' : '' ?>">Set Tahun Ajar Aktif</a></li>
							<li><a href="<?= base_url('jadwal/penjadwalan')?>" class="<?= $title == 'Penjadwalan' ? 'current' : '' ?>">Penjadwalan</a></li>
							<li><a href="<?= base_url('jadwal/mata-kuliah')?>" class="<?= $title == 'Mata Kuliah' ? 'current' : '' ?>">Mata Kuliah</a></li>
						</ul>
					</li>
					<li><a href="#" class="<?= $groupTitle == 'Data Master' ? 'current' : '' ?>"><i class="ti-files mx-5"></i>Data Master</a>
						<ul>
							<li><a href="<?= base_url('master/fakultas')?>" class="<?= $title == 'Fakultas' ? 'current' : '' ?>">Fakultas</a></li>
							<li><a href="<?= base_url('master/jurusan')?>" class="<?= $title == 'Jurusan' ? 'current' : '' ?>">Jurusan</a></li>
							<li><a href="<?= base_url('master/prodi')?>" class="<?= $title == 'Prodi' ? 'current' : '' ?>">Prodi</a></li>
							<li><a href="<?= base_url('master/dosen')?>" class="<?= $title == 'Dosen' ? 'current' : '' ?>">Dosen</a></li>
							<li><a href="<?= base_url('master/user')?>" class="<?= $title == 'User' ? 'current' : '' ?>">User</a></li>
						</ul>
					</li>
					<li><a href="#" class="<?= $groupTitle == 'Data Ruangan' ? 'current' : '' ?>"><i class="fa fa-building mx-5"></i>Data Ruangan</a>
						<ul>
							<li><a href="<?= base_url('ruangan/gedung')?>" class="<?= $title == 'Gedung' ? 'current' : '' ?>">Gedung</a></li>
							<li><a href="<?= base_url('ruangan/ruang')?>" class="<?= $title == 'Ruang' ? 'current' : '' ?>">Ruang</a></li>
							<li><a href="<?= base_url('ruangan/barang')?>" class="<?= $title == 'Barang' ? 'current' : '' ?>">Barang</a></li>
						</ul>
					</li>
				</ul>
			</nav>
			<nav class="navbar navbar-static-top icon-topbar hmobile">	

				<div class="navbar-custom-menu r-side">
					<ul class="nav navbar-nav">
						<li class="dropdown user user-menu">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" title="User">
								<img src="<?= images_url('unsri.png')?>" class="user-image rounded-circle" alt="User Image">
							</a>
							<ul class="dropdown-menu animated flipInX">
								<li class="user-header bg-img" style="background-image: url('<?= backend_url('images/user-info.jpg')?>')" data-overlay="3">
									<div class="flexbox align-self-center">					  
										<img src="<?= images_url('unsri.png')?>" class="float-left rounded-circle" alt="User Image">					  
										<h4 class="user-name align-self-center">
											<span><?= $token['username'] ?></span><br>
											<small><?= $token['nama'] ?></small>
										</h4>
									</div>
								</li>
								<li class="user-body">
									<a class="dropdown-item" href="<?= base_url('logout')?>"><i class="ion-log-out"></i> Logout</a>
								</li>
							</ul>
						</li>					
						<li class="only-icon">
							<a href="#" data-provide="fullscreen" class="sidebar-toggle" title="Full Screen">
								<i class="mdi mdi-crop-free"></i>
							</a> 
						</li>
						<!-- <li>
							<a href="#" data-toggle="control-sidebar" title="Setting"><i class="fa fa-cog fa-spin"></i></a>
						</li> -->
					</ul>
				</div>
			</nav>
		</div>
	</header>  


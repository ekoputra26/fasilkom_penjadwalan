<footer class="main-footer">
	<div class="pull-right d-none d-sm-inline-block"></div>
	&copy; 2021. All Rights Reserved.
</footer>

<aside class="control-sidebar">

	<div class="rpanel-title"><span class="pull-right btn btn-circle btn-danger"><i class="ion ion-close text-white" data-toggle="control-sidebar"></i></span> </div>
	<div class="tab-content">
		<div class="tab-pane" id="control-sidebar-home-tab"></div>
	</div>
</aside>

<div class="control-sidebar-bg"></div>

</div>



<script src="<?= backend_url('assets/vendor_components/jquery-3.3.1/jquery-3.3.1.js')?>"></script>
<script src="<?= backend_url('assets/vendor_components/screenfull/screenfull.js')?>"></script>
<script src="<?= backend_url('assets/vendor_components/popper/dist/popper.min.js')?>"></script>
<script src="<?= backend_url('assets/vendor_components/bootstrap/dist/js/bootstrap.js')?>"></script>	
<script src="<?= backend_url('assets/vendor_components/moment/min/moment.min.js')?>"></script>
<script src="<?= backend_url('assets/vendor_components/bootstrap-daterangepicker/daterangepicker.js')?>"></script>
<script src="<?= backend_url('assets/vendor_components/jquery-slimscroll/jquery.slimscroll.js')?>"></script>
<script src="<?= backend_url('assets/vendor_components/fastclick/lib/fastclick.js')?>"></script>
<script src="<?= backend_url('assets/vendor_plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.js')?>"></script>
<script src="<?= backend_url('assets/vendor_components/jquery-toast-plugin-master/src/jquery.toast.js')?>"></script>
<script src="<?= backend_url('assets/vendor_components/datatable/datatables.min.js')?>"></script>
<script src="<?= backend_url('assets/vendor_components/select2/dist/js/select2.full.js')?>"></script>
	
<script src="<?= backend_url('js/sweetalert2@11.js')?>"></script>	
<script src="<?= backend_url('js/jquery.smartmenus.js')?>"></script>
<script src="<?= backend_url('js/menus.js')?>"></script>
<script src="<?= backend_url('js/template.js')?>"></script>
<script src="<?= backend_url('js/pages/voice-search.js')?>"></script>
<script src="<?= backend_url('js/demo.js')?>"></script>	
<script src="<?= backend_url('js/custom.js')?>"></script>	
<script type="text/javascript">
	let base_url = '<?= base_url()?>';
	let title = '<?= $title ?>';
</script>
<script src="<?= backend_url('js/custom/constant.js')?>"></script>
<script src="<?= backend_url('js/custom/action.js')?>"></script>
<?php
if (isset($ext_foot)) :
	foreach ($ext_foot as $ef) :
		echo $ef;
	endforeach;
endif;
?>
</body>
</html>

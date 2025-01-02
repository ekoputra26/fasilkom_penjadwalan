let routeUrl = routeRuang;

$(function(){
	get_data();
});

function dump_data(data){
	data = JSON.parse(data);
	let htm = '';
	
	for(i in data){
		htm += `
		<tr>
		<td>`+data[i].gedung_nama+`</td>
		<td class="text-center">`+data[i].ruang_kode+`</td>
		<td class="text-center">`+data[i].ruang_lantai+`</td>
		<td class="text-center">`+set_status(data[i].ruang_status)+`</td>
		<td class="text-center">`+data[i].ruang_jenis+`</td>
		<td class="text-center">`+data[i].ruang_latitude+`</td>
		<td class="text-center">`+data[i].ruang_longitude+`</td>
		<td>`+data[i].ruang_keterangan+`</td>
		<td class="text-center"><img src="`+base_url+"assets/uploads/ruang/"+data[i].ruang_qrcode+`" height="80px" onclick="loadQR('`+data[i].ruang_qrcode+`')"></img></td>
		<td class="text-center">
		<a href="#" class="btn btn-social  btn-warning " onclick="editRuang('`+data[i].ruang_id+`','`+data[i].gedung_id+`','`+data[i].ruang_kode+`','`+data[i].ruang_lantai+`','`+data[i].ruang_status+`','`+data[i].ruang_jenis+`','`+data[i].ruang_keterangan+`','`+data[i].ruang_latitude+`','`+data[i].ruang_longitude+`')" data-toggle="modal" data-target="#modalForm"  title="Edit" id="updateData">
		<i class="fa fa-pencil"></i>
		</a>
		<a href="#" class="btn btn-social  btn-danger " onclick="deleteData('`+data[i].ruang_id+`')" title="Delete">
		<i class="fa fa-trash"></i>
		</a>
		</td>
		</tr>
		`;
	}

	$('#mydata-tables').DataTable().destroy();
	$('#mydata-tables').find('tbody').html(htm);
	$('#mydata-tables').DataTable({
		"aLengthMenu": [
		[10, 25, 50, -1],
		[10, 25, 50, "All"]
		],
		"iDisplayLength": 10,
		"language": {
			search: ""
		}
	}).draw();
}

function loadQR(img){
	$("#ruang-imgQr").html(`<img src="`+base_url+"assets/uploads/ruang/"+img+`">`);
	$("#modalQR").modal('show');
}


$('#createData').click(function(){
	$('#modalTite').text('Add Data');
	$('#save_changes').data('action','create');
	$('#gedung-id').val('');
	$('#ruang-kode').val('');
	$('#ruang-lantai').val('');
	$('#ruang-status').val('');
	$('#ruang-keterangan').val('');		
	$('#ruang-jenis').val('');		
	$('#ruang-latitude').val('');		
	$('#ruang-longitude').val('');		
});

$('#save_changes').click(function(){
	let data = {
		ruang_id : $('#ruang-id').val(),
		gedung_id : $('#gedung-id').val(),
		ruang_kode : $('#ruang-kode').val(),
		ruang_lantai : $('#ruang-lantai').val(),
		ruang_status : $('#ruang-status').val(),
		ruang_keterangan : $('#ruang-keterangan').val(),
		ruang_jenis : $('#ruang-jenis').val(),
		ruang_latitude : $('#ruang-latitude').val(),
		ruang_longitude : $('#ruang-longitude').val()
	};

	if($('#save_changes').data('action') == 'create'){
		url = 'create_data';
	} else {
		url = 'update_data';
	}
	send_data(JSON.stringify(data),url)
});


function editRuang(id,gedung_id,kode,lantai,status,jenis,keterangan,latitude,longitude){
	$('#modalTite').text('Edit Data');
	$('#save_changes').data('action','update');
	$('#ruang-id').val(id);
	$('#gedung-id').val(gedung_id);
	$('#ruang-kode').val(kode);
	$('#ruang-lantai').val(lantai);
	$('#ruang-status').val(status);
	$('#ruang-keterangan').val(keterangan);
	$('#ruang-jenis').val(jenis);
	$('#ruang-latitude').val(latitude);
	$('#ruang-longitude').val(longitude);
}


$("#ruang-geolocation").click(function(){
	if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(showPosition);
		$("#ruang-text-geo").text('');
	} else { 
		$("#ruang-text-geo").text("Geolocation is not supported by this browser.");
	}
});

function showPosition(position) {
	$("#ruang-latitude").val(position.coords.latitude);
	$("#ruang-longitude").val(position.coords.longitude);
}
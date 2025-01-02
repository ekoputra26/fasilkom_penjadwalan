let routeUrl = routeGedung;

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
		<td>`+data[i].gedung_lokasi+`</td>
		<td>`+data[i].gedung_keterangan+`</td>
		<td class="text-center">
		<a href="#" class="btn btn-social  btn-warning " onclick="editGedung('`+data[i].gedung_id+`','`+data[i].gedung_nama+`','`+data[i].gedung_lokasi+`','`+data[i].gedung_keterangan+`')" data-toggle="modal" data-target="#modalForm"  title="Edit" id="updateData">
		<i class="fa fa-pencil"></i>
		</a>
		<a href="#" class="btn btn-social  btn-danger " onclick="deleteData('`+data[i].gedung_id+`')" title="Delete">
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


$('#createData').click(function(){
	$('#modalTite').text('Add Data');
	$('#save_changes').data('action','create');
	$('#gedung-nama').val('');
	$('#gedung-lokasi').val('');
	$('#gedung-keterangan').val('');
});

$('#save_changes').click(function(){
	let data = {
		gedung_id : $('#gedung-id').val(),
		gedung_nama : $('#gedung-nama').val(),
		gedung_lokasi : $('#gedung-lokasi').val(),
		gedung_keterangan : $('#gedung-keterangan').val()
	};

	if($('#save_changes').data('action') == 'create'){
		url = 'create_data';
	} else {
		url = 'update_data';
	}
	send_data(JSON.stringify(data),url)
});


function editGedung(id,nama,lokasi,keterangan){
	$('#modalTite').text('Edit Data');
	$('#save_changes').data('action','update');
	$('#gedung-id').val(id);
	$('#gedung-nama').val(nama);
	$('#gedung-lokasi').val(lokasi);
	$('#gedung-keterangan').val(keterangan);
}
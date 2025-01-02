let routeUrl = routeMataKuliah;

$(function(){
	get_data();
});

function dump_data(data){
	data = JSON.parse(data);
	let htm = '';
	
	for(i in data){
		htm += `
		<tr>
		<td class="text-center">`+(parseInt(i)+1)+`</td>
		<td class="text-center">`+data[i].prodi_nama+`</td>
		<td class="text-center">`+data[i].mk_kode+`</td>
		<td class="text-center">`+data[i].mk_nama+`</td>
		<td class="text-center">
		<a href="#" class="btn btn-social  btn-warning " onclick="editMataKuliah('`+data[i].mk_id+`','`+data[i].prodi_id+`','`+data[i].mk_kode+`','`+data[i].mk_nama+`')" data-toggle="modal" data-target="#modalForm"  title="Edit" id="updateData">
		<i class="fa fa-pencil"></i>
		</a>
		<a href="#" class="btn btn-social  btn-danger " onclick="deleteData('`+data[i].mk_id+`')" title="Delete">
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
	$('#prodi-id').val('');
	$('#mk-kode').val('');
	$('#mk-nama').val('');
});

$('#save_changes').click(function(){
	let data = {
		mk_id : $('#mk-id').val(),
		prodi_id : $('#prodi-id').val(),
		mk_kode : $('#mk-kode').val(),
		mk_nama : $('#mk-nama').val(),
	};

	if($('#save_changes').data('action') == 'create'){
		url = 'create_data';
	} else {
		url = 'update_data';
	}
	send_data(JSON.stringify(data),url)
});


function editMataKuliah(id,prodi_id,kode,nama){
	$('#modalTite').text('Edit Data');
	$('#save_changes').data('action','update');
	$('#mk-id').val(id);
	$('#prodi-id').val(prodi_id);
	$('#mk-kode').val(kode);
	$('#mk-nama').val(nama);
}
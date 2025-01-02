let routeUrl = routeJurusan;

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
		<td class="text-center">`+data[i].fakultas_nama+`</td>
		<td class="text-center">`+data[i].jurusan_nama+`</td>
		<td class="text-center">
		<a href="#" class="btn btn-social  btn-warning " onclick="editJurusan('`+data[i].jurusan_id+`','`+data[i].fakultas_id+`','`+data[i].jurusan_nama+`')" data-toggle="modal" data-target="#modalForm"  title="Edit" id="updateData">
		<i class="fa fa-pencil"></i>
		</a>
		<a href="#" class="btn btn-social  btn-danger " onclick="deleteData('`+data[i].jurusan_id+`')" title="Delete">
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
	$('#fakultas-id').val('');
	$('#jurusan-nama').val('');
});

$('#save_changes').click(function(){
	let data = {
		jurusan_id : $('#jurusan-id').val(),
		fakultas_id : $('#fakultas-id').val(),
		jurusan_nama : $('#jurusan-nama').val(),
	};

	if($('#save_changes').data('action') == 'create'){
		url = 'create_data';
	} else {
		url = 'update_data';
	}
	send_data(JSON.stringify(data),url)
});


function editJurusan(id,fakultas_id,nama){
	$('#modalTite').text('Edit Data');
	$('#save_changes').data('action','update');
	$('#jurusan-id').val(id);
	$('#fakultas-id').val(fakultas_id);
	$('#jurusan-nama').val(nama);
}
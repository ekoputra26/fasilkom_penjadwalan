let routeUrl = routeFakultas;

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
		<td class="text-center">
		<a href="#" class="btn btn-social  btn-warning " onclick="editFakultas('`+data[i].fakultas_id+`','`+data[i].fakultas_nama+`')" data-toggle="modal" data-target="#modalForm"  title="Edit" id="updateData">
		<i class="fa fa-pencil"></i>
		</a>
		<a href="#" class="btn btn-social  btn-danger " onclick="deleteData('`+data[i].fakultas_id+`')" title="Delete">
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
	$('#fakultas-nama').val('');
});

$('#save_changes').click(function(){
	let data = {
		fakultas_id : $('#fakultas-id').val(),
		fakultas_nama : $('#fakultas-nama').val(),
	};

	if($('#save_changes').data('action') == 'create'){
		url = 'create_data';
	} else {
		url = 'update_data';
	}
	send_data(JSON.stringify(data),url)
});


function editFakultas(id,nama){
	$('#modalTite').text('Edit Data');
	$('#save_changes').data('action','update');
	$('#fakultas-id').val(id);
	$('#fakultas-nama').val(nama);
}

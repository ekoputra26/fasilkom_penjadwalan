let routeUrl = routeTahunAjaran;

$(function(){
	get_data();
});

function dump_data(data){
	data = JSON.parse(data);
	let htm = '';
	
	for(i in data){
		htm += `
		<tr>
		<td class="text-center">`+data[i].ta_nama+`</td>
		<td class="text-center">`+set_status(data[i].ta_status)+`</td>
		<td class="text-center">
		<a href="#" class="btn btn-social  btn-warning " onclick="editTahunAjaran('`+data[i].ta_id+`','`+data[i].ta_nama+`','`+data[i].ta_status+`')" data-toggle="modal" data-target="#modalForm"  title="Edit" id="updateData">
		<i class="fa fa-pencil"></i>
		</a>
		<a href="#" class="btn btn-social  btn-danger " onclick="deleteData('`+data[i].ta_id+`')" title="Delete">
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
	$('#ta-nama').val('');
	$('#ta-status').val('');
});

$('#save_changes').click(function(){
	let data = {
		ta_id : $('#ta-id').val(),
		ta_nama : $('#ta-nama').val(),
		ta_status : $('#ta-status').val(),
	};

	if($('#save_changes').data('action') == 'create'){
		url = 'create_data';
	} else {
		url = 'update_data';
	}
	send_data(JSON.stringify(data),url)
});


function editTahunAjaran(id,nama,status){
	$('#modalTite').text('Edit Data');
	$('#save_changes').data('action','update');
	$('#ta-id').val(id);
	$('#ta-nama').val(nama);
	$('#ta-status').val(status);
}
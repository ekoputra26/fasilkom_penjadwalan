let routeUrl = routeProdi;

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
		<td class="text-center">`+data[i].jurusan_nama+`</td>
		<td class="text-center">`+data[i].prodi_nama+`</td>
		<td class="text-center"><label class="badge" style="width:50px;height:20px;background:`+data[i].prodi_warna+`"></label></td>
		<td class="text-center">
		<a href="#" class="btn btn-social  btn-warning " onclick="editProdi('`+data[i].prodi_id+`','`+data[i].jurusan_id+`','`+data[i].prodi_nama+`','`+data[i].prodi_warna+`')" data-toggle="modal" data-target="#modalForm"  title="Edit" id="updateData">
		<i class="fa fa-pencil"></i>
		</a>
		<a href="#" class="btn btn-social  btn-danger " onclick="deleteData('`+data[i].prodi_id+`')" title="Delete">
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
	$('#jurusan-id').val('');
	$('#prodi-nama').val('');
	$('#prodi-warna').val('');
});

$('#save_changes').click(function(){
	let data = {
		prodi_id : $('#prodi-id').val(),
		jurusan_id : $('#jurusan-id').val(),
		prodi_nama : $('#prodi-nama').val(),
		prodi_warna : $('#prodi-warna').val(),
	};

	if($('#save_changes').data('action') == 'create'){
		url = 'create_data';
	} else {
		url = 'update_data';
	}
	send_data(JSON.stringify(data),url)
});


function editProdi(id,jurusan_id,nama,warna){
	$('#modalTite').text('Edit Data');
	$('#save_changes').data('action','update');
	$('#prodi-id').val(id);
	$('#jurusan-id').val(jurusan_id);
	$('#prodi-nama').val(nama);
	$('#prodi-warna').val(warna);
}
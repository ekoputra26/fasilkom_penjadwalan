let routeUrl = routeDosen;

$(function(){
	get_data();
});

function dump_data(data){
	data = JSON.parse(data);
	let htm = '';
	
	for(i in data){
		htm += `
		<tr>
		<td>`+data[i].dosen_nip+`</td>
		<td>`+data[i].dosen_nama+`</td>
		<td>`+data[i].prodi_nama+`</td>
		<td>`+data[i].dosen_jabfung+`</td>
		<td>`+data[i].dosen_jabatan+`</td>
		<td>`+data[i].dosen_golongan+`</td>
		<td class="text-center">
		<a href="#" class="btn btn-social  btn-warning " onclick="editDosen('`+data[i].dosen_id+`','`+data[i].dosen_nip+`','`+data[i].dosen_nama+`','`+data[i].prodi_id+`','`+data[i].dosen_jabfung+`','`+data[i].dosen_jabatan+`','`+data[i].dosen_golongan+`')" data-toggle="modal" data-target="#modalForm"  title="Edit" id="updateData">
		<i class="fa fa-pencil"></i>
		</a>
		<a href="#" class="btn btn-social  btn-danger " onclick="deleteData('`+data[i].dosen_id+`')" title="Delete">
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
	$('#dosen-nama').val('');
	$('#dosen-nip').val('');
	$('#prodi-id').val('');
	$('#dosen-jabfung').val('');
	$('#dosen-jabatan').val('');
	$('#dosen-golongan').val('');
});

$('#save_changes').click(function(){
	let data = {
		dosen_id : $('#dosen-id').val(),
		dosen_nama : $('#dosen-nama').val(),
		dosen_nip : $('#dosen-nip').val(),
		dosen_golongan : $('#dosen-golongan').val(),
		dosen_jabfung : $('#dosen-jabfung').val(),
		dosen_jabatan : $('#dosen-jabatan').val(),
		prodi_id : $('#prodi-id').val(),
	};

	if($('#save_changes').data('action') == 'create'){
		url = 'create_data';
	} else {
		url = 'update_data';
	}
	send_data(JSON.stringify(data),url)
});


function editDosen(id,nip,nama,prodi_id,jabfung,jabatan,golongan){
	$('#modalTite').text('Edit Data');
	$('#save_changes').data('action','update');
	$('#dosen-id').val(id);
	$('#dosen-nama').val(nama);
	$('#dosen-nip').val(nip);
	$('#prodi-id').val(prodi_id);
	$('#dosen-jabfung').val(jabfung);
	$('#dosen-jabatan').val(jabatan);
	$('#dosen-golongan').val(golongan);
}

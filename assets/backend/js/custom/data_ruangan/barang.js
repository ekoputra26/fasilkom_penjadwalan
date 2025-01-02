let routeUrl = routeBarang;

$(function(){
	get_data();
});

function dump_data(data){
	data = JSON.parse(data);
	let htm = '';
	
	for(i in data){
		htm += `
		<tr>
		<td>`+data[i].ruang_kode+`</td>
		<td class="text-center">`+data[i].barang_nama+`</td>
		<td class="text-center">`+data[i].barang_nup+`</td>
		<td class="text-center">`+data[i].barang_merek+`</td>
		<td class="text-center">`+set_status_barang(data[i].barang_kondisi)+`</td>
		<td>`+data[i].barang_keterangan+`</td>
		<td class="text-center">
		<a href="#" class="btn btn-social  btn-warning " onclick="editBarang('`+data[i].barang_id+`','`+data[i].ruang_id+`','`+data[i].barang_nama+`','`+data[i].barang_nup+`','`+data[i].barang_merek+`','`+data[i].barang_kondisi+`','`+data[i].barang_keterangan+`')" data-toggle="modal" data-target="#modalForm"  title="Edit" id="updateData">
		<i class="fa fa-pencil"></i>
		</a>
		<a href="#" class="btn btn-social  btn-danger " onclick="deleteData('`+data[i].barang_id+`')" title="Delete">
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
	$('#ruang-id').val('');
	$('#barang-nama').val('');
	$('#barang-nup').val('');
	$('#barang-merek').val('');
	$('#barang-kondisi').val('');
	$('#barang-keterangan').val('');	
});

$('#save_changes').click(function(){
	let data = {
		barang_id : $('#barang-id').val(),
		ruang_id : $('#ruang-id').val(),
		barang_nama : $('#barang-nama').val(),
		barang_nup : $('#barang-nup').val(),
		barang_merek : $('#barang-merek').val(),
		barang_kondisi : $('#barang-kondisi').val(),
		barang_keterangan : $('#barang-keterangan').val()
	};

	if($('#save_changes').data('action') == 'create'){
		url = 'create_data';
	} else {
		url = 'update_data';
	}
	send_data(JSON.stringify(data),url)
});


function editBarang(id,ruang_id,nama,nup,merek,kondisi,keterangan){
	$('#modalTite').text('Edit Data');
	$('#save_changes').data('action','update');
	$('#barang-id').val(id);
	$('#ruang-id').val(ruang_id);
	$('#barang-nama').val(nama);
	$('#barang-nup').val(nup);
	$('#barang-merek').val(merek);
	$('#barang-kondisi').val(kondisi);
	$('#barang-keterangan').val(keterangan);
}

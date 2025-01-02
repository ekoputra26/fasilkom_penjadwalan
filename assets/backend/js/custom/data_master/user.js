let routeUrl = routeUser;

$(function(){
	get_data();
	getFakultas();
});

function dump_data(data){
	data = JSON.parse(data);
	let htm = '';
	for(i in data){
		if(data[i].prodi_nama != null){
			prodi_nama = data[i].prodi_nama;
		} else {
			prodi_nama = '';
		}
		htm += `
		<tr>
		<td>`+data[i].user_nama+`</td>
		<td>`+data[i].user_username+`</td>
		<td>`+prodi_nama+`</td>
		<td>`+data[i].user_role+`</td>
		<td class="text-center">
		<a href="#" class="btn btn-social  btn-warning " onclick="editUser('`+data[i].user_id+`','`+data[i].user_nama+`','`+data[i].user_username+`','`+data[i].user_role+`','`+data[i].prodi_id+`','`+data[i].fakultas_id+`','`+data[i].jurusan_id+`')" data-toggle="modal" data-target="#modalForm"  title="Edit" id="updateData">
		<i class="fa fa-pencil"></i>
		</a>
		<a href="#" class="btn btn-social  btn-danger " onclick="deleteData('`+data[i].user_id+`')" title="Delete">
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
	$('#user-nama').val('');
	$('#user-role').val('');
	$('#user-username').val('');
	$('#user-fakultas').val('').trigger('change');
	$('#user-jurusan').val('').trigger('change');
	$('#user-prodi').val('').trigger('change');
});

$('#save_changes').click(function(){
	let data = {
		user_id : $('#user-id').val(),
		user_nama : $('#user-nama').val(),
		user_role : $('#user-role').val(),
		user_username : $('#user-username').val(),
		user_password : $('#user-password').val(),
		user_repassword : $('#user-repassword').val(),
		prodi_id : $('#user-prodi').val(),
	};

	if($('#user-role').val() == 'Prodi' && $('#user-prodi').val() == ''){
		$.toast({
			heading: 'Error',
			text: 'Silahkan isi prodi terlebih dahulu',
			showHideTransition: 'plain',
			position: 'top-right',
			hideAfter: 2000, 
			icon: 'error'
		});
	} else {
		if($('#save_changes').data('action') == 'create'){
			url = 'create_data';
		} else {
			url = 'update_data';
		}
		send_data(JSON.stringify(data),url)
	}
});


function editUser(id,nama,username,role,prodi,fakultas,jurusan){
	$('#modalTite').text('Edit Data');
	$('.info-pass').text('*Kosongkan jika tidak ingin mengganti password');
	$('#save_changes').data('action','update');
	$('#user-id').val(id);
	$('#user-nama').val(nama);
	$('#user-role').val(role);
	$('#user-username').val(username);
	$('#user-password').val('');
	$('#user-repassword').val('');
	nestedGet(prodi,fakultas,jurusan);
}

function nestedGet(prodi,fakultas,jurusan){
	/*$('#user-fakultas').val(fakultas).trigger('change');
	$('#user-jurusan').val(jurusan).trigger('change');
	$('#user-prodi').val(prodi).trigger('change');*/
}

$("#user-fakultas").change(function(){
	let fakultas_id = $(this).val();
	getJurusan(fakultas_id);
});

$("#user-jurusan").change(function(){
	let jurusan_id = $(this).val();
	getProdi(jurusan_id);
});



function getFakultas(){
	$.post({
		url : routeFakultas + "get_data",
		cache :true,
		success: function (data) {
			data = JSON.parse(data);
			let htm = '<option value="">--Pilih Fakultas--</option>';
			for(i in data){
				htm+=`
				<option value="${data[i].fakultas_id}">${data[i].fakultas_nama}</option>
				`;
			}
			$("#user-fakultas").html(htm);
		},
		error: function (response) {
			console.log("Error in fetching data");
		}
	})
	.fail(function(data){
		console.log("Fail in fetching data");
	});
}


function getJurusan(fakultas_id){
	if(fakultas_id  != ''){
		$("#user-jurusan").attr('disabled',false);
	} else {
		$("#user-jurusan").attr('disabled',true);
	}
	$.post({
		url : routeJurusan + "get_data_by",
		data:{fakultas_id:fakultas_id},
		cache :true,
		success: function (data) {
			data = JSON.parse(data);
			let htm = '<option value="">--Pilih Jurusan--</option>';
			for(i in data){
				htm+=`
				<option value="${data[i].jurusan_id}">${data[i].jurusan_nama}</option>
				`;
			}
			$("#user-jurusan").html(htm);
		},
		error: function (response) {
			console.log("Error in fetching data");
		}
	})
	.fail(function(data){
		console.log("Fail in fetching data");
	});
}
function getProdi(jurusan_id){
	if(jurusan_id  != ''){
		$("#user-prodi").attr('disabled',false);
	} else {
		$("#user-prodi").attr('disabled',true);
	}
	$.post({
		url : routeProdi + "get_data_by",
		data:{jurusan_id:jurusan_id},
		cache :true,
		success: function (data) {
			data = JSON.parse(data);
			let htm = '<option value="">--Pilih Prodi--</option>';
			for(i in data){
				htm+=`
				<option value="${data[i].prodi_id}">${data[i].prodi_nama}</option>
				`;
			}
			$("#user-prodi").html(htm);
		},
		error: function (response) {
			console.log("Error in fetching data");
		}
	})
	.fail(function(data){
		console.log("Fail in fetching data");
	});
}
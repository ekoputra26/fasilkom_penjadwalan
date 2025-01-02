let routeUrl = routeHome;
var calendar = {};
var reportCalendar = {};
var newEvent = {};
var reportApiUrl = '/backend/jadwal/penjadwalan/get_jadwal_perprodi?';
let activeTab = '#palembang';
$(function(){
	get_data_jadwal_home(activeTab);

	$("select").on("select2:select", function (evt) {
		var element = evt.params.data.element;
		var $element = $(element);
		$element.detach();
		$(this).append($element);
		$(this).trigger("change");
	});

});
function dump_data(data){
	data = JSON.parse(data);
	let htm = '';
	for(i in data){
		htm += `
		<tr>
		<td class="text-center">`+data[i]['jadwal'].jadwal_hari+`</td>
		<td class="text-center">`+data[i]['jadwal'].jadwal_jam_masuk+`</td>
		<td class="text-center">`+data[i]['jadwal'].jadwal_jam_keluar+`</td>
		<td class="text-center">`+data[i]['jadwal'].ruang_kode+`</td>
		<td class="text-center">`+data[i]['jadwal'].jadwal_sks+`</td>
		<td class="text-center">`+data[i]['jadwal'].jadwal_kelas+`</td>
		<td class="text-center">`+data[i]['jadwal'].mk_nama+`</td>
		<td class="text-center">`+data[i]['jadwal'].mk_kode+`</td>
		<td class="text-left">`;

		for(j in data[i]['dosen']){
			htm+=`${data[i]['dosen'][j].dosen_nama};`;
		}
		/*<a href="#" class="btn btn-social  btn-warning " onclick="editJadwal('`+data[i]['jadwal'].jadwal_id+`','`+data[i]['jadwal'].jadwal_hari+`','`+data[i]['jadwal'].jadwal_jam_masuk+`','`+data[i]['jadwal'].jadwal_jam_keluar+`','`+data[i]['jadwal'].ruang_id+`','`+data[i]['jadwal'].jadwal_sks+`','`+data[i]['jadwal'].jadwal_semester+`','`+data[i]['jadwal'].jadwal_kelas+`','`+data[i]['jadwal'].mk_id+`','`+data[i]['jadwal'].dosen_id+`')" data-toggle="modal" data-target="#modalForm"  title="Edit" id="updateData">
		<i class="fa fa-pencil"></i>
		</a>*/
		htm+=`</td>
		</tr>
		`;
	}


	$('#mydata-tables').DataTable().destroy();
	$('#mydata-tables').find('tbody').html(htm);
	$('#mydata-tables').DataTable({
		order: [[0, 'desc'], [1, 'asc']],
		"aLengthMenu": [
			[10, 25, 50, -1],
			[10, 25, 50, "All"]
		],
		"iDisplayLength": 100,
		"language": {
			search: ""
		}
	}).draw();
}
function resetJadwalForm() {
	newEvent = {};
	$('#jadwal-id').val('');
	$('#jadwal-hari').val('');
	$('#jadwal-masuk').val('');
	$('#jadwal-keluar').val('');
	$('#ruang-id').val('');
	$('#mk-id').val('');
	$('#dosen-id').val('');
	$('#jadwal-kelas').val('');
	$('#jadwal-semester').val('');
	$('#jadwal-sks').val('');
}
$('#filter-jadwal').click(function () {
	var namaProdi = $( "#prodi-id option:selected" ).text();
	var prodiId = $( "#prodi-id" ).val();
	var namaTa = $( "#tahun-id option:selected" ).text();
	var taId = $( "#tahun-id" ).val();
	reportCalendar.removeAllEventSources();
	reportCalendar.addEventSource(getReportEventSource(`prodi=${prodiId}&ta=${taId}`));
	$('#judul-filter').text(`Filter Jadwal Berdasarkan Prodi ${namaProdi} dan Tahun Ajaran ${namaTa}`);
});
$('#save_changes').click(function(){
	let data = {
		jadwal_id:$('#jadwal-id').val(),
		jadwal_hari:$('#jadwal-hari').val(),
		jadwal_masuk:$('#jadwal-masuk').val(),
		jadwal_keluar:$('#jadwal-keluar').val(),
		ruang_id:$('#ruang-id').val(),
		mk_id:$('#mk-id').val()[0],
		dosen_id:$('#dosen-id').val(),
		jadwal_kelas:$('#jadwal-kelas').val(),
		jadwal_semester:$('#jadwal-semester').val(),
		jadwal_sks:$('#jadwal-sks').val()
	};
	if($('#save_changes').data('action') == 'create'){
		url = 'create_data';
	} else {
		url = 'update_data';
	}
	send_data_jadwal(JSON.stringify(data),url);
	$('#div-calender').html('');
	$('#div-calender').append(`<div id='calendar'></div>`);
	$('#tab-jadwal a[href="'+activeTab+'"]').trigger('click');
});
function editJadwal(jadwal_id,jadwal_hari,jadwal_jam_masuk,jadwal_jam_keluar,ruang_id,jadwal_sks,jadwal_semester,jadwal_kelas,mk_id,dosen_id){
	$('#modalTite').text('Edit Data');
	$('#save_changes').data('action','update');
	$('#jadwal-id').val(jadwal_id);
	$('#jadwal-hari').val(jadwal_hari);
	$('#jadwal-masuk').val(jadwal_jam_masuk);
	$('#jadwal-keluar').val(jadwal_jam_keluar);
	$('#ruang-id').val(ruang_id);
	$('#mk-id').val(mk_id);
	$('#dosen-id').val(dosen_id);
	$('#jadwal-kelas').val(jadwal_kelas);
	$('#jadwal-semester').val(jadwal_semester);
	$('#jadwal-sks').val(jadwal_sks);
}
$('#tab-jadwal').on("click", "li", function (event) {
	activeTab = $(this).find('a').attr('href');
	$('#div-calender').html('');
	$('#div-calender').append(`<div id='calendar'></div>`);
	get_data_jadwal_home(activeTab);
});


function editTanggal(id,start,end,ruangan){
	$.post({
		url : base_url+'backend/jadwal/penjadwalan/editTanggal',
		data:{id:id,start:moment(start).format("HH:mm"),end:moment(end).format("HH:mm"),hari:getHariIndex(start.getDay()), ruangan:ruangan},
		success: function (data) {
			data = JSON.parse(data);
			$.toast({
				heading: data.info,
				text: data.text,
				showHideTransition: 'plain',
				position: 'top-right',
				hideAfter: 2000,
				icon: data.info
			});
			if(data.info == 'error'){
				$('#div-calender').html('');
				$('#div-calender').append(`<div id='calendar'></div>`);
				$('#tab-jadwal a[href="'+activeTab+'"]').trigger('click');
			}
		},
		error: function (response) {
			console.log("Error in fetching data");
		}
	})
		.fail(function(data){
			console.log("Fail in fetching data");
		});
}
function parseEventData(data) {
	return data.map(jadwal=>{
		let dosen = jadwal.dosen.map(dosen=>dosen.dosen_nama).join(', ');
		let stringInfo = `Matkul: ${jadwal.mk_nama}  Lokasi: ${jadwal.gedung_nama}  Ruangan: ${jadwal.ruang_kode} Dosen: ${dosen} ` ;
		return {
			id : jadwal.jadwal_id,
			startTime: jadwal.jadwal_jam_masuk,
			endTime: jadwal.jadwal_jam_keluar,
			s: jadwal.prodi_id,
			daysOfWeek: [hariToNumber(jadwal.jadwal_hari)],
			title : stringInfo,
			extendedProps: {
				jadwal : jadwal
			},

		}
	})
}
function getReportEventSource(filter) {
	filter = filter ? filter : 'prodi=all';
	return function (fetchInfo, successCallback, failureCallback) {
		$.get({
			url: reportApiUrl + filter,
			success: function (data) {
				successCallback(parseEventData(JSON.parse(data)));
			},
			error: function (response) {
				failureCallback("Error in fetching data");
			}
		}).always(()=>$('#report-filter').modal('hide'))
	}
}

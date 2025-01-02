$(function(){
	$('.select2').select2();
})

function set_status(val){
	let htm = '';
	if(val == 'Baik' || val == 'Aktif'){
		htm = `<span class="badge badge-success">`+val+`</span>`;
	} else if(val == 'Rusak' || val == 'Tidak Aktif'){
		htm = `<span class="badge badge-danger">`+val+`</span>`;
	} else {
		htm = `<span class="badge badge-secondary">`+val+`</span>`;
	}

	return htm;
}
function set_status_barang(val){
	let htm = '';
	if(val == 'Baik'){
		htm = `<span class="badge badge-success">`+val+`</span>`;
	} else if(val == 'Sedang'){
		htm = `<span class="badge badge-info">`+val+`</span>`;
	} else {
		htm = `<span class="badge badge-danger">`+val+`</span>`;
	}

	return htm;
}

function getRandomColor() {
	var letters = '0123456789ABCDEF';
	var color = '#';
	for (var i = 0; i < 6; i++) {
		color += letters[Math.floor(Math.random() * 16)];
	}
	return color;
}


/*
function createOption(value, text) {
	var option = document.createElement('option');
	option.text = text;
	option.value = value;
	return option;
}

var hourSelect = document.getElementById('do-hours');
for(var i = 8; i <= 18; i++){
	hourSelect.add(createOption(i, i));
}

var minutesSelect = document.getElementById('do-minutes');
for(var i = 0; i < 60; i += 15) {
	minutesSelect.add(createOption(i, i));
}*/

function getHariIndex(idx) {
	return ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'][idx];
}

function hariToNumber(hari) {
	var obj = {
		Senin : 1,
		Selasa : 2,
		Rabu : 3,
		Kamis : 4,
		Jumat : 5,
	};
	return obj[hari];
}


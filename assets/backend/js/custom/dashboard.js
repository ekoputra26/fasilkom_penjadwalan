let routeUrl = routeDashboard;
$(function(){
	get_data();
})


$(function jadwalAktif(){
	$.post({
		url : routeUrl + "getJadwalAktif",
		cache :true,
		success: function (data) {
			data = JSON.parse(data);
			let jam = data.jam;
			let jadwal = data.jadwal;
			let htm = '';
			htm +=`
			<thead>
			<tr class="bg-dark">
			<th rowspan="2" class="text-center">HARI/JAM</th>
			<th rowspan="2" class="text-center">RUANG/LAB</th>`;

			for(i in jam){
				htm+=`<th colspan="12" class="text-center">${jam[i]}</th>`;
			}
			htm+=`</tr>
			<tr class="bg-dark">`;

			for(i in jam){
				for(j=0;j<12;j++){ 
					htm+=`<th class="text-center">${(j * 5)}</th>`;
				}
			}
			htm+=`</tr>
			</thead>
			<tbody>
			`;
			for(i in jadwal){
				htm+=`<tr>
				<td rowspan="${jadwal[i].ruang.length}" class="text-center bg-primary">${jadwal[i].hari}</td>
				<td class="text-center ${jadwal[i].ruang[0].ruang_status == 'Rusak' ? 'bg-danger' : 'bg-primary-1'}">${jadwal[i].ruang[0].ruang_kode}</td>`;
				for(tl in jadwal[i].ruang[0].jadwal.timeline){
					htm+= jadwal[i].ruang[0].jadwal.timeline[tl];
				}
				htm+=`</tr>`;
				for(rg=1;rg<jadwal[i].ruang.length;rg++) {
					htm+=`<tr>
					<td class="text-center ${jadwal[i].ruang[rg].ruang_status == 'Rusak' ? 'bg-danger' : 'bg-primary-1'}">${ jadwal[i].ruang[rg].ruang_kode }</td>`;
					for(tl in jadwal[i].ruang[rg].jadwal.timeline) {
						htm+= jadwal[i].ruang[rg].jadwal.timeline[tl];
					}
					htm+=`</tr>`;
				}
			}
			htm+=`</tbody>`;
			$('#tableAktif').html(htm);
			setTimeout(jadwalAktif, 10000);
		},
		error: function (response) {
			console.log("Error in fetching data");
		}
	})
	.fail(function(data){
		console.log("Fail in fetching data");
	});


});

function dump_data(data){
	data = JSON.parse(data);
	barChart(JSON.stringify(data.grafikJenisRuang));
	pieChart(JSON.stringify(data.totalRuang),JSON.stringify(data.grafikStatusRuang),JSON.stringify(data.grafikKodisiRuang));
}

function barChart(jenis){
	jenis = JSON.parse(jenis);

	let labelData = [];
	let colorData = [];
	let totalData = [];
	for(i in jenis){
		labelData.push(jenis[i].ruang_jenis);
		totalData.push(jenis[i].total);
		colorData.push(getRandomColor());
	}
	new Chart(document.getElementById("bar-chart1"), {
		type: 'bar',
		data: {
			labels: labelData,
			datasets: [
			{
				label: "Dataset",
				backgroundColor: colorData,
				data: totalData
			}
			]
		},
		options: {
			legend: { display: false },
			title: {
				display: true,
				text: 'Jenis Ruangan'
			},
			scales: {
				yAxes: [{
					ticks: {
						beginAtZero: true
					}
				}]
			}
		}
	});
}

function pieChart(totalRuang,statusRuang,kondisiRuang){
	totalRuang =  JSON.parse(totalRuang);
	statusRuang =  JSON.parse(statusRuang);
	kondisiRuang =  JSON.parse(kondisiRuang);

	let dataRuang = [];
	let colorData = [];
	let dataTotal = [];
/*	ee1044 rusak
	8bc34a baik
	cbcbcb n/a
	ffd53b kosong
	00bcd4 terisi

	if(statusRuang[1].total > 0){

	}
*/
	var nestedChart = echarts.init(document.getElementById('nested-pie'));
	option = {
		tooltip: {
			trigger: 'item',
			formatter: '{a} <br/>{b}: {c} ({d}%)'
		},
		legend: {
			data: [
			'Rusak',
			'Baik',
			'Kosong',
			'Terisi',
			'N/A',
			]
		},
		color: ['#ee1044', '#8bc34a', '#cbcbcb', '#ffd53b', '#00bcd4'],
		series: [
		{
			name: 'Status Ruangan',
			type: 'pie',
			selectedMode: 'single',
			radius: [0, '30%'],
			label: {
				position: 'inner',
				fontSize: 14
			},
			labelLine: {
				show: false
			},
			data: [
			{ value: statusRuang[1].total , name: 'Rusak' },
			{ value: statusRuang[0].total , name: 'Baik', selected: true },
			{ value: statusRuang[2].total , name: 'N/A' },
			]
		},
		{
			name: 'Kondisi Ruangan',
			type: 'pie',
			radius: ['45%', '60%'],
			labelLine: {
				length: 30
			},
			label: {
				formatter: '{a|{a}}{abg|}\n{hr|}\n  {b|{b}：}{c}  {per|{d}%}  ',
				backgroundColor: '#F6F8FC',
				borderColor: '#8C8D8E',
				borderWidth: 1,
				borderRadius: 4,
				rich: {
					a: {
						color: '#6E7079',
						lineHeight: 22,
						align: 'center'
					},
					hr: {
						borderColor: '#8C8D8E',
						width: '100%',
						borderWidth: 1,
						height: 0
					},
					b: {
						color: '#4C5058',
						fontSize: 14,
						fontWeight: 'bold',
						lineHeight: 33
					},
					per: {
						color: '#fff',
						backgroundColor: '#4C5058',
						padding: [3, 4],
						borderRadius: 4
					}
				}
			},
			data: [
			{ value: kondisiRuang[2].total, name: 'Rusak' },
			{ value: kondisiRuang[0].total, name: 'Kosong' },
			{ value: kondisiRuang[1].total, name: 'Terisi' },
			]
		}
		]
	};
	nestedChart.setOption(option);
}

$(function(){
	$('#svgfile object').attr('data', base_url+'assets/uploads/gedung/dipkomx.svg');

	var mySVG = document.getElementById("alphasvg");
	var svgDoc;
	mySVG.addEventListener("load",function() {
		svgDoc = mySVG.contentDocument.documentElement;
		var data_rect = svgDoc.getElementsByTagName("rect");
		var data_tspan = svgDoc.getElementsByTagName("tspan");
		var lantai = data_tspan.asrama_lantai;
		var tipe = data_tspan.asrama_nama;
		attrTipe = $('#svgfile object').attr('tipe');
		(tipe != undefined) ? tipe.textContent = attrTipe ? attrTipe : 'A' : '';
		var attrLantai = $('#svgfile object').attr('lantai');
		(tipe != undefined) ? lantai.textContent = attrLantai ? attrLantai : '1' : '';

		let htm = '';
		for(i=0;i<data_rect.length;i++){
			let dataId = data_rect[i].getAttribute('id');
			if(dataId == "L.BASDAT" || dataId == "R3D" || dataId == "R3C" || dataId == "L.RPL"){
				data_rect[i].addEventListener("click", function(e){
					e.preventDefault();
					htm = '';
					$("#modalTitle").text('Detail Ruangan ' + dataId);

					if(dataId == 'L.BASDAT'){
						htm+=`
						<div class="col-md-12">
						<div class="alert alert-danger">
						<strong>Sorry !</strong> Saat ini, ruangan sedang dalam kondisi rusak</a>.
						</div>
						</div>
						`;
					} else if(dataId == 'R3D'){
						htm+=`
						<div class="col-md-12">
						<div class="alert alert-success">
						Saat ini, ruangan sedang digunakan</a>.
						</div>
						<div class="col-md-12">
						<table class="table table-striped">
						<tr>
						<td>Dosen</td>
						<td>Hardini Novianti, M.T.</td>
						</tr>
						<tr>
						<td>Mata Kuliah</td>
						<td>Akuntansi Keuangan</td>
						</tr>
						<tr>
						<td>Kelas</td>
						<td>KA3A-17</td>
						</tr>
						<tr>
						<td>Waktu Penggunaan</td>
						<td>08.00 s/d 10.30</td>
						</tr>
						</table>
						</div>
						</div>
						`;
					} else if(dataId == 'R3C'){
						htm+=`
						<div class="col-md-12">
						<div class="alert alert-warning text-dark">
						Ruangan ini sudah diisi, dan akan di gunakan dalam <strong>50 Menit</strong> Lagi</a>.
						</div>
						<div class="col-md-12">
						<table class="table table-striped">
						<tr>
						<td>Dosen</td>
						<td>Dinda Lestarini, MT</td>
						</tr>
						<tr>
						<td>Mata Kuliah</td>
						<td>Pemrograman Berorientasi Objek</td>
						</tr>
						<tr>
						<td>Kelas</td>
						<td>KA3B-17</td>
						</tr>
						<tr>
						<td>Waktu Penggunaan</td>
						<td>15.10 s/d 16.50</td>
						</tr>
						</table>
						</div>
						</div>
						`;
					} else if(dataId == 'L.RPL'){
						htm+=`
						<div class="col-md-12">
						<div class="alert alert-secondary">
						Ruang masih kosong, belum ada yang menempati</a>.
						</div>
						</div>
						`;
					}
					$("#appendDetailRuangKelas").html(htm);
					$("#modalRuangKelas").modal('show');
				});

				data_rect[i].addEventListener("mouseover", function(callback){
					callback.target.style.opacity="0.5"
				});

				data_rect[i].addEventListener("mouseleave", function(callback){
					callback.target.style.opacity="1"
				});

			}
		}

	}, false);

});


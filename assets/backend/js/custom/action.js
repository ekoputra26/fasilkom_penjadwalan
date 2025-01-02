function get_data(gedung){
	$.post({
		url : routeUrl + "get_data",
		cache :true,

		data:{gedung:gedung},
		beforeSend: function(){
			$('#mydata-tables').addClass('loading');
		},
		complete: function(){
			$('#mydata-tables').removeClass('loading');
		},
		success: function (data) {
			dump_data(data);
		},
		error: function (response) {
			console.log("Error in fetching data");
		}
	})
	.fail(function(data){
		console.log("Fail in fetching data");
	});
}

function get_data_jadwal(gedung){
	$.post({
		url : routeUrl + "get_data",
		data:{gedung:gedung},
		cache :true,
		beforeSend: function(){
			$('#mydata-tables').addClass('loading');
		},
		complete: function(){
			$('#mydata-tables').removeClass('loading');
		},
		success: function (data) {
			dump_data(data);
		},
		error: function (response) {
			console.log("Error in fetching data");
		}
	})
	.fail(function(data){
		console.log("Fail in fetching data");
	});
}
function get_data_jadwal_home(gedung){
	$.post({
		url : routeUrl + "get_data_jadwal",
		data:{gedung:gedung},
		cache :true,
		beforeSend: function(){
			$('#mydata-tables').addClass('loading');
		},
		complete: function(){
			$('#mydata-tables').removeClass('loading');
		},
		success: function (data) {
			dump_data(data);
		},
		error: function (response) {
			console.log("Error in fetching data");
		}
	})
	.fail(function(data){
		console.log("Fail in fetching data");
	});
}



function send_data_jadwal(data,url){
	let dataPost = JSON.parse(data);
	$.post({
		url : routeUrl + url,
		data : dataPost,
		beforeSend : function(){
			$('#mydata-tables').addClass('loading');
			$('#save_changes').addClass('spinner spinner-darker-success spinner-left');
			$('#save_changes').attr('disabled',true);
		},
		complete: function(){
			$('#mydata-tables').removeClass('loading');
			$('#save_changes').removeClass('spinner spinner-darker-success spinner-left');
			$('#save_changes').attr('disabled',false);
		},
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
			
			if(data.info == 'success'){
				$('#modalForm').modal('hide');
			}

		}
	});
}


function validate(data){
	let dataPost = JSON.parse(data);
	return new Promise((resolve, reject)=>{
		$.post({
			url : routeUrl + 'validate',
			data : dataPost,
			beforeSend : function(){
				$('#mydata-tables').addClass('loading');
				$('#save_changes').addClass('spinner spinner-darker-success spinner-left');
				$('#save_changes').attr('disabled',true);
			},
			complete: function(){
				$('#mydata-tables').removeClass('loading');
				$('#save_changes').removeClass('spinner spinner-darker-success spinner-left');
				$('#save_changes').attr('disabled',false);
			},
			success: (data) => { resolve(data); },
			error: (data) => { reject(data); }
		});
	})
}

function send_data(data,url){
	let dataPost = JSON.parse(data);
	$.post({
		url : routeUrl + url,
		data : dataPost,
		beforeSend : function(){
			$('#mydata-tables').addClass('loading');
			$('#save_changes').addClass('spinner spinner-darker-success spinner-left');
			$('#save_changes').attr('disabled',true);
		},
		complete: function(){
			$('#mydata-tables').removeClass('loading');
			$('#save_changes').removeClass('spinner spinner-darker-success spinner-left');
			$('#save_changes').attr('disabled',false);
		},
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

			if(data.info == 'success'){
				get_data(routeUrl);
				$('#modalForm').modal('hide');
			}

		}
	});
}

function deleteData(id){
	console.log(routeUrl)
	Swal.fire({
		title: 'Are you sure?',
		text: "You won't be able to revert this!",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#F64E60',
		cancelButtonColor: '#1BC5BD',
		confirmButtonText: 'Yes, delete it!',
		reverseButtons: true
	}).then((result) => {
		if (result.isConfirmed) {
			$.post( routeUrl+'delete_data', {id:id} )
			.done(function( data ) {
				data = JSON.parse(data);
				$.toast({
					heading: data.info,
					text: data.text,
					showHideTransition: 'plain',
					position: 'top-right',
					hideAfter: 2000, 
					icon: data.info
				});
				get_data_jadwal(activeTab);
			});
		}
	})
}

var $ = jQuery;
function _confirm(){
	var nama = $(".ajax-form input[name='nama']").val(); // get form data
	var url = document.getElementById("file").files.length;
	var parent = $(".ajax-form input[name='parent']").val();
	if(nama==""){ // validation
		alert("Harap isi Nama.");
		$(".ajax-form input[name='nama']").focus();
	}else if(url==""){
		alert("Harap upload file.");
	}else{			
		$(".ajax-form form").submit(); // do form submit
	}
}
$("#smallmodal").on("hidden.bs.modal", function () { // empty form when modal closed
	$(".ajax-form input[name='_method']").attr("name","form_method");	
	$(".ajax-form form").attr("action",_url);
	$(".ajax-form input[name='nama']").val("");
	$("#smallmodalLabel").html("Tambah File");
	$(".ajax-form .curr_file").prop("hidden",true);
});
$(".edit_file").click(function(a){
	// $("#loader").modal({
	  // backdrop: "static", //remove ability to close modal with click
	  // keyboard: false, //remove option to close with keyboard
	  // show: true //Display loader!
	// });
	// $('#loader').modal('show'); // show modal
	var id = $($(a)[0].currentTarget).attr('primary'); // get id
	$.ajax({
		method: 'get',
		url:_url+"/"+id+"/edit",
		success: function(result) {
			$('#smallmodal').modal('show'); // hide modal
			$(".ajax-form input[name='form_method']").attr("name","_method");	
			$(".ajax-form .curr_file").prop("hidden",false);
			$(".ajax-form form").attr("action",_url+"/"+id);
			result = $.parseJSON(result);
			$("#smallmodalLabel").html("Edit File " + result.nama);
			$(".ajax-form input[name='nama']").val(result.nama);
			$(".ajax-form .curr_file a").html(result.file);
			$(".ajax-form .curr_file a").attr("href", _public+"/"+id+"/"+result.file);
			// $('#loader').modal('hide'); // hide modal
		},
		error: function(result) {
			// $('#loader').modal('hide'); // hide modal
			alert("Gagal mengambil data.");
		}
	});
});
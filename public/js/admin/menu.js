var $ = jQuery;
function _confirm(){
	var judul = $(".ajax-form input[name='judul']").val(); // get form data
	var url = $(".ajax-form input[name='url']").val();
	var parent = $(".ajax-form input[name='parent']").val();
	if(judul==""){ // validation
		alert("Harap isi judul.");
		$(".ajax-form input[name='judul']").focus();
	}else if(url==""){
		alert("Harap isi URL.");
		$(".ajax-form input[name='url']").focus();
	}else{			
		$(".ajax-form form").submit(); // do form submit
	}
}
$("#smallmodal").on("hidden.bs.modal", function () { // empty form when modal closed
	$(".ajax-form input[name='id']").attr("name","parent");	
	$(".ajax-form input[name='_method']").attr("name","form_method");	
	$(".ajax-form form").attr("action",_url);
	$(".ajax-form input[name='judul']").val("");
	$(".ajax-form input[name='url']").val("");
	$(".ajax-form input[name='parent']").val("");
	$("#smallmodalLabel").html("Tambah Menu");
});
$(".add_submenu").click(function(a){
	$('#smallmodal').modal('show'); // show modal
	var btn = $($(a)[0].currentTarget); // get trigger btn
	var tr = btn.parents('tr'); // get current tr
	var judul = tr.find('td:nth-child(2)').html();
	var parent = btn.attr('primary'); // set form data
	$(".ajax-form input[name='parent']").val(parent);
	$("#smallmodalLabel").html("Tambah Sub-menu " + judul);
});
$(".edit_menu").click(function(a){
	$('#smallmodal').modal('show'); // show modal
	$(".ajax-form input[name='parent']").attr("name","id");
	var btn = $($(a)[0].currentTarget); // get trigger btn
	var tr = btn.parents('tr'); // get current tr
	var judul = tr.find('td:nth-child(2)').html();
	var url = tr.find('td:nth-child(3) a').html();
	var id = btn.attr('primary'); // set form data
	$(".ajax-form form").attr("action",_url+"/"+id);
	$(".ajax-form input[name='form_method']").attr("name","_method");	
	$(".ajax-form input[name='id']").val(id);
	$(".ajax-form input[name='judul']").val(judul);
	$(".ajax-form input[name='url']").val(url);
	$("#smallmodalLabel").html("Edit Menu " + judul);
});
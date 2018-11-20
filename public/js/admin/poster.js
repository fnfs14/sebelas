var $ = jQuery;
// ClassicEditor
	// .create( document.querySelector( '#isi' ) )
	// .catch( error => {
		// console.error( error );
	// } );
CKEDITOR.replace( 'isi' );
function readURL(input) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();
		reader.onload = function (e) {
			$('#preview_thumbnail').attr('src', e.target.result);
		};
		reader.readAsDataURL(input.files[0]);				
		$("br").prop('hidden',false);
		$("#preview_thumbnail").prop('hidden',false);
	}else{
		$("br").prop('hidden',true);
		$("#preview_thumbnail").prop('hidden',true);
	}
}
function copyFile(a) {
	var copyText = document.getElementById("_file"+a);
	copyText.select();
	document.execCommand("copy");
	alert("Copied!");
	$("#smallmodal").modal('hide');
}
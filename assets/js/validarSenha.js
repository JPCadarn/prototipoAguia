$("#confirme_senha").keyup(function() {
	let senha = $("#senha").val();
	let confirmeSenha = $("#confirme_senha").val();
	if(senha != '' && senha == confirmeSenha){
		$('#btnSubmit').prop('disabled', false);
	}else{
		$('#btnSubmit').prop('disabled', true);
	}
});

$("#senha").keyup(function() {
	let senha = $("#senha").val();
	let confirmeSenha = $("#confirme_senha").val();
	if(senha != '' && senha == confirmeSenha){
		$('#btnSubmit').prop('disabled', false);
	}else{
		$('#btnSubmit').prop('disabled', true);
	}
});
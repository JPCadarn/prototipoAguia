$("[id*='btnAvaliarInspecao']").click(function(e){
	let idInspecao = e.currentTarget.id;
	$('#id_inspecao').val(idInspecao.split('btnAvaliarInspecao')[1]);
});
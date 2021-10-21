$(document).ready(function(){
	$('.mask-date').mask('00/00/0000');
	$('.mask-hora').mask('00:00');
	$('.mask-coord').mask('00º 00\' 00\" A');
	$('.mask-telefone').mask('(00) 90000-0000');
	$('.mask-decimal').mask('000.000.000.000.000,00', {reverse: true});
	$('.mask-cep').mask('00000-000');
	$(".mask-cpfcnpj").keydown(function(){
		try {
			$(".mask-cpfcnpj").unmask();
		} catch (e) {}
	
		var tamanho = $(".mask-cpfcnpj").val().length;
	
		if(tamanho < 11){
			$(".mask-cpfcnpj").mask("999.999.999-99");
		} else {
			$(".mask-cpfcnpj").mask("99.999.999/9999-99");
		}
	
		// ajustando foco
		var elem = this;
		setTimeout(function(){
			// mudo a posição do seletor
			elem.selectionStart = elem.selectionEnd = 10000;
		}, 0);
		// reaplico o valor para mudar o foco
		var currentValue = $(this).val();
		$(this).val('');
		$(this).val(currentValue);
	});
});
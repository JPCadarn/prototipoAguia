$('#estado').change(function(){
    let valor = $(this).val();
    if(valor == null){
        $('#div_cidades').removeClass('oculto');
    }else{
        $('#div_cidades').addClass('oculto');
        $('*[id*=div_CIDADES_]:visible').each(function() {
            $(this).addClass('oculto');
        });
        $('#div_CIDADES_'+valor.toUpperCase()).removeClass('oculto');
    }
    console.log(valor);
})
$(document).ready(function(){
	$('.sidenav').sidenav();
});

$(document).ready(function(){
    $('.tooltipped').tooltip();
});

$(document).ready(function(){
    $('.modal').modal();
});

$(document).ready(function(){
    $('select').formSelect();
});

$(document).ready(function(){
    $('.fixed-action-btn').floatingActionButton();
});

$(document).ready(function(){
    $('.timepicker').timepicker({
        twelveHour: false
    });
});

$(document).ready(function(){
    $('.datepicker').datepicker({
        autoClose: true,
        format: 'dd/mm/yyyy',
        selectMonths: true,
        selectYears: 20,
        disable: [true],
        i18n: {
            cancel: 'Cancelar',
            months:	[
                'Janeiro',
                'Fevereiro',
                'Março',
                'Abril',
                'Maio',
                'Junho',
                'Julho',
                'Agosto',
                'Setembro',
                'Outubro',
                'Novembro',
                'Dezembro'
            ],
            monthsShort: [
                'Jan',
                'Fev',
                'Mar',
                'Abr',
                'Mai',
                'Jun',
                'Jul',
                'Ago',
                'Set',
                'Out',
                'Nov',
                'Dez'
            ],
            weekdays: [
                'Domingo',
                'Segunda-Feira',
                'Terça-Feira',
                'Quarta-Feira',
                'Quinta-Feira',
                'Sexta-Feira',
                'Sábado'
            ],
            weekdaysShort: [
                'Dom',
                'Seg',
                'Ter',
                'Qua',
                'Qui',
                'Sex',
                'Sab'
            ],
            weekdaysAbbrev:	[
                'D',
                'S',
                'T',
                'Q',
                'Q',
                'S',
                'S'
            ]
        }
    });
});

$(document).ready(function(){
    $('.slider').slider();
});

$(document).ready(function(){
    $('.carousel').carousel();
});

$('a[href="#"]').click(function(e){
    e.preventDefault();
})

$(document).ready(function(){
    $('.collapsible').collapsible();
});

$(".dropdown-trigger").dropdown({
    hover: false,
    closeOnClick: true,
    coverTrigger: false
});

$(document).ready(function(){
    $('.materialboxed').materialbox();
});

$(document).ready(function(){
    $('.tabs').tabs();
});
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
    $('.slider').slider();
});

$(document).ready(function(){
    $('.carousel').carousel();
});

$('a[href="#"]').click(function(e){
    e.preventDefault();
})

$(document).ready(function(){
    $('.collapsible').collapsible({
        accordion: false
    });
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

(function($){
    $(function(){
  
      $('.sidenav').sidenav();
      $('.parallax').parallax();
  
    });
})(jQuery);

var elem = document.querySelector('.collapsible.expandable');
var instance = M.Collapsible.init(elem, {
  accordion: false
});

let split = window.location.href.split('/');
let actual = split[split.length - 1];
let ativos = $('a[href="'+actual+'"]');
ativos.each(function(){
    $(this).parent().addClass('active');
});
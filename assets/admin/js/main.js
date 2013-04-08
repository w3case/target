$(window).scroll(function (event) {
    var scroll = $(this).scrollTop();

    if (scroll >= 240)
    {
        $('#nav-acoes').addClass("nav-fixed");
    }
    else
    {
        $('#nav-acoes').removeClass("nav-fixed");
    }
});

if($('.tooltip-link').length) {
	$('.tooltip-link').tooltip();
}

if($('.textarea').length) {
	$('.textarea').wysihtml5();
}
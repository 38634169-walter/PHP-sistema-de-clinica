$(document).ready(mostrar_menu);

function mostrar_menu(){
    $('.icono-menu').click(function(){
        $('.menu-container').css({"left":"0","transition":"0.3s"});
        $('.icono-menu').css({"display":"none"});
        $('.x-icono').css({"display":"block"});
    });

    $('.x-icono').click(function(){
        $('.menu-container').css({"left":"-100%","transition":"0.3s"});
        $('.x-icono').css({"display":"none"});
        $('.icono-menu').css({"display":"block"});
    });

}

$(document).ready(function(){
    $('#descarga').click(function(){
        $('#ventanaDescarga').fadeIn('slow');
    });
    
    $('.salir').click(function(){
        $('.mascara, .contenedor').fadeOut('slow');
    });
    
    $('.volver').click(function(){
        $('#wrapper').fadeOut('fast');
        $('#menuAdmin').fadeIn('slow');
    });
    
    $('#btnEventos').click(function(){
        
    });
    
    $('#btnAceptaIns').click(function(){
        $('#msjInstalando').fadeOut('fast');
        $('#mensajeFin').fadeIn('slow');
    });
    
    $('#btnAceptarTotal').click(function(){
        $('#mensajeFin').fadeOut('fast');
        $('#menuAdmin').fadeIn('slow');
    });
    
    $('#btnReportes').click(function(){
        $('#menuAdmin').fadeOut('fast');
        $('#menuRepor').fadeIn('slow');
    });
    
    $('#btnVolverMenu').click(function(){
        $('#menuRepor').fadeOut('fast');
        $('#menuAdmin').fadeIn('slow');
    });
    
    /*$('#btnAceptarSin').click(function(){
        $('#msjIns').fadeOut('fast');
        $('#menuAdmin').fadeIn('slow');
    });*/
    
});
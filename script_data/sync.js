var dep;
var pos;
function iniciar_evento_sync(){
	agregarEvento("btnAceptarSin","click",function(){
		alert("Este proceso puede tardar un poco se notificara tan pronto termine ");
		//consultarDatosOff(url,evento_server,datos,funcion_despues)
		consultarDatosOff(globales._URL_BE+"controlador/controlador_sincronizar.php","",{},function(rs){
			    console.log(rs);
			    mostrarMensaje(rs);    
			    if(rs.respuesta){

			    		 $('#msjIns').fadeOut('fast');
	        			 $('#menuAdmin').fadeIn('slow');
			    }
		        
	        
    	});
		    
	});
}


agregarEventoLoad(iniciar_evento_sync);
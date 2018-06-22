agregarEventoLoad(iniciar_instalar);
function iniciar_instalar(){
	document.getElementById("btnAceptaIns").style.display="none";
	agregarEvento("btnInstalar","click",function(){
			
			registrarDatoOff(globales._URL_BE+"controlador/controlador_instalar_db.php","",{},function(rs){
				mostrarMensaje(rs);						
				if(rs.respuesta){
					consultar_db();
				}

			},"");

	});

}	
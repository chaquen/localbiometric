var usuario;
var _contexto;
agregarEventoLoad(cargarFuncionesMenu);

function cargarFuncionesMenu(){
    usuario=obtener_session_storage("ssUsuario");
    if(usuario){
          
          iniciar_contexto_agenda(); 
         
          consultar_menu_rol(usuario);
          agregarEvento("salir","click",salir);
    }else{
        console.log(obtener_session_storage("ssUsuario"));
        mostrarMensaje({mensaje:"Por favor inicia sesion correctamente"});
        location.href="index.html";
    }
  
}

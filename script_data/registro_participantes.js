
function iniciar_evento_participantes(){


    globales._usuario=obtener_local_storage("ssUsuario");
    if(globales._usuario==false){
        location.href="index.html";
    }
    globales._URL=globales._URL_BE;
    
    
   
    agregarEvento("btnRegistrarParticiapantes","click",function(){
        var datos = $("#formPobladores").serializarFormulario();
       
        
        if(false!=datos){
             datos.estado_registro="registrado";
             console.log(datos);
             console.log(id);
             datos.created_at=horaCliente();
             datos.created_at=horaCliente();
             datos.tipo_registro="nuevo";
             datos.state=true;
                //registrarDato("participantes",{datos:datos,id:data.id},function(rs){
                registrarDatoOff(globales._URL+"controlador/controlador_participantes.php","crearParticipante",{datos:datos,id:id,id_evento:pos},function(rs){
                        if(rs.respuesta==true){
                            mostrarMensaje(rs);
                            document.getElementById("contenedorP").style.display='none';
                            document.getElementById("tblParticipantes").style.display='block';
                            consultar_participantes();
                        }
                        
                    
                },"formPobladores");
        }else{
                mostrarMensaje("Por favor ingresa los campos requeridos");
        }
    });
    
    agregarEvento("btnCancelarParticiapantes","click",function(){
        limpiarFormulario("formPobladores");
    });
    
    
 
    agregarEvento("txt_dep_nacimiento","keypress",function(e){        
        console.log(e);
        console.log(e.key);
        dep=[];
         if (e.keyCode != 13 && e.key!=undefined) {
            for(var el in globales._departamentos){
                console.log(globales._departamentos[el].departamento.toUpperCase());
                console.log(e.key);
                console.log(globales._departamentos[el].departamento.indexOf(e.key));
                if(globales._departamentos[el].departamento.toUpperCase().indexOf(e.key.toUpperCase()) >= 0){
                    
                    //console.log(globales._departamentos[el].departamento);
                    dep.push(globales._departamentos[el]);
                }
            }
            console.log(dep)
            crear_data_list("lista_datos",dep,"id","departamento");  
         }
            
    });
    agregarEvento("txt_dep_nacimiento","change",function(e){
        console.log(e);
        dep=[];
        for(var el in globales._departamentos){
              
                if(globales._departamentos[el].id== e.srcElement.value  ){
                    
                    console.log(globales._departamentos[el].ciudades);
                    dep.push(globales._departamentos[el].ciudades);
                }
            }

            crear_data_list_dos("lista_datos_2",dep);
    });

    agregarEvento("btn_Regresar","click",function(){
        location.href="menuEventos.html";
    });


    agregarEvento("txt_cc","change",function(){
        consultarDatosOff(globales._URL_BE+"controlador/controlador_usuario.php","validar_cc",{cc:this.value},function(rs){
                console.log(rs);
                
                if(rs.respuesta==true){
                    mostrarMensaje("Este documento ya esta registrado");
                }
        });
    });
    agregarEvento("btnGuardarAsistentes","click",function(){
        consultarDatosOff(globales._URL_BE+"controlador/controlador_participantes.php","guardar_asistentes",{id_evento:pos},function(rs){
                console.log(rs);
                
                mostrarMensaje(rs);
        });
    });
    
}
agregarEventoLoad(iniciar_evento_participantes);

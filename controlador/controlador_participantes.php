<?php
header('Content-Type:text/html; Charset="UTF-8"');    
header('Access-Control-Allow-Origin: *'); 
include("../datos/orm_core.php");
//var_dump(isset($_REQUEST["datos"]));

if(isset($_REQUEST['datos'])){
    $post=  json_decode($_REQUEST['datos']);
    $operacion=$post->operacion;
    $objeto= new Participantes();//Mi clase  modelo 
    $objeto2= new Participantes();//Mi clase  modelo 
    $objeto3= new Participantes();//Mi clase  modelo 
    $evento=new Eventos();
    switch($operacion){
        case "crearEmpleado":
            
            /*
             * AQUI DOY VALOR A CADA UNA DE LAS PROPIEDADES DE LA CLASE PARA INSERTAR LOS VALORES
             */
            /*
             * Para acceder a cada una de las propiedaes enviadas en el metodo POST se debe acceder desde objeto 
             * $post a la proiedad datos ejemplo
             * $post->datos->miDatoEnviadoDesdeElCliente
             */
            //$objeto->documento=trim($post->datos->documento);
            //$objeto->correo=  trim($post->datos->correo);
            
            
            
            
            break;
            
         case "crearParticipante":
            //var_dump($post);    
            //var_dump($post->datos->id);    
            //var_dump($objeto->actualizar_recurso($post->datos->datos,$post->datos->id));
            $re=$objeto->actualizar_recurso($post->datos->datos,$post->datos->id);
            //var_dump($re["respuesta"]);
            if($re["respuesta"]){
                //registrar en evento
                //$evento->crear_detalle_evento(array("user_id"=>$post->datos->id,"event_id"=>$post->datos->id_evento));
                 echo  json_encode($evento->crear_detalle_evento(array("user_id"=>$post->datos->id,"event_id"=>$post->datos->id_evento,"created_at"=>$post->hora_cliente,"updated_at"=>$post->hora_cliente)));
            }else{
                echo json_encode(array("mensaje"=>"Nose ha podido registrar este usuario al evento por favor verifca la huella, para registrar la asistencia"));    
            }
       
            break;   
        case "consultarParticipantePendientes":
            //var_dump($post->datos->id);
        //var_dump($objeto->obtener_registro_por_valor("*","estado_registro = 'por_registrar'"));
            echo  json_encode(array("pendientes"=>$objeto->obtener_registro_por_valor("id,estado_registro","estado_registro = 'por_registrar'"),"verificados"=>$objeto2->obtener_registro_por_valor("participantes.id,participantes.pri_nombre,participantes.seg_nombre,participantes.pri_apellido,participantes.seg_apellido","participantes.estado_registro = 'verificado'"),"registrados"=>$objeto3->obtener_registro_por_valor_join("participantes.id,participantes.pri_nombre,participantes.seg_nombre,participantes.pri_apellido,participantes.seg_apellido","participantes.estado_registro = 'registrado' AND detalle_participantes.event_id = ".$post->datos->id)));
        break;     
        case "guardar_asistentes":
                //var_dump($post);
                $dd=$objeto->obtener_registro_por_valor("participantes.id,participantes.pri_nombre,participantes.seg_nombre,participantes.pri_apellido,participantes.seg_apellido","participantes.estado_registro = 'verificado' OR participantes.estado_registro = 'registrado'");

                foreach ($dd["valores_consultados"] as $key => $value) {
                    $evento= new Eventos();
                    //var_dump($value);
                    $evento->crear_detalle_evento(array("user_id"=>$value["id"],"event_id"=>$post->datos->id_evento
                        ,"created_at"=>$post->hora_cliente,"updated_at"=>$post->hora_cliente));
             
                }
                
                echo json_encode(array("mensaje"=>"Usuarios asociados","respuesta"=>true));    
            break;
        default :
            echo json_encode(array("respuesta"=>FALSE,"mensaje"=>"Por favor defina una operacion o agrege una opcion en el swicth"));
            break;
    }
}else{
    echo json_encode(array("respuesta"=>FALSE,"mensaje"=>"Por favor ingrese datos en la petición","datos"=>$_REQUEST['datos']));
}
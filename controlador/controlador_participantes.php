<?php
header('Content-Type:text/html; Charset="UTF-8"');    

include("../datos/orm_core.php");
//var_dump(isset($_REQUEST["datos"]));

if(isset($_REQUEST['datos'])){
    $post=  json_decode($_REQUEST['datos']);
    $operacion=$post->operacion;
    $objeto= new Participantes();//Mi clase  modelo 
    $objeto2= new Participantes();//Mi clase  modelo 
   
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
        //var_dump($post->datos->datos);    
        //var_dump($post->datos->id);    
        //var_dump($objeto->actualizar_recurso($post->datos->datos,$post->datos->id));
        echo  json_encode($objeto->actualizar_recurso($post->datos->datos,$post->datos->id));
            break;   
        case "consultarParticipante":
            $res=$objeto->obtener_registro_por_valor("id,estado_registro,pri_apellido,seg_apellido,pri_nombre,seg_nombre","estado_registro = 'por_registrar'");
            $res2=$objeto2->obtener_registro_por_valor("id,estado_registro,pri_apellido,seg_apellido,pri_nombre,seg_nombre","estado_registro = 'registrado'");
            //var_dump($res);
            //echo "================"; 
            //var_dump($res2);
            if($res["respuesta"]){
                //var_dump($res["valores_consultados"]);
                $d1=$res["valores_consultados"];
            }else{
                $d1=NULL;
            }
            
            if($res2["respuesta"]){
                $d2=$res2["valores_consultados"];
            }else{
                $d2=NULL;
            }
             echo json_encode(
                    array("respuesta"=>TRUE,
                        "mensaje"=>"REGISTRO ENCONTRADO",
                        "datos"=>$d1,
                       "registrados"=>$d2
                        )
                    );
        break;     

        default :
            echo json_encode(array("respuesta"=>FALSE,"mensaje"=>"Por favor defina una operacion o agrege una opcion en el swicth"));
            break;
    }
}else{
    echo json_encode(array("respuesta"=>FALSE,"mensaje"=>"Por favor ingrese datos en la petición"));
}
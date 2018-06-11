<?php
header('Content-Type:text/html; Charset="UTF-8"');    

include("../datos/orm_core.php");
include("../datos/Install.php");
//var_dump(isset($_REQUEST["datos"]));

if(isset($_REQUEST['datos'])){
    $post=  json_decode($_REQUEST['datos']);
    $operacion=$post->operacion;
    $objeto= new Participantes();//Mi clase  modelo 
   
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
            var_dump($post);
        break;     
        case "login_local":
            var_dump($post);

        break;
        case "validar_db":
            $install= new Install();
            if($install->validar_db()){
                echo  json_encode(array("mensaje"=>"Base de datos encontrada","respuesta"=>TRUE));
            }else{
                echo  json_encode(array("mensaje"=>"Base de datos NO encontrada","respuesta"=>FALSE));
            }

            break;

        default :
            echo json_encode(array("respuesta"=>FALSE,"mensaje"=>"Por favor defina una operacion o agrege una opcion en el swicth"));
            break;
    }
}else{
    echo json_encode(array("respuesta"=>FALSE,"mensaje"=>"Por favor ingrese datos en la petición","datos"=>$_REQUEST['datos']));
}
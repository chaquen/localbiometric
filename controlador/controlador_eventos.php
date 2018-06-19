<?php
header('Content-Type:text/html; Charset="UTF-8"');    
header('Access-Control-Allow-Origin: *'); 
include("../datos/orm_core.php");
//var_dump(isset($_REQUEST["datos"]));

if(isset($_REQUEST['datos'])){
    $post=  json_decode($_REQUEST['datos']);
    $operacion=$post->operacion;
    $objeto= new Eventos();//Mi clase  modelo 
   
    switch($operacion){
       
        case "mis_eventos":
            //var_dump($post);
            $res=$objeto->obtener_registro_por_valor("*","id_ref = ".$post->datos->usuario->id);
            //var_dump($res);
            echo json_encode($res);
        break;     

        default :
            echo json_encode(array("respuesta"=>FALSE,"mensaje"=>"Por favor defina una operacion o agrege una opcion en el swicth"));
            break;
    }
}else{
    echo json_encode(array("respuesta"=>FALSE,"mensaje"=>"Por favor ingrese datos en la petición","datos"=>$_REQUEST['datos']));
}
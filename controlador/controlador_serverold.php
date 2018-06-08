<?php
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');
/**
 * Constructs the SSE data format and flushes that data to the client.
 *
 * @param string $id Timestamp/id of this connection.
 * @param string $msg Line of text that should be transmitted.
 */
include("../datos/orm_core.php");

//$salida=true;
  function sendMsg() {
    $objeto= new Participantes();
    $objeto2= new Participantes();
    $objeto3= new Participantes();
     $res=$objeto->obtener_registro_por_valor("id,estado_registro,pri_apellido,seg_apellido,pri_nombre,seg_nombre","estado_registro = 'por_registrar'");
         
        
            //var_dump($obj[0]);
         if ($res["respuesta"]==true) {
           $obj=json_decode($res["valores_consultados"]);

            //var_dump($res["datos"][0]->id);
              $id=$obj[0]->id;  
              $pri_nom=$obj[0]->pri_nombre;  
              $seg_nom=$obj[0]->seg_nombre;  
              $pri_ape=$obj[0]->pri_apellido;  
              $seg_ape=$obj[0]->seg_apellido;  
              $estado=$obj[0]->estado_registro;  
              

              
              //echo "id: $id" . PHP_EOL;
              echo "data: {\n";
              echo "data: \"pri_nombre\": \"$pri_nom\", \n";              
              echo "data: \"seg_nombre\": \"$seg_nom\", \n";              
              echo "data: \"pri_apellido\": \"$pri_ape\", \n";              
              echo "data: \"seg_apellido\": \"$seg_ape\", \n";              
              echo "data: \"estado\": \"$estado\", \n";              
              echo "data: \"id\": $id\n";
              echo "data: }\n";
              $rs=$objeto2->crear_registro(["user_id"=>$id,"event_id"=>$_GET["id_evento"]]);
              if($rs["respuesta"]==true){
                $objeto3->actualizar_recurso_estado($id);
                echo PHP_EOL;
                ob_flush();
                flush();
                //$salida=false;
                return true;  
                //die();
              }
              
             
            die();
            //break;
          }else{
            echo "buscando";
          }
  }
  
  //do {
    // Cap connections at 10 seconds. The browser will reopen the connection on close
    var_dump(sendMsg());  
    //if (true == sendMsg()) {
     // die();
    //}
    
   
  //} while(true);
?>
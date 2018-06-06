<?php

header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');

include("../datos/orm_core.php");
$objeto= new Participantes();
$salida=true;

//var_dump($objeto->obtener_registro_por_valor("id","estado_registro = 'por_registrar'"));
 do {
        	//echo "string";
          // Cap connections at 10 seconds. The browser will reopen the connection on close
            $res=$objeto->obtener_registro_por_valor("id","estado_registro = 'por_registrar'");
            $obj=json_decode($res["valores_consultados"]);

            //var_dump($obj[0]);
         if ($res["respuesta"]==true) {
            //var_dump($res["datos"][0]->id);
              $id=$obj[0]->id;  
              
              //echo "id: $id" . PHP_EOL;
              echo "data: {\n";
             
              echo "data: \"id\": $id\n";
              echo "data: }\n";
              echo PHP_EOL;
              ob_flush();
              flush();
              $salida=false;
             
            die();
            //break;
          }else{
            echo "buscando";
          }
		
          


          //sendMsg($startedAt." Hola :) pez" , time());
          //sleep(5);
          // If we didn't use a while loop, the browser would essentially do polling
          // every ~3seconds. Using the while, we keep the connection open and only make
          // one request.
} while($salida);


 /*function consultar_registro_participante_old(){
        do {
        	echo "string";
          // Cap connections at 10 seconds. The browser will reopen the connection on close
            $res=$objeto->obtener_registro_por_valor("id","estado_registro = 'por_registrar'");
            var_dump(json_decode($res["valores_consultados"]));
          if ($res["respuesta"]==false) {
            //var_dump($res["datos"][0]->id);
              $id=$res["valores_consultados"][0]->id;  
              
              echo "id: $id" . PHP_EOL;
              echo "data: {\n";
             
              echo "data: \"id\": $id\n";
              echo "data: }\n";
              echo PHP_EOL;
              ob_flush();
              flush();

             
            die();
            break;
          }else{
            echo "buscando";
          }
		
          


          //sendMsg($startedAt." Hola :) pez" , time());
          //sleep(5);
          // If we didn't use a while loop, the browser would essentially do polling
          // every ~3seconds. Using the while, we keep the connection open and only make
          // one request.
        } while(true);
    }*/


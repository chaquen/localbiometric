<?php

class Participantes extends ModeloBaseDeDatos{
    private $TABLA='participantes';
    public $huella;
    
    
    public function __construct() {
        
    }
    

    function crear_registro($arr){
         foreach ($arr as $key => $value) {
                $$key=$value;
            }   
        //var_dump($estado_registro);  
        //echo "=======================";  
        //$this->sentencia_sql="SELECT * FROM participantes WHERE documento = $documento";
        //if($this->consultar_registros()==false){
    
           /* echo $this->sentencia_sql="INSERT INTO participantes (tipo_doc ,
                                                        documento ,
                                                        lugar_exp ,
                                                        pri_apellido ,
                                                        seg_apellido,
                                                        pri_nombre ,
                                                        seg_nombre ,
                                                        dep_nacimiento ,
                                                        ciud_nacimiento ,
                                                        fecha_nac ,
                                                        genero ,
                                                        cap_dife ,
                                                        etnia ,
                                                        zona ,
                                                        municipio ,
                                                        celular ,
                                                        email ,
                                                        escolaridad ,
                                                        titulo_obt ,
                                                        organizacion ,
                                                        proceso ,
                                                        estado_registro,
                                                        tipo_registro,
                                                        id_server,
                                                        state,
                                                        created_at,
                                                        updated_at,
                                                        huella_binaria) 
                                                        VALUES ( '$tipo_doc',
                                                        '$documento',
                                                        '$lugar_exp',
                                                        '$pri_apellido',
                                                        '$seg_apellido',
                                                        '$pri_nombre',
                                                        '$seg_nombre',
                                                        '$dep_nacimiento',
                                                        '$ciud_nacimiento',
                                                        '$fecha_nac',
                                                        '$genero',
                                                        '$cap_dife',
                                                        '$etnia',
                                                        '$zona',
                                                        '$municipio',
                                                        '$celular',
                                                        '$email',
                                                        '$escolaridad',
                                                        '$titulo_obt',
                                                        '$organizacion',
                                                        '$proceso',
                                                        'registrado',
                                                        'antiguo',
                                                        '$id',
                                                        '1',
                                                        '$created_at',
                                                        '$updated_at',
                                                        '$huella_binaria')";*/

                                                        echo $this->sentencia_sql="INSERT INTO participantes (
                                                        huella_binaria) 
                                                        VALUES ( 
                                                        '$huella_binaria')";

            

            if($this->insertar_registro()){
            //var_dump($this->respuesta_funcion);
                return array("mensaje"=> $this->mensajeDepuracion,
                    "respuesta"=>TRUE);
            }else{
                return array("mensaje"=>  $this->mensajeDepuracion,"respuesta"=>FALSE);
            }   
        //}else{
            //actualizar horario
        //}
                
        
    }    


    function obtener_registro_todos_los_registros(){
        
           $this->sentencia_sql="SELECT 
                            `participantes`.`id`, 
                            `tipo_doc`,
                            `documento`,
                            `lugar_exp`, 
                            `pri_apellido`,
                            `seg_apellido`,
                            `pri_nombre`,
                            `seg_nombre`, 
                            `ciud_nacimiento`, 
                            `dep_nacimiento`, 
                            `fecha_nac`, 
                            `genero`, 
                            `cap_dife`, 
                            `etnia`, 
                            `zona`, 
                            `municipio`, 
                            `celular`, 
                            `email`, 
                            `escolaridad`, 
                            `titulo_obt`, 
                            `proceso`, 
                            `organizacion`, 
                            `huella_binaria`, 
                            `state`, 
                            `estado_registro`, 
                            `tipo_registro`, 
                            `participantes`.`created_at`, 
                            `participantes`.`updated_at`,
                            `detalle_participantes`.`created_at` as `created_at_1`, 
                            `detalle_participantes`.`updated_at` as `updated_at_1`,
                            `detalle_participantes`.`event_id`
                            FROM ".trim($this->TABLA)." INNER JOIN detalle_participantes WHERE detalle_participantes.user_id = participantes.id" ;
        
        
        if($this->consultar_registros()){
            //var_dump($this->filas);
            return array("mensaje"=>$this->mensajeDepuracion,
                "respuesta"=>TRUE,
                "valores_consultados"=>$this->filas);
        }else{
            return array("mensaje"=>  $this->mensajeDepuracion,"respuesta"=> FALSE);
        }
        
    }
    function obtener_registro_por_valor($valores_a_retornar,$valor){
<<<<<<< HEAD
        
=======
         
>>>>>>> 1f2976bf5e1a1ac083ca00954ca9e217fb12bf19
         $this->sentencia_sql="SELECT ". trim($valores_a_retornar)." FROM ". trim($this->TABLA);

        if($valor!=""){
            $this->sentencia_sql.=" WHERE ".$valor;
        }
        
        //echo $this->sentencia_sql;
        
        
        if($this->consultar_registros()){
            //var_dump($this->filas);
            return array("mensaje"=>$this->mensajeDepuracion,
                "respuesta"=>TRUE,
                "valores_consultados"=>$this->filas);
        }else{
            return array("mensaje"=>  "No hay registros de participantes","respuesta"=> FALSE,"valores_consultados"=>NULL);
        }
        
    }

    function obtener_registro_por_valor_join($valores_a_retornar,$valor){
         
         $this->sentencia_sql="SELECT ". trim($valores_a_retornar)." FROM ". trim($this->TABLA)." INNER JOIN detalle_participantes ON ". trim($this->TABLA).".id = detalle_participantes.user_id";

        if($valor!=""){
            $this->sentencia_sql.=" WHERE ".$valor;
        }
        
        //echo $this->sentencia_sql;
        
        
        if($this->consultar_registros()){
            //var_dump($this->filas);
            return array("mensaje"=>$this->mensajeDepuracion,
                "respuesta"=>TRUE,
                "valores_consultados"=>$this->filas);
        }else{
            return array("mensaje"=>  "No hay registros de participantes","respuesta"=> FALSE,"valores_consultados"=>NULL);
        }
        
    }
    
    function eliminar_recurso($valor){
        $this->sentencia_sql="DELETE FROM ".$this->TABLA."WHERE ".$valor;
        if($this->eliminar_registro()){
            return array("mensaje"=> $this->mensajeDepuracion,
                "respuesta"=>TRUE);
        }else{
            return array("mensaje"=>  $this->mensajeDepuracion,"respuesta"=>TRUE);
        }
    }
    function actualizar_recurso($arr,$id){
        foreach ($arr as $key => $value) {
                $$key=$value;
            }   
          $this->sentencia_sql="UPDATE ".$this->TABLA." SET 
                                                        tipo_doc = '$tipo_doc',
                                                        documento = '$documento',
                                                        lugar_exp = '$lugar_exp',
                                                        pri_apellido = '$pri_apellido',
                                                        seg_apellido = '$seg_apellido',
                                                        pri_nombre = '$pri_nombre',
                                                        seg_nombre = '$seg_nombre',
                                                        dep_nacimiento = '$dep_nacimiento',
                                                        ciud_nacimiento = '$ciud_nacimiento',
                                                        fecha_nac = '$fecha_nac',
                                                        genero = '$genero',
                                                        cap_dife = '$cap_dife',
                                                        etnia = '$etnia',
                                                        zona = '$zona',
                                                        municipio = '$municipio',
                                                        celular = '$celular',
                                                        email = '$email',
                                                        escolaridad = '$escolaridad',
                                                        titulo_obt = '$titulo_obt',
                                                        organizacion = '$organizacion',
                                                        proceso = '$proceso',
<<<<<<< HEAD
                                                        estado_registro = 'registrado'
=======
                                                        estado_registro = 'registrado',
                                                        tipo_registro = 'nuevo',
                                                        state = '1',
                                                        created_at = '$created_at',
                                                        updated_at = '$created_at'
>>>>>>> 1f2976bf5e1a1ac083ca00954ca9e217fb12bf19
                                                        WHERE id = '$id'";
        if($this->actualizar_registro()){
            return array("mensaje"=> $this->mensajeDepuracion,
                "respuesta"=>TRUE);
        }else{
            return array("mensaje"=>  $this->mensajeDepuracion,"respuesta"=>TRUE);
        }
    }

    function actualizar_recurso_estado($id){
      
          $this->sentencia_sql="UPDATE ".$this->TABLA." SET 
                                                        
                                                        estado_registro = 'registrado'
                                                        WHERE id = '$id'";
        if($this->actualizar_registro()){
            return array("mensaje"=> $this->mensajeDepuracion,
                "respuesta"=>TRUE);
        }else{
            return array("mensaje"=>  $this->mensajeDepuracion,"respuesta"=>TRUE);
        }
    }
    
}

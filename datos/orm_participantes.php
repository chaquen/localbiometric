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

        $this->sentencia_sql="SELECT * FROM detalle_participantes WHERE user_id = $user_id AND event_id = $event_id";
        if($this->consultar_registros()==false){
            $this->sentencia_sql="INSERT INTO detalle_participantes (user_id,event_id) VALUES ('$user_id','$event_id')"; 

            if($this->insertar_registro()){
            //var_dump($this->respuesta_funcion);
                return array("mensaje"=> $this->mensajeDepuracion,
                    "respuesta"=>TRUE);
            }else{
                return array("mensaje"=>  $this->mensajeDepuracion,"respuesta"=>FALSE);
            }   
        }else{
            //actualizar horario
        }
                
        
    }    


    function obtener_registro_todos_los_registros(){
        $tbl=$this->TABLA;
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
                            `id_server`, 
                            `participantes`.`created_at`, 
                            `participantes`.`updated_at`,
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
        $this->sentencia_sql="SELECT ". trim($valores_a_retornar)." FROM ". trim($this->TABLA);

        if($valor!=""){
            $this->sentencia_sql.=" WHERE ".$valor;
        }
        
        //echo $this->sentencia_sql;
        
        
        if($this->consultar_registros()){
            return array("mensaje"=>$this->mensajeDepuracion,
                "respuesta"=>TRUE,
                "valores_consultados"=>$this->filas_json);
        }else{
            return array("mensaje"=>  $this->mensajeDepuracion,"respuesta"=> FALSE);
        }
        
    }
    
    function eliminar_recurso(){
        $this->sentencia_sql="SELECT () as respuesta";
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
                                                        estado_registro = 'registro'
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

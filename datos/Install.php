<?php

require_once '../datos/constantes.php';
require_once '../utilidades/CurlUse.php';


class Install {
    
    
    
    public function __construct() {
        
    }
 	
    public function validar_db(){
    	$conectar = mysqli_connect( DB_HOST, DB_USUARIO, DB_CLAVE,DB_NOMBRE_DATABASE);
    	if (mysqli_connect_errno()){
		  	return false;
		}else{
			return true;
		}


    }
 	public function crea_db(){

		$conectar = mysqli_connect( DB_HOST, DB_USUARIO, DB_CLAVE);

		$var =DB_NOMBRE_DATABASE;
		$consulta ="CREATE DATABASE $var";
		$resultado=mysqli_query($conectar,$consulta);
		if($resultado){
			$conn =new mysqli(DB_HOST, DB_USUARIO, DB_CLAVE , DB_NOMBRE_DATABASE);

			$query = '';
			$curluse=new CurlUse();
			$curluse->descargar_archivo("https://biometric.mohansoft.com/db/archivo/sql/db_ong_local.sql","../db/sql/db_ong_local.sql");
			$sqlScript = file('../db/sql/db_ong_local.sql');
			foreach ($sqlScript as $line)   {
			        
			        $startWith = substr(trim($line), 0 ,2);
			        $endWith = substr(trim($line), -1 ,1);
			        
			        if (empty($line) || $startWith == '--' || $startWith == '/*' || $startWith == '//') {
			                continue;
			        }
			                
			        $query = $query . $line;
			        if ($endWith == ';') {
			                mysqli_query($conn,$query) or die('<div class="error-response sql-import-response">Problem in executing the SQL query <b>' . $query. '</b></div>');
			                $query= '';             
			        }
			}
			echo '<div class="success-response sql-import-response">SQL file imported successfully</div>';	
		}else{
			mysqli_error($conectar);
			//falta msn error
			echo "falta msn error";
		}


 		
 	}   
}
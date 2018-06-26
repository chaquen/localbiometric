<?php
header('Access-Control-Allow-Origin: *'); 
include("../datos/orm_core.php");
$conn = new mysqli(DB_HOST, DB_USUARIO, DB_CLAVE,DB_NOMBRE_DATABASE);
$objeto= new Participantes();
$evento=new Eventos();
$user=new Users();
$down=new CurlUse();

$ch = curl_init();
// definimos la URL a la que hacemos la petición

$us=json_decode($_REQUEST["datos"]);
//var_dump($us);
//curl_setopt($ch, CURLOPT_URL,"http://localhost/api_biometric/preparar");
curl_setopt($ch, CURLOPT_URL,"https://biometric.mohansoft.com/preparar");

// recibimos la respuesta y la guardamos en una variable
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// indicamos el tipo de petición: GET
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array("datos"=>array("usuario"=>$us->datos->user,"clave"=>$us->datos->pass,"id"=>$us->datos->id))));
 

$remote_server_output = curl_exec ($ch);
 
// cerramos la sesión cURL
curl_close ($ch);
 
// hacemos lo que queramos con los datos recibidos
// por ejemplo, los mostramos
//var_dump($remote_server_output)
//print_r($remote_server_output);
$da=json_decode($remote_server_output);

//var_dump($da);
//
$res=$user->crear_registro($da->usuario);
//var_dump($res);

	$i=0;

	foreach ($da->eventos as $key => $value) {
		//	var_dump($value);
		$evento=new Eventos();	
		$resp[$i]=$evento->crear_registro($value);
		$i++;
		$dir="../files/events/".$value->id;
		if(!file_exists($dir)){
			mkdir($dir, 0700);
		}
		

		
		$down->descargar_archivo("http://pdpmagdalenacentro.org/assets/private/atachments/events/".$value->atachments,$dir."/".$value->atachments);
	}	

	
	//foreach ($da->participantes as $key => $value) {
		//var_dump($da->participantes[0]);

		//$par=new Participantes();	
		//$par->crear_registro($da->participantes[0]);
		
	//}
		$objeto->eliminar_recurso("estado_registro = 'antiguo'");
		foreach($da->participantes as $pp){
			foreach ($pp as $key => $value) {
                $$key=$value;
         	}

         		
	         	$huela=mysqli_escape_string($conn,convert_uudecode($huella_binaria));
			
				$sql = "INSERT INTO participantes (	id,
													tipo_doc,
													documento,
													lugar_exp,
													pri_apellido,
													seg_apellido,
													pri_nombre,
													seg_nombre,
													ciud_nacimiento,
													dep_nacimiento,
													fecha_nac,
													edad,
													genero,
													cap_dife,
													etnia,
													zona,
													municipio,
													celular,
													email,
													escolaridad,
													titulo_obt,
													proceso,
													organizacion,
													state,
													estado_registro,
													created_at,
													updated_at,
													tipo_registro,
													huella_binaria) 
	                                  VALUES ('$id',
	                                  		  '$tipo_doc',
	                                  		  '$documento',
	                                  		  '$lugar_exp',
	                                  		  '$pri_apellido',
	                                  		  '$seg_apellido',
	                                  		  '$pri_nombre', 
	                                  		  '$seg_nombre',
	                                  		  '$ciud_nacimiento',
	                                  		  '$dep_nacimiento',
	                                  		  '$fecha_nac',
	                                  		  '$edad',
	                                  		  '$genero',
	                                  		  '$cap_dife',
	                                  		  '$etnia',
	                                  		  '$zona',
	                                  		  '$municipio',
	                                  		  '$celular',
	                                  		  '$email',
	                                  		  '$escolaridad',
	                                  		  '$titulo_obt',
	                                  		  '$proceso',
	                                  		  '$organizacion',
	                                  		  '$state',
	                                  		  'null',
	                                  		  '$created_at',
	                                  		  '$updated_at',
	                                  		  'antiguo',
	                                  		  '".$huela."')";

	           
		        if ($conn->query($sql) === TRUE) {
					//echo "New record created successfully";
				} else {
					//echo "Error: " . $sql . "<br>" . $conn->error;
				}	
		}
		   	
        


	$conn->close();
	echo json_encode($resp);






//REGISTRAR EN BD

?>

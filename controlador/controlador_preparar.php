<?php
//seleccionar el vento y los registros para registrar

include("../datos/orm_core.php");
$objeto= new Participantes();
$evento=new Eventos();
$user=new Users();

$ch = curl_init();
// definimos la URL a la que hacemos la petición

$us=json_decode($_REQUEST["datos"]);
//var_dump($us);
curl_setopt($ch, CURLOPT_URL,"http://localhost/api_biometric/preparar");

// recibimos la respuesta y la guardamos en una variable
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// indicamos el tipo de petición: GET

curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array("datos"=>array("usuario"=>$us->datos->user,"clave"=>$us->datos->pass,"id"=>$us->datos->id))));
 

$remote_server_output = curl_exec ($ch);
 
// cerramos la sesión cURL
curl_close ($ch);
 
// hacemos lo que queramos con los datos recibidos
// por ejemplo, los mostramos
//var_dump($remote_server_output);
//print_r($remote_server_output);
$da=json_decode($remote_server_output);
echo "usuario=>";
echo "</br>";
//var_dump($da->usuario);
echo "</br>";
echo "respuesta=>";

//var_dump($da->respuesta);
echo "</br>";


echo "eventos=>";
echo "</br>";

//var_dump($da);
//
$res=$user->crear_registro($da->usuario);
//var_dump($res);
if($res["respuesta"]){
	foreach ($da->eventos as $key => $value) {
		$evento=new Eventos();
		$evento->crear_registro($value);
	}	
}else{
	echo "usuario ya exitse";
}




//REGISTRAR EN BD

?>

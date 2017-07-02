<?php
session_start();
require_once("class.php");
require_once "config.php";

$tra=new trabajo($host_name,$user_name,$pass_word,$database_name);

//print_r($_POST);

$provincia="Buenos Aires";
$localidad=$_POST['textolocal'];
$calle=$_POST['course'];
$numero=$_POST['numero'];


// excepcion
if($calle=="Av Santa Fe" AND $localidad=="Barrio Norte")
{
$localidad="Ciudad Autonoma de Buenos Aires";
}
// excepcion

//  hay un problema con la calle Av Santa Fe y la localidad barrio norte se hara una excepcion de que cuando se elija
// esos valores se cambiaran barrio norte por ciudad autonoma de buenos aires,auque estara en la lista barrio norte ya que afecta a 
!//   otros consultorios, pero funcionan correctamente

// otros datos   "numericos"

$zona=$_POST['zona'];
$id_localidad=$_POST['localidad'];
$especialidad=$_POST['medica'];
$nombre_medico=$_POST['nombre_medico'];
$tel=$_POST['tel'];




$direccion=$calle."&nbsp;".$numero.",&nbsp;".$localidad.",&nbsp;".$provincia;

//$direccion="Zeballos 1922, Beccar, Buenos Aires";   DIRECCION DE EJEMPLO


$resultado = json_decode(file_get_contents(sprintf('http://maps.google.com/maps/geo?q=%s&#8217;', urlencode($direccion))));

$estado = $resultado->Status->code;

if ($estado == 200)
{
$long = $resultado->Placemark[0]->Point->coordinates[0];
$lat = $resultado->Placemark[0]->Point->coordinates[1];

//  echo  "<br>La LAT  es ".$lat."<br>";
//   echo "La LONG es". $long."<br>";
// return “{$lat}, {$long}”;

$carga=$tra->insertar_consul($calle,$numero,$zona,$id_localidad,$especialidad,$nombre_medico,$tel,$lat,$long);


if($carga)
{
$_SESSION['agregado']=1;
header ("Location: agregar.php");	

}



}
else
{

echo "ERROR: NO SE PUDO OBTENER DATOS DE GOOGLE MAPS, VUELVA A INTENTARLO";

}


















?>
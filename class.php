<?php
require_once "config.php";

class conectar{

	var $host_name;
	var $user_name;
	var $pass_word;
	var $database_name;

	public function __construct($a,$b,$c,$d) {

      $this->host_name     = $a;                
      $this->user_name     = $b; 
      $this->pass_word     = $c;
      $this->database_name = $d;

    }    

	public static function con($host_name,$user_name,$pass_word,$database_name)
	{

		$con=mysql_connect($host_name,$user_name,$pass_word);
		mysql_query("SET NAMES 'utf8'");
		mysql_select_db($database_name);
		return $con;

	}

	public static function corta_palabra($palabra,$num)
	{
		$largo=strlen($palabra); // indicarme el largo de la cadena
		$cadena=substr($palabra,0,$num);
		return $cadena;
	}

}


class trabajo 
{
private $dato_usu = array();
private $matriz = array();
private $interes = array();
private $imagenes = array();
private $noticias = array();
private $cantidad;  
private $reg2;  
private $cat2 = array();
private $reg;  
private $cat = array();
private $post = array();
private $comentarios = array();
private $ultimas = array();
private $busquedas = array();
var $host_name;
var $user_name;
var $pass_word;
var $database_name;


public function __construct($a,$b,$c,$d) {

  $this->host_name     = $a;                
  $this->user_name     = $b; 
  $this->pass_word     = $c;
  $this->database_name = $d;

}  



public function crear_xml($datos)
{

if(file_exists("js/marcadores.xml")){



 	unlink('js/marcadores.xml');

}
// exit; 

$doc= new DOMdocument();

$doc->formatOutput=true;
$r= $doc->createElement ("markers");   //  genero un elemento...
$doc->appendChild($r);   //  agrego el elemento 

foreach($datos as $d)
{
$b = $doc->createElement("marker");


$latitud=$doc->createElement("latitud");
$latitud->appendChild($doc->createTextNode($d["latitud"]) );
$b->appendChild($latitud);

$longitud=$doc->createElement("longitud");
$longitud->appendChild($doc->createTextNode($d["longitud"]) );
$b->appendChild($longitud);

$nombre_medico=$doc->createElement("nombre_medico");
$nombre_medico->appendChild($doc->createTextNode($d["medico"]) );
$b->appendChild($nombre_medico);

$calle=$doc->createElement("calle");
$calle->appendChild($doc->createTextNode($d["calle"]) );
$b->appendChild($calle);

$numero=$doc->createElement("numero");
$numero->appendChild($doc->createTextNode($d["numero"]) );
$b->appendChild($numero);

$zona=$doc->createElement("zona");
$zona->appendChild($doc->createTextNode($d["zona"]) );
$b->appendChild($zona);

$localidad=$doc->createElement("localidad");
$localidad->appendChild($doc->createTextNode($d["localidad"]) );
$b->appendChild($localidad);

$especialidad=$doc->createElement("especialidad");
$especialidad->appendChild($doc->createTextNode($d["especialidad"]) );
$b->appendChild($especialidad);

$telefono=$doc->createElement("telefono");
$telefono->appendChild($doc->createTextNode($d["telefono"]) );
$b->appendChild($telefono);

$r->appendChild($b);


}

//  echo $doc->saveXML();

if($doc->save("js/marcadores.xml"))
{
	return true;

}
else
{
	return false;
}

}



public function trae_zonas()
{
$sql="select * from zonas";


$res=mysql_query($sql,conectar::con($this->host_name,$this->user_name,$this->pass_word,$this->database_name));

while ($reg=mysql_fetch_assoc($res))
{
$this->cat[]=$reg;
}
return $this->cat;
}


public function simulacion($zona,$especialidad)
{


$sql="SELECT c.calle, c.numero, z.zona, l.descripcion as localidad, e.descripcion as especialidad, c.nombre_medico as medico, c.telefono, c.latitud, c.longitud
FROM consultorio c
INNER JOIN zonas z ON c.zona = z.id
INNER JOIN localidad l ON c.localidad = l.id_localidad
INNER JOIN especialidad e ON c.especialidad = e.id_esp
WHERE c.zona =$zona
AND c.especialidad =$especialidad";

//$sql="select *  from consultorio where zona=$zona and especialidad=$especialidad";

$res=mysql_query($sql,conectar::con($this->host_name,$this->user_name,$this->pass_word,$this->database_name));

while ($reg=mysql_fetch_assoc($res))
{
$this->cat[]=$reg;
}
return $this->cat;

} 


public function insertar_consul($calle,$numero,$zona,$id_localidad,$especialidad,$nombre_medico,$tel,$lat,$long)
{


$sql="
INSERT INTO `misconsultorios`.`consultorio` (
`id_consultorio` ,
`calle` ,
`numero` ,
`zona` ,
`localidad` ,
`especialidad` ,
`nombre_medico` ,
`telefono` ,
`latitud` ,
`longitud`
)
VALUES (
NULL , '".strip_tags($calle)."','".strip_tags($numero)."','".strip_tags($zona)."','".strip_tags($id_localidad)."', '".strip_tags($especialidad)."','".strip_tags($nombre_medico)."','".strip_tags($tel)."','$lat','$long'); ";


if(mysql_query($sql,conectar::con($this->host_name,$this->user_name,$this->pass_word,$this->database_name)))
{
return 1;
}

}

public function buscausu($usu,$pass)
{

	$sql="select * from administrador where usuario='$usu' and pass='$pass'";

	$dato_usu=mysql_query($sql,conectar::con($this->host_name,$this->user_name,$this->pass_word,$this->database_name));

	$cantidad=mysql_num_rows($dato_usu);

	if($cantidad==1)
	{

	$row=mysql_fetch_array($dato_usu);

		$_SESSION['usuario'] = $row["usuario"];
		$_SESSION['id_usu']  = $row["id_admin"];

	return 1;
	}
	else
	{
	return 0;
	}

}

}

?>
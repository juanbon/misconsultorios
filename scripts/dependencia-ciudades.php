<?php
include("clases/class.mysql.php");
include("clases/class.combos.php");
require_once "../config.php";

$ciudades = new selects($host_name,$user_name,$pass_word,$database_name);

$ciudades->code = $_GET["code"];
$ciudades = $ciudades->cargarCiudades();
foreach($ciudades as $key=>$value)
{
		echo "<option value=\"$key\">$value</option>";
}
?>
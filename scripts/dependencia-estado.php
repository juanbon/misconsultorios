<?php
include("clases/class.mysql.php");
include("clases/class.combos.php");
require_once "../config.php";

$estados = new selects($host_name,$user_name,$pass_word,$database_name);
$estados->code = $_GET["code"];
$estados = $estados->cargarEstados();
foreach($estados as $key=>$value)
{
		echo "<option value=\"$key\">$value</option>";
}
?>
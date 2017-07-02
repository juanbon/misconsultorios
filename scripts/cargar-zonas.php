<?php
include("clases/class.mysql.php");
include("clases/class.combos.php");
require_once "../config.php";

$selects = new selects($host_name,$user_name,$pass_word,$database_name);

$zonas = $selects->cargarzonas();
foreach($zonas as $key=>$value)
{
		echo "<option value=\"$key\">$value</option>";
}
?>
<?php
require_once "config.php";
$q = strtolower($_GET["q"]);
if (!$q) return;

$sql = "select DISTINCT descripcion from calles where descripcion LIKE '%$q%'";
$rsd = mysql_query($sql);
while($rs = mysql_fetch_array($rsd)) {
	$cname = $rs['descripcion'];
	echo utf8_encode($cname)."\n";   
}
?>
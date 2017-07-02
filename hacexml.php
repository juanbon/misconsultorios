<?php

require_once "config.php";
include("class.php");


$zona=$_GET["zona"];
$especialidad=$_GET["especialidad"];



$datos=array();

$tra=new trabajo ($host_name,$user_name,$pass_word,$database_name);





$datos=$tra->simulacion($zona,$especialidad);


$creado=$tra->crear_xml($datos);

if($creado)
{
echo 1;
}
else
{
echo 0;
}













?>
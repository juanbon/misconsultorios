<?php
session_start();
include("class.php");
require_once "config.php";

$usu=$_GET["usu"];
$pass=$_GET["pass"];

$datos = array();

$tra = new trabajo ($host_name,$user_name,$pass_word,$database_name);

$datos=$tra->buscausu($usu,$pass);

if($datos==1)
{
	echo 1;

}
else
{
	echo 0;
}













?>
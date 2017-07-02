<?php

class MySQL
{

  var $conexion;
  var $host_name;
  var $user_name;
  var $pass_word;
  var $database_name;

  function __construct($a,$b,$c,$d) {

      $this->host_name     = $a;                
      $this->user_name     = $b; 
      $this->pass_word     = $c;
      $this->database_name = $d;    

      if(!isset($this->conexion))
    {

        $this->conexion = (mysql_connect($this->host_name,$this->user_name,$this->pass_word)) or die(mysql_error());
        mysql_select_db($this->database_name,$this->conexion) or die(mysql_error());
    }             
    
  }


 function consulta($consulta)
 {

	$resultado = mysql_query($consulta,$this->conexion);
  	if(!$resultado)
	{
  		echo 'MySQL Error: ' . mysql_error();
	    exit;
	}
  	return $resultado; 
  }
  
 function fetch_array($consulta)
 { 
  	return mysql_fetch_array($consulta);
 }
 
 function num_rows($consulta)
 { 
 	 return mysql_num_rows($consulta);
 }
 
 function fetch_row($consulta)
 { 
 	 return mysql_fetch_row($consulta);
 }
 function fetch_assoc($consulta)
 { 
 	 return mysql_fetch_assoc($consulta);
 } 
 
}

?>
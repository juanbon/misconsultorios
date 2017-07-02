<?php

class selects extends MySQL
{

	var $code = "";

	function cargarzonas()
	{
		$consulta = parent::consulta("SELECT * FROM zonas");
		$num_total_registros = parent::num_rows($consulta);
		if($num_total_registros>0)
		{
			$paises = array();
			while($pais = parent::fetch_assoc($consulta))
			{
				$code = $pais["id"];
				$name = $pais["zona"];				
				$paises[$code]=$name;
			}
			return $paises;
		}
		else
		{
			return false;
		}
	}
	
	
	function cargarEstados()
	{
		$consulta = parent::consulta("SELECT * FROM localidad WHERE id_zona = '".$this->code."' order by descripcion");
		$num_total_registros = parent::num_rows($consulta);
		if($num_total_registros>0)
		{
			$estados = array();
			while($estado = parent::fetch_assoc($consulta))
			{
			$code = $estado["id_localidad"];
				$name = utf8_encode($estado["descripcion"]);				
				$estados[$code]=$name;
			}
			return $estados;
		}
		else
		{
			return false;
		}
	}
		
		
		function cargarmedica()
	{
	
	
		$consulta = parent::consulta("select z.id_especialidad,e.descripcion 
from zona_especialidad as z,especialidad as e where z.id_especialidad=e.id_esp and z.id_zona = '".$this->code."'");
		$num_total_registros = parent::num_rows($consulta);
		if($num_total_registros>0)
		{
			$estados = array();
			while($estado = parent::fetch_assoc($consulta))
			{
			$code = $estado["id_especialidad"];
				$name = utf8_encode($estado["descripcion"]);				
				$estados[$code]=$name;
			}
			return $estados;
		}
		else
		{
			return false;
		}
	}
		
		
	function cargarCiudades()
	{
		$consulta = parent::consulta("SELECT Name FROM city WHERE Province = '".$this->code."'");
		$num_total_registros = parent::num_rows($consulta);
		if($num_total_registros>0)
		{
			$ciudades = array();
			while($ciudad = parent::fetch_assoc($consulta))
			{
				$name = $ciudad["Name"];				
				$ciudades[$name]=$name;
			}
			return $ciudades;
		}
		else
		{
			return false;
		}
	}	

}
?>
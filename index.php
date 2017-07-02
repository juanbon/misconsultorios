<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
session_start();
ob_start();
require_once "config.php";

header( 'Content-Type: text/html;charset=utf-8' );  

?>
<html>
<head>
	<style>
	@font-face {
	/*Insertamos la ruta donde se
	encuentra el archivo de la tipografia
	y el formato de la tipografia*/
	font-family: "font_nueva";
	src: url(<?php echo $url_local; ?>/css/font/halidians_blockserif.ttf) format("truetype");
	}
	</style>
	<title>Encuentra tus consultorios medicos facilmente!</title>
    <link rel="stylesheet" type="text/css" href="css/960.css"></link>
	<link rel="stylesheet" type="text/css" href="css/reset.css"></link>
	<link rel="stylesheet" type="text/css" href="css/text.css"></link>
	<link rel="stylesheet" type="text/css" href="css/estilo.css"></link>					
	<script type="text/javascript" src="js/jquery.js"></script>
	<script> var link = "<?php echo $url_local;?>"; </script>
	<script type="text/javascript" src="js/markers.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyAk4aQbHZywurOgSr-bL2PTEJF101E5Fgo"></script>
		
<script type="text/javascript">
	$().ready(function() {

		cargar_zonas();
		// $("#zona").change(function(){dependencia_localidad();});
		$("#zona").change(function(){dependencia_medica();});
		$("#localidad").attr("disabled",true);
		$("#medica").attr("disabled",true);

		$('#localidad').change(function(){
	    var selectedOption = $(this).find('option:selected');
	    var selectedLabel = $(selectedOption).text();

		  $("#textolocal").val(selectedLabel);
		
	}).change();
			
});

	
function cargar_zonas()
{
	$.get("scripts/cargar-zonas.php", function(resultado){
		if(resultado == false)
		{
			alert("Error");
		}
		else
		{
			$('#zona').append(resultado);			
		}
	});	
}


/*
function dependencia_localidad()
{
	var code = $("#zona").val();
	
		$.get("scripts/dependencia-estado.php", { code: code },
		function(resultado)
		{
			if(resultado == false)
			{
				alert("Error");
			}
			else
			{
				$("#localidad").attr("disabled",false);
				document.getElementById("localidad").options.length=1;
				$('#localidad').append(resultado);			
			}
		}

	);
	
}
*/


function dependencia_medica()
{
		var code = $("#zona").val();
	
		$.get("scripts/dependencia-medica.php", { code: code },
		function(resultado)
		{
			if(resultado == false)
			{
				alert("Error");
			}
			else
			{
				$("#medica").attr("disabled",false);
				document.getElementById("medica").options.length=1;
				$('#medica').append(resultado);			
			}
		}

	);
	
}

</script>										
<style type="text/css">
  html { height: 100% }
  body { height: 100%; margin: 0px; padding: 0px }
  #map { height: 100% }
</style>
</head>
<body >

<div class="container_12">
<?php 
include ("cabecera.php");
?>
	<div class="clear"></div>
	<div class="grid_12" style="background-color:white;" >
	<div id="mensaje" style="font-weight:bold" >Seleccione su ubicacion y especialidad medica que busca</div>
	<div id="selects" style="padding-left:20px;widht:760px;height:50px;background-color:#14140C;color:white">
		
	<!--	<a href="http://localhost/misconsultorios.com/agregar.php">ir a agregar</a>     -->
		
	<div style="float:left;font-weight:bold;line-height:50px;width:320px;height:50px;">
	SELECCIONE ZONA:      
	
	<select id="zona" name="zona"  style="width:180px;"   >
        <option value="0">Seleccionar...</option>
    </select></div>
		
	<div style="float:left;font-weight:bold;line-height:50px;width:450px;height:50px;">
		ESPECIALIDAD MEDICA:      
	 <select id="medica" name="medica"  style="width:270px;"   >
            <option value="0">Selecciona una especialidad...</option>
        </select>
		</div>
		<div style="float:left;font-weight:bold;width:148px;height:50px;">
		<div style="clear:both;font-weight:bold;width:100px;height:10px;">
		</div>
		
		<div style="clear:both;font-weight:bold;width:140px;height:32px;cursor:pointer">
		<img  title="Localizar en mapa" id="mostrar_marcad" width="100px" height="32px"  src="image/boton.png">
		<div style="float:left;background-color:yellow;width:10px"></div>&nbsp;&nbsp;
		<img id="limpiar" title="Limpiar mapa" src="image/borrar.png" width="20px" height="20px">
		
		</div>
		</div>
	
	</div>
	<div id="map" ></div>
	</div>
	<div class="clear"></div>

    <div class="grid_12" id="pie" style="text-align:center">
        <p>
		Contacto | Desarrollado por Juan Bonifacio | Portada
		</p>
    </div>
	<div class="clear"></div>
</div>
</body>
</html>

<?php
session_start();
ob_start();
require_once "config.php";

//  $_SESSION['agregado']=1;

	if((isset($_SESSION['agregado'])))
		{
		if(($_SESSION['agregado']==1))
		{
		?>
		<script>
		alert("El consultorio se agrego correctamente!");
		</script>
		<?php
		$_SESSION['agregado']=0;
		}
		}


	if((!(isset($_SESSION['usuario']))) OR (!(isset($_SESSION['id_usu'])) ))
		{
		
		header('Location: '.$url_local.'/'); 

		}

		header( 'Content-Type: text/html;charset=utf-8' );  
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html>
<head>

<META http-equiv=Content-Type content="text/html; charset=utf-8">

	<title>Misconsultorios.com</title>
	<script> var link = "<?php echo $url_local;?>"; </script>
    <link rel="stylesheet" type="text/css" href="css/960.css"></link>
	<link rel="stylesheet" type="text/css" href="css/reset.css"></link>
	<link rel="stylesheet" type="text/css" href="css/text.css"></link>
	<link rel="stylesheet" type="text/css" href="css/estilo.css"></link>			
	<link rel="stylesheet" href="css/formu/screen.css" media="screen" />
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type='text/javascript' src='js/funciones.js'></script>
	<script type='text/javascript' src='js/jquery.autocomplete.js'></script>
	<link rel="stylesheet" type="text/css" href="css/jquery.autocomplete.css" />

<script type="text/javascript">
$().ready(function() {


	cargar_zonas();
	// $("#zona").change(function(){dependencia_localidad();});
	$("#zona").change(function(){dependencia_medica();});
	$("#localidad").attr("disabled",true);
	$("#medica").attr("disabled",true);

	$("#titprin").click(function(e){    
	//   tendria que tomar los valores   de option 1 y 2.. se los paso al archivo hacexml asi este lo pasa a la clase
	//  despues que el jquery me devuelva 1,  voy a ese archivo
	

	var pagina= link+"/";
	location.href=pagina;

  });
  
	
	$('#localidad').change(function(){
    var selectedOption = $(this).find('option:selected');
    var selectedLabel = $(selectedOption).text();

	$("#textolocal").val(selectedLabel);
	
}).change();


	$("#course").autocomplete("get_course_list.php", {
		width: 280,
		matchContains: true,
		//mustMatch: true,
		//minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});
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
	nuevo{color:red}

</style>		
					
</head>

<body style="background-color:black">

<div class="container_12">

<?php 

include ("cabecera.php");

?>

	<div class="clear"></div>
	<div class="grid_12" style="height:760px;background-color:white;" >
	<div id="mensaje">Complete los datos del consultorio a ingresar</div>	
	<div  style="top:-13px;position:relative" class="corpo">
	<div  style="position:relative;left:270px;top:10px;width:400px">

			<form id="form2" action="recibo.php" method="post" autocomplete="off" >	
		
			<h3><div style="width:332px;height:40px;line-height:40px">Ingrese consultorio</div></h3>
		
			<fieldset><legend>Contact form</legend>
				<p class="first">
					Calle:
					<input name="course" id="course" style="text-align:center" type="text" size="30" />
				</p>
				<div  class="barra"  ></div>
				<p>
					N&uacute;mero:
					<input type="text" name="numero" style="text-align:center"  id="numero" size="30" />
				</p>
				<div  class="barra"  ></div>
				<p>Zona<br>
	        <select id="zona" name="zona"  style="width:270px;"   >
	            <option value="0">Selecciona Una zona...</option>
	        </select>
				</p>	
				<div  class="barra"  ></div>
			<p>Localidad
			<br>
	    <select id="localidad" name="localidad"  style="width:270px;"   >
            <option value="0">Selecciona una localidad...</option>
        </select>
		</p><div  class="barra"  ></div>
			<p>Especialidad Medica
			<br>
		<select id="medica" name="medica"  style="width:270px;"   >
            <option value="0">Selecciona una especialidad...</option>
        </select>
		 
				</p>				
				<div  class="barra"  ></div>
				<input type="hidden" id="textolocal" name="textolocal" value="">

				<p class="first">
					Nombre del Medico:
					<input name="nombre_medico" id="nombre_medico" style="text-align:center" type="text" size="30" />
				</p>
				<div  class="barra"  ></div>
				
				<p class="first">
					Telefono:
					<input name="tel" id="tel" style="text-align:center" type="text" size="30" />
				</p>
				<div  class="barra"  ></div>
				<p class="submit"><button type="submit">Enviar</button></p>		
							
			</fieldset>					
						
		</form>	
		</div>
		</div>
	</div>
	<div style="clear:both;width:700px;height:40px;"></div>
    <div class="grid_12" id="pie" style="clear:both;color:white;line-height:40px;height:40px;text-align:center">
		Contacto | Desarrollado por Juan Bonifacio | Portada     
    </div>
	<div class="clear"></div>
</div>
</body>
</html>

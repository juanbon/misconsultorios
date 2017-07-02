// var link = link+"/";

$(document).ready(function() {

  $("#map").css({
		height: 680,
		width: 940  
	});
	var myLatLng = new google.maps.LatLng(-34.60834520731577,-58.42632293701172);
  MYMAP.init('#map', myLatLng, 11);
  
  $("#showmarkers").click(function(e){    
  //   tendria que tomar los valores   de option 1 y 2.. se los paso al archivo hacexml asi este lo pasa a la clase
  //  despues que el jquery me devuelva 1,  voy a ese archivo
		MYMAP.placeMarkers('js/marcadores.xml?hola=ee');
  });
  
  
 $("#limpiar").click(function(e){    
  //   tendria que tomar los valores   de option 1 y 2.. se los paso al archivo hacexml asi este lo pasa a la clase
  //  despues que el jquery me devuelva 1,  voy a ese archivo
	
//alert("haz presionado el boton limpiar");

MYMAP.borrar('js/marcadores.xml');

  });
  
  
  
	
      $("#agregar").click(function(e){    
  //   tendria que tomar los valores   de option 1 y 2.. se los paso al archivo hacexml asi este lo pasa a la clase
  //  despues que el jquery me devuelva 1,  voy a ese archivo

		var pagina= link+"/agregar.php";
		location.href=pagina;

  });
  
  
  
  
        $("#titprin").click(function(e){    
  //   tendria que tomar los valores   de option 1 y 2.. se los paso al archivo hacexml asi este lo pasa a la clase
  //  despues que el jquery me devuelva 1,  voy a ese archivo
	
			var pagina= link+"/";
			location.href=pagina;

  });
  
  
  
      $("#entrar").click(function(e){    
  //   tendria que tomar los valores   de option 1 y 2.. se los paso al archivo hacexml asi este lo pasa a la clase
  //  despues que el jquery me devuelva 1,  voy a ese archivo
	
	
	var  usu =$("#user").val();
	
		var  pass= $("#pass").val();
  
  
  	if(usu=="" || pass =="")
	{
	
		return false;
	}
	
	  	if(usu=="usuario" || pass =="pass")
	{
	
		return false;
	}
   
  //consulto por ajax si el usuario existe....

  		 $.get('verifica.php',{
            usu:usu,
			pass:pass
        }, function(recibo){
		
		
	//	alert(recibo);
		
		if(recibo==1)
		{

			var pagina= link+"/";
			location.href=pagina;
	
		}
           else
		{
	
		alert("Usuario y password incorrectos");

		}		   
						 		 
      });  
  });
  

    $("#mostrar_marcad").click(function(e){    
  //   tendria que tomar los valores   de option 1 y 2.. se los paso al archivo hacexml asi este lo pasa a la clase
  //  despues que el jquery me devuelva 1,  voy a ese archivo
	
	
	var  zona =$("#zona").val();
	
		var  esp= $("#medica").val();
		
		
	if(zona==0 || esp == 0)
	{
	
return false;
	}
		else{
		
		MYMAP.borrar('js/marcadores.xml');
		
		$.get('hacexml.php',{
            zona:zona,
			especialidad:esp
        }, function(recibo){
		
		if(recibo==1)
		{
	//	alert("exitoso salio");

	var d = new Date();
	var n = d.getTime(); 


	MYMAP.placeMarkers('js/marcadores.xml?nocache='+n);
		}
           else
		{
		alert("Error de proceso");
		}		   
						 
				 
      });
		
	}

  });
});


var markers = [];   //   esta variable es global









var MYMAP = {
  map: null,
	bounds: null
}

MYMAP.init = function(selector, latLng, zoom) {
  var myOptions = {
    zoom:zoom,
    center: latLng,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  }
  this.map = new google.maps.Map($(selector)[0], myOptions);
	this.bounds = new google.maps.LatLngBounds();
}

MYMAP.placeMarkers = function(filename) {

  //   var markers = [];    //  declaro el array

	$.get(filename, function(xml){
		$(xml).find("marker").each(function(){
		
		
				
		
		
			var name = $(this).find('nombre_medico').text();
			var calle = $(this).find('calle').text();
			var numero = $(this).find('numero').text();
			var zona = $(this).find('zona').text();
			var localidad = $(this).find('localidad').text();
			var especialidad = $(this).find('especialidad').text();
			var telefono = $(this).find('telefono').text();
			
			
			// create a new LatLng point for the marker
			var lat = $(this).find('latitud').text();
			var lng = $(this).find('longitud').text();
			var point = new google.maps.LatLng(parseFloat(lat),parseFloat(lng));
			
			// extend the bounds to include the new point
			MYMAP.bounds.extend(point);
			
			var marker = new google.maps.Marker({
				position: point,
				map: MYMAP.map
			});
			
			markers.push(marker);   //   cargo el array
			
						
			var infoWindow = new google.maps.InfoWindow();
			var html='<strong><font color="red">'+especialidad+'</font></strong><br><strong>'+name+'</strong><br />'+calle+'&nbsp;'+numero+'&nbsp;-&nbsp;'+localidad+'<br>'+telefono;
			google.maps.event.addListener(marker, 'click', function() {
				infoWindow.setContent(html);
				infoWindow.open(MYMAP.map, marker);
			});
			MYMAP.map.fitBounds(MYMAP.bounds);
		});
			
	//nuevo
	if(markers.length==0)
	{
	
	alert("No se encontraron consultorios registrados para esta especialidad");
	
	}
	
	//nuevo
				
	});
	
}

//  borrar marcadores 

MYMAP.borrar = function(filename) {

//alert(markers.length);

        for (var i = 0; i < markers.length; i++) {
            markers[i].setMap(null);
        };
     
        markers= [];
    
	
}


function confirmacion(){


	var answer = confirm("Desea cerrar la sesion?")
	if (answer){

	var pagina= link+"/cerrar.php";
	location.href=pagina;

	}
	else{
		return false;
	}
}

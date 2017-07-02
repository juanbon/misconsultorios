$(document).ready(function(){  

	console.log(link);

	$("#form2").submit(function(){
			
		if($("#course").val().length ==0) {  
			alert("Ingrese una calle");
			return false;
		}

		if($("#course").val().length < 3) {  
			alert("La calle ingresada es muy corta");
			return false;
		}

		
		if($("#course").val().length > 13) {  
			alert("La calle ingresada es muy larga");
			return false;
		}
		  
	  
		if (!isNaN($("#course").val())) {
			alert("Debe ingresar texto");
			return false;
		}


		if($("#numero").val().length ==0) {  
			  alert("Ingrese una direccion");
			  return false;
		}
			
			
		if($("#numero").val().length > 5) {  
			  alert("El direccion ingresada es muy larga");
			  return false;
		 }
		  
		  
		 if (isNaN($("#numero").val())) {
			alert("La direccion debe contener solo numeros");
			return false;
		 }
		  	  
		  if($("#zona").val() == 0) {  
			  alert("Debe seleccionar una zona");
			  return false;
		  }
		  
		  	  	  
		  if($("#localidad").val() == 0) {  
			  alert("Debe seleccionar una localidad");
			  return false;
		  }
		  
  	  
		  if($("#medica").val() == 0) {  
			  alert("Debe seleccionar una especialidad medica");
			  return false;
		  }
		    	
		  if($("#nombre_medico").val().length ==0) {  
			  alert("Ingrese el nombre del medico");
			  return false;
		  }

		  if($("#nombre_medico").val().length < 3) {  
			  alert("El nombre ingresado es muy corto");
			  return false;
		  }
			
  
		  if (!isNaN($("#nombre_medico").val())) {
			alert("El nombre no puede contener numeros");
	  		return false;
		  }
		  
		  if($("#tel").val().length ==0) {  
			  alert("Ingrese una telefono");
			  return false;
		  }
			
		  
		  if($("#tel").val().length < 6) {  
			  alert("El telefono ingresado es muy corto");
			  return false;
		  }
		  	  
		  return true;	  
				
	});

});



function confirmacion(){

		var answer = confirm("Desea cerrar la sesion?")
		if (answer){

		var pagina=link+"/cerrar.php";
		location.href=pagina;

	}
	else{
		return false;
	}


}
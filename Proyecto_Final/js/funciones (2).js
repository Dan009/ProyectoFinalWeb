//Variables 
var cedula = document.getElementById('txtCedula');
var primeraClave = document.getElementById('txtPrimeraClave');
var segundaClave = document.getElementById('txtSegundaClave');
var claveAdmin = document.getElementById('txtClave');

function setearMascara(){
	$("[name=txtCedula]").inputmask({"mask":"999-9999999-9"});
	$("[name=txtCedula]").inputmask("999-9999999-9",{showMaskOnHover: false});
	$("[name=txtTelefono]").inputmask({"mask":"(999)-999-9999"});
	$("[name=txtTelefono]").inputmask("(999)-999-9999",{showMaskOnHover: false});
	validar();
	pestanas();
	initialize();
	setearDireccion();
	setearMapa();
	//saber();

}

function saber() {
  alert($("[name=txtLatitud]").val()+" ,"+$("[name=txtLongitud]").val());

}

function validar(){
	$("[name=txtPrimeraClave]").blur(function(){
		if (primeraClave.value.length >0 && primeraClave.value.length < 6) {
			$("#error1").removeClass("magia");
			$("#error2").addClass("error2");
			$("[name=txtPrimeraClave]").parent().get(0).setAttribute("class","error");
			$(".alert").remove("#mensaje");

		}else{
			$(".contraseña").removeClass("error");
			$("[name=txtPrimeraClave]").parent().get(0).setAttribute("class","");

		}

	});

	$("[name=txtSegundaClave]").blur(function(){
		if(primeraClave.value != segundaClave.value){
			$(".contraseña").addClass("error");
			$("#error1").addClass("error1");
			$("#error2").removeClass("magia");

		}else{
			$(".contraseña").removeClass("error");

		}

	});

	$("[name=txtPrimeraClave] , [name=txtSegundaClave]").focus(function(){
		$("#error1").removeClass(".magia");
		$("#error2").removeClass(".magia");

	});

	$("[name=txtClave]").blur(function(){
		if (claveAdmin.value.length >0 && claveAdmin.value.length < 6) {
			$("#error1").addClass("magia");
			$("[name=txtClave]").parent().get(0).setAttribute("class","error");
			$("#error1").removeClass("magia");
			$(".alert").remove("#mensaje");

		}else{
			$(".contraseña").removeClass("error");
			$("[name=txtClave]").parent().get(0).setAttribute("class","");

		}

	});

}

function pestanas(){
	$('#perfil').removeClass("fade");
	$('#perfil').addClass("active");

}

function initialize() {
  geocoder = new google.maps.Geocoder();
    

  // Aqui seteamos la latitud y longitud, en este caso la de santo domingo
  var latLng = new google.maps.LatLng(18.505331,-69.986397);

  //Definimos algunas opciones 
   var myOptions = {
      center: latLng, //centro del mapa
      zoom: 12,//zoom del mapa
      mapTypeId: google.maps.MapTypeId.ROADMAP, //tipo de mapa, carretera, híbrido,etc
    }; 


    //creamos el mapa con las opciones y le se lo pasamos a un div
    map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
     
    //creamos el marcador en el mapa
    marker = new google.maps.Marker({
        map: map,//el mapa creado en el paso anterior
        position: latLng,//objeto con latitud y longitud
        draggable: true //que el marcador se pueda arrastrar

    });
    
   //función que actualiza los input del formulario con las nuevas latitudes
   //Estos campos suelen ser hidden
    updatePosition(latLng);
         
}

function setearDireccion(){
	$("[name=txtDireccion]").val($("[name=txtProvincia]").val()+", ");
	obtenerDireccion();

}

function setearMapa(){
	$("[name=txtDireccion]").blur(function(){
		obtenerDireccion();

	});

}

function obtenerDireccion(){
     var address = document.getElementById("direccion").value;
        //hago la llamada al geodecoder
        geocoder.geocode( { 'address': address}, function(results, status) {
        //si el estado de la llamado es OK
        if (status == google.maps.GeocoderStatus.OK) {
            //centro el mapa en las coordenadas obtenidas
            map.setCenter(results[0].geometry.location);
            //coloco el marcador en dichas coordenadas
            marker.setPosition(results[0].geometry.location);
            //actualizo el formulario     
            updatePosition(results[0].geometry.location);
             
            //Añado un listener para cuando el markador se termine de arrastrar
            //actualize el formulario con las nuevas coordenadas
            google.maps.event.addListener(marker, 'dragend', function(){
                updatePosition(marker.getPosition());

            });

      } else {
          //si no es OK devuelvo error
          alert("No podemos encontrar la direcci&oacute;n, error: " + status);
          
      }
    });

}

  function updatePosition(latLng){
       
       jQuery('#lat').val(latLng.lat());
       jQuery('#long').val(latLng.lng());
   
  }

// function presentarID(id) {
// 	window.location = window.location+'&id='+id;


// }

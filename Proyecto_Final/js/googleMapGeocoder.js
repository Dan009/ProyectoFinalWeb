//Declaramos las variables que vamos a user
var lat = null;
var lng = null;
var map = null;
var geocoder = null;
var marker = null;
         
jQuery(document).ready(function(){
     //Conseguimos los valores 
     lat = jQuery('#lat').val();
     lng = jQuery('#lng').val();

     //Inicializamos la función de google maps una vez cargada la pagina
    initialize();

});
     
    function initialize() {
      geocoder = new google.maps.Geocoder();
      
      // Aqui seteamos la latitud y longitud, en este caso la de santo domingo
      var latLng = new google.maps.LatLng(18.505331,-69.986397);
    
      //Definimos algunas opciones del mapa a crear
       var myOptions = {
          center: latLng, //centro del mapa
          zoom: 12, //zoom del mapa
          mapTypeId: google.maps.MapTypeId.ROADMAP //tipo de mapa, carretera, etc
             
          }; 


        //creamos el mapa con las opciones y le se lo pasamos a un div
        map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
         
        //creamos el marcador en el mapa
        marker = new google.maps.Marker({
            map: map, //el mapa creado anteriormente
            position: latLng, //objeto con latitud y longitud
            draggable: true //que el marcador se pueda arrastrar

        });
        
       //función que actualiza los input del formulario con las nuevas latitudes
         // google.maps.event.addListener(marker, 'dragend', function(){   
         //    obtenerDireccion();

         //  });

        
         
    }
     
    //funcion que traduce la direccion en coordenadas
    function obtenerDireccion() {
        //consigo la direccion del formulario
        var address = document.getElementById("direccion").value;

        //hago la llamada al geodecoder
        geocoder.geocode( { 'address': address}, function(results, status) {
         
        //si el estado de la llamado es OK
        if (status == google.maps.GeocoderStatus.OK) {
            //centro el mapa en las coordenadas obtenidas
            //map.setCenter(results[0].geometry.location);
            //coloco el marcador en dichas coordenadas
            //marker.setPosition(results[0].geometry.location);
            //actualizo el formulario 
            //updatePosition(marker.getPosition()); 

            //llamo nuevamente a la función que actualiza los input del formulario
            //con las nuevas latitudes por si el usuario tiene una ubicacion mas
            //especifica

           //  google.maps.event.addListener(marker, 'dragend', function(){   
           //      alert("dlkfn;asldf");
           //      var latilongitud = marker.getPosition();
           //      map.setCenter(latilongitud);
           //      marker.setPosition(latilongitud);
           //      updatePosition(latilongitud);

           // });

             
            //Añado un listener para cuando el marcador se termine de arrastrar
            //actualizo el formulario con las nuevas coordenadas
          
      } else {
          //si no es OK devuelvo error
          alert("No podemos encontrar la direcci&oacute;n, error: " + status);

      }

    });
  }
   
  //funcion que simplemente actualiza los campos del formulario
  function updatePosition(latLng){
       alert(latLng);
       jQuery('#lat').val(latLng.lat());
       jQuery('#lng').val(latLng.lng());
   
  }

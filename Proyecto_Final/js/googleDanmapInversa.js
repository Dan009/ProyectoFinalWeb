//Variables
var map;
var marker;
var infowindow = new google.maps.InfoWindow();
var geocoder = new google.maps.Geocoder();
var geocoder2 = new google.maps.Geocoder();

  jQuery(document).ready(function(){
    //Inicializamos la función de google maps una vez el DOM este cargado
    initialize();

  });
     
  function initialize() {
    // Variable de coordenada
    var latLng = new google.maps.LatLng(18.505331,-69.986397);

     var myOptions = {
      center: latLng,//centro del mapa
      zoom: 10,//zoom del mapa
      mapTypeId: google.maps.MapTypeId.ROADMAP //tipo de mapa, carretera, híbrido,etc

    }; 

    //creamos el mapa con las opciones anteriores y le pasamos el elemento div
    map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

  }

  function  buscarDireccion() {

    var coor = $("#direccion").val();
    var latlngStr = coor.split(',',2);
    var lat = parseFloat(latlngStr[0]);
    var longitud = parseFloat(latlngStr[1]);
    var latlng = new google.maps.LatLng(lat,longitud);

    geocoder.geocode({'latLng': latlng},function(resultados,status){
        if (status == google.maps.GeocoderStatus.OK) {
          if (resultados[0]){
            map.fitBounds(resultados[0].geometry.viewport);

            marker = new google.maps.Marker({
              map: map,
              position: latlng,
              draggable: true 

            });

            google.maps.event.addListener(marker, 'dragend', function(){
                  var coor = new String(marker.getPosition());
                  var latlong = coor.split(',',2);
                  $('#lat').val(latlong[0].replace("(",""));
                  $('#long').val(latlong[1].replace(")",""));
                  var latitud =  $('#lat').val();
                  var longi =  $('#long').val();
                 
                  var latlng2 = new google.maps.LatLng(latitud,longi);

                  geocoder2.geocode({'latLng': latlng2},function(resultados2,status2){
                    if (status2 == google.maps.GeocoderStatus.OK) {
                      alert(resultados2[0].formatted_address);
                      $('#dir').val(resultados2[0].formatted_address);

                    }else{
                      alert("Nombre del problema: "+status2);

                    }
                  });

            });
           
        }else{
          alert('Eto no se pudo por que Eto '+status+' no lo dejo');

        }
      }else{
        alert('Eto no se pudo por que Eto '+status+' no lo dejo');

      }  
  });
}
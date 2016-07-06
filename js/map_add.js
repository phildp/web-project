function map_add() {
  var map = new google.maps.Map(document.getElementById("map_canvas"), {
    center: new google.maps.LatLng(38.273538,21.753993),
    zoom: 12,
    mapTypeId: 'roadmap'
  });
  var marker = new google.maps.Marker({
    position: new google.maps.LatLng(38.273538,21.753993),
    map: map,
    animation: google.maps.Animation.DROP,
    draggable: true
  }); 
  google.maps.event.addListener(marker, 'drag', function(evt){
    document.getElementById('latitude').value = evt.latLng.lat().toFixed(6);
    document.getElementById('longitude').value = evt.latLng.lng().toFixed(6);
  });
  
  google.maps.event.addListener(marker, 'dragend', function(evt){
    document.getElementById('latitude').value = evt.latLng.lat().toFixed(6);
    document.getElementById('longitude').value = evt.latLng.lng().toFixed(6);
  });
}

function CallbackGeo2() {
  if (navigator && navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(successCallbackGeo2, errorCallbackGeo2);
  } else {
    error('Geolocation is not supported.');
  }
  return false;
}
function errorCallbackGeo2() {}
function successCallbackGeo2(position) {
  var myLatlng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
  var map_options = {
    zoom: 17,
    center: myLatlng,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  }
  map_container = document.getElementById('map_canvas');
  var map = new google.maps.Map(map_container, map_options);
  var marker = new google.maps.Marker({
    position: myLatlng,
    map: map,
    animation: google.maps.Animation.DROP,
    draggable: true
  }); 
  document.getElementById('latitude').value = position.coords.latitude.toFixed(6);
  document.getElementById('longitude').value = position.coords.longitude.toFixed(6);

  google.maps.event.addListener(marker, 'drag', function(evt){
    document.getElementById('latitude').value = evt.latLng.lat().toFixed(6);
    document.getElementById('longitude').value = evt.latLng.lng().toFixed(6);
  });
  
  google.maps.event.addListener(marker, 'dragend', function(evt){
    document.getElementById('latitude').value = evt.latLng.lat().toFixed(6);
    document.getElementById('longitude').value = evt.latLng.lng().toFixed(6);
  });
}
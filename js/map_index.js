function map_index() {
  var map = new google.maps.Map(document.getElementById("map_canvas"), {
	center: new google.maps.LatLng(38.273538,21.753993),
	zoom: 12,
	mapTypeId: 'roadmap'
  });
  var infoWindow = new google.maps.InfoWindow;

  // Change this depending on the name of your PHP file
  downloadUrl("lib/xmlsql.php", function(data) {
	var xml = data.responseXML;
	var reports = xml.documentElement.getElementsByTagName("report");
	var bounds = new google.maps.LatLngBounds();
	for (var i = 0; i < reports.length; i++) {
		var title = reports[i].getAttribute("title");
		var type = reports[i].getAttribute("type");
		var category = reports[i].getAttribute("category");
		var point = new google.maps.LatLng(
		  	parseFloat(reports[i].getAttribute("lat")),
		  	parseFloat(reports[i].getAttribute("lng")));
		var html = "<b>" + "<a href='report.php?r=" + reports[i].getAttribute("id") + "'>" + title + "</a></b> <br/>" + category;
		var marker = new google.maps.Marker({
			map: map,
			position: point,
			animation: google.maps.Animation.DROP
		});
		bounds.extend(point);
		bindInfoWindow(marker, map, infoWindow, html);
	}
   	map.fitBounds(bounds);
  });
}

function bindInfoWindow(marker, map, infoWindow, html) {
  google.maps.event.addListener(marker, 'click', function() {
	infoWindow.setContent(html);
	infoWindow.open(map, marker);
  });
}

function downloadUrl(url, callback) {
  var request = window.ActiveXObject ?
	  new ActiveXObject('Microsoft.XMLHTTP') :
	  new XMLHttpRequest;

  request.onreadystatechange = function() {
	if (request.readyState == 4) {
	  request.onreadystatechange = doNothing;
	  callback(request, request.status);
	}
  };

  request.open('GET', url, true);
  request.send(null);
}

function doNothing() {}
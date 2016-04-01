function refresh() {
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange=function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			data = xmlhttp.responseText.split ( "[BRK]" );
		  	document.getElementById("all").innerHTML = data[0];
		  	document.getElementById("open").innerHTML = data[1];
		  	document.getElementById("cl").innerHTML = data[2];
		  	document.getElementById("med").innerHTML = data[3];
		}
	}
	xmlhttp.open("POST","lib/refresh.php",true);
	xmlhttp.send();
}
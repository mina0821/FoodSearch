//result restaurant location variable is stored in restArray
//find the length
var arrayLength = restArray.length;
console.log(qArray);
//initilize the map
function initMap() {
	//define bounds variable
	var bounds = new google.maps.LatLngBounds();
	//defin infowindow variable 
	var infowindow = new google.maps.InfoWindow();
	//definition of the mapk, locate html element by id map
	var map = new google.maps.Map(document.getElementById('map'), {
		//set the center point of the map
		center: {lat: 43.58, lng: -79.72},
		//define zoom size
		zoom: 10
	});

	for (var i = 0; i < arrayLength; i++) {
		//define the location
		var temp_pos = new google.maps.LatLng(parseFloat(restArray[i].lat),parseFloat(restArray[i].longt));

		//extend boundary to fit each marker
		bounds.extend(temp_pos);

		//define restaurant marker
		var temp_marker = new google.maps.Marker({
			position: temp_pos, 
			map: map
		});

		//add click listener into each restaurant marker
		google.maps.event.addListener(temp_marker,'click', (function(temp_marker, i) {
			return function() {
				infowindow.setContent('<p>'+restArray[i].name+'<br><br><a href="individual_sample.php?'+qArray[i]+'">details</a></h1>');
				infowindow.open(map,temp_marker);
			}
		})(temp_marker, i));
	}

	//fit the map with bounds
	map.fitBounds(bounds);
}
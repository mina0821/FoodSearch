//initilize the map
function initMap() {
	//define the location
	var pos = new google.maps.LatLng(parseFloat(lat),parseFloat(longt));

	//definition of the mapk, locate html element by id map
	var map = new google.maps.Map(document.getElementById('map'), {
		//set the center point of the map
		center: pos,
		//define zoom size
		zoom: 12
	});

	//define the hotpot restaurant marker
	var marker = new google.maps.Marker({
		position: pos, 
		map: map
	})
}
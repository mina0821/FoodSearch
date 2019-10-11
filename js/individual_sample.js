//define hot pot restaurant location variable
var happy_lamb_pos = {lat: 43.570191, lng: -79.661665};

//define content string for the restaurant
var happy_lamb_desc = '<p>Happy Lamb Hot Pot<br><br><a href="individual_sample.html">details</a></h1>';

//initilize the map
function initMap() {
	//definition of the mapk, locate html element by id map
	var map = new google.maps.Map(document.getElementById('map'), {
		//set the center point of the map
		center: happy_lamb_pos,
		//define zoom size
		zoom: 12
	});

	//define the hotpot restaurant marker
	var happy_lamb_marker = new google.maps.Marker({
		position: happy_lamb_pos, 
		map: map
	})
}
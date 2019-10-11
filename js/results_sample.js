//define four hot pot restaurant location variable
var happy_lamb_pos = {lat: 43.570191, lng: -79.661665};
var morals_pos = {lat: 43.567531, lng: -79.662211};
var best_friend_pos = {lat: 43.596743, lng: -79.596982};
var chinese_legend_pos = {lat: 43.598560, lng: -79.593806};

//define content string for each restaurant
var happy_lamb_desc = '<p>Happy Lamb Hot Pot<br><br><a href="individual_sample.html">details</a></h1>';
var morals_desc = '<p>Morals Village Hot Pot<br><br><a href="individual_sample.html">details</a></h1>';
var best_friend_desc = '<p>Best Friend Chinese Restaurant<br><br><a href="individual_sample.html">details</a></h1>';
var chinese_legend_desc = '<p>Chinese Legendary Hot Pot<br><br><a href="individual_sample.html">details</a></h1>';

//initilize the map
function initMap() {
	//definition of the mapk, locate html element by id map
	var map = new google.maps.Map(document.getElementById('map'), {
		//set the center point of the map
		center: {lat: 43.58, lng: -79.62},
		//define zoom size
		zoom: 12
	});

	//define info widdow for each restaurant
	var happy_lamb_infowindow = new google.maps.InfoWindow({
		content: happy_lamb_desc
	});
	var morals_infowindow = new google.maps.InfoWindow({
		content: morals_desc
	});
	var best_friend_infowindow = new google.maps.InfoWindow({
		content: best_friend_desc
	});
	var chinese_legend_infowindow = new google.maps.InfoWindow({
		content: chinese_legend_desc
	});

	//define four hotpot restaurant marker
	var happy_lamb_marker = new google.maps.Marker({
		position: happy_lamb_pos, 
		map: map
	});
	var morals_marker = new google.maps.Marker({
		position: morals_pos, 
		map: map
	});
	var best_friend_marker = new google.maps.Marker({
		position: best_friend_pos, 
		map: map
	});
	var chinese_legend_marker = new google.maps.Marker({
		position: chinese_legend_pos, 
		map: map
	});

	//add click listener into each restaurant marker
	happy_lamb_marker.addListener('click', function() {
		happy_lamb_infowindow.open(map, happy_lamb_marker);
	});
	morals_marker.addListener('click', function() {
		morals_infowindow.open(map, morals_marker);
	});
	best_friend_marker.addListener('click', function() {
		best_friend_infowindow.open(map, best_friend_marker);
	});
	chinese_legend_marker.addListener('click', function() {
		chinese_legend_infowindow.open(map, chinese_legend_marker);
	});
}
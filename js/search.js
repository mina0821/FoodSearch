//get the html element by id, only used for testing purpose
var test_info = document.getElementById("test");

//get the user current location
function getLocation() {
	//if the browswer is able to retreibe location data
	if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(showPosition);
	//else, report error
	} else { 
		test_info.innerHTML = "Please check your browser to make sure that geolocation function is supported.";
	}
}

function showPosition(position) {
	//print the user current location into webpage (for testing purpose)
	test_info.innerHTML = "Latitude: " + position.coords.latitude + "<br>Longitude: " + position.coords.longitude;
}
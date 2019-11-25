<!DOCTYPE html>
<html itemscope itemtype="http://schema.org/WebPage">
<head>
	<!-- character encoding -->
	<meta charset="UTF-8">

	<!-- title of the page -->
	<title>Individual Sample</title>

	<!-- define external css -->
	<link rel="stylesheet" type="text/css" href="css/individual_sample.css">
	<!-- define external js file -->
	<script src="js/individual_sample.js"></script>
	<script async defer
	  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBh-2YTNU1ZPyvGY3_Boirjy9EVXCMAmXU&callback=initMap">
	</script>

	<!-- for responsive design -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- add facebook open graph protocal metadata -->
	<meta property="og:title" content="FoodSearch" />
	<meta property="og:url" content="https://foodsearch.azurewebsites.net/search.html" />
	<meta property="og:type" content="website" />

	<!-- add twitter card metadata -->
	<meta name="twitter:card" content="summary" />

	<!-- icons for multiple platform -->
	<!-- favicon -->
	<link rel="icon" type="image/jpg" sizes="64x64" href="img/icon.jpg">
	<!-- ios icon -->
	<link rel="apple-touch-icon" sizes="180x180" href="img/icon.jpg">
	<!-- android icon -->
	<meta name="msapplication-square-70x70logo" content="img/icon.jpg">

	<!-- place microdata -->
	<meta itemprop="latitude" content="40.75" />
	<meta itemprop="longitude" content="73.98" />

	<!-- review and rating microdata -->
	<meta itemprop="review" content="review..." />
	<meta itemprop="rating" content="4.1" />

</head>
<body>
<!-- header -->
<!-- title and advertisement header -->
<div id="header-grid" class="row">

	<div id="header-title">
		<h1>Food Search</h1>
	</div>

	<div id="advertisement">
		<h2>Find your best restaurant experiences!</h2>
	</div>

</div>

<!-- nativation menu -->
<div class="header-navigation row">
  <a href="search.html">Search</a>
  <a href="submission.html">Submission</a>
  <a href="registration.html">Registration</a>
  <a href="results_sample.html">Map</a>
</div>


<!-- end of header -->

<!-- main page -->
<!-- individual restaurant detail block -->
<div id="rest-block" class="row">

	<!-- restaurant title display -->
	<div class="rest-row rest-title">
		<h1>Happy Lamb Hot Pot</h1>
	</div>

	<div class="rest-col">
		<!-- restaurant description -->
		<div class="rest-title"><h2>Description:</h2></div>
		<h3>This is Happy Lamb Hot Pot</h3>

		<!-- restaurant hours -->
		<div class="rest-title"><h2>Hours:</h2></div>
		<h3>Mon-Sun 11am-11pm</h3>

		<!-- restaurant ratings -->
		<div class="rest-title"><h2>Ratings:</h2></div>
		<h3>4.1</h3>

		<!-- restaurant sample image -->
		<div class="rest-title"><h2>Image:</h2></div>
		<picture>
			<!-- sample image for desktop user -->
			<source media="(min-width: 800px)" srcset="img/sample_image.jpg">
			<!-- sample image for moblie user -->
			<source media="(max-width: 800px)" srcset="img/sample_image_moblie.jpg">
			<img class="rest-row" src="img/sample_image.jpg" alt="Picture of restaurant.">
		</picture>

		<!-- restaurant video -->
		<div class="rest-title"><h2>Video:</h2></div>
		<video class="rest-row" controls>
			<source src="video/video.mp4" type="video/mp4">
			<source src="video/video.ogg" type="video/ogg">
		</video>
	</div>

	<!-- restaurant location map -->
	<div class="rest-col" id="map"></div>

	<!-- restaurant reviews -->
	<div class="rest-row rest-title">
		<h2>Reviews:</h2>
	</div>

	<div class="rest-row rest-col">
		<h3>customer1: review...</h3>
		<h3>customer2: review...</h3>
		<h3>customer3: review...</h3>
		<h3>customer4: review...</h3>
	</div>

</div>
<!-- end of main page -->

<!-- footer -->
<div id="footer" class="row">
	<h2> FoodSearch.com @ 2019 fall</h2>
</div>
<!-- end of footer -->

</body>
</html>
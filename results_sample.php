<!DOCTYPE html>
<html>
<head>
	<!-- character encoding -->
	<meta charset="UTF-8">

	<!-- title of the page -->
	<title>Results Sample</title>

	<!-- define external css -->
	<link rel="stylesheet" type="text/css" href="css/results_sample.css">
	<!-- define external js file -->
	<script src="js/results_sample.js"></script>
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
<div id="results-block" class="row">
	<div class="results-col">
		<!-- show results in tabular form -->
		<table class="results-table">
			<tr>
				<th id="results-title">
					Results: 
				</th>
			</tr>
			<tr>
				<td class="results-cell"><a href="individual_sample.html">
					Happy Lamb Hot Pot 
				</a></td>
			</tr>
			<tr>
				<td class="results-cell"><a href="individual_sample.html">
					Morals Village Hot Pot 
				</a></td>
			</tr>
			<tr>
				<td class="results-cell"><a href="individual_sample.html">
					Best Friend Chinese Restaurant 
				</a></td>
			</tr>
			<tr>
				<td class="results-cell"><a href="individual_sample.html">
					Chinese Legendary Hot Pot 
				</a></td>
			</tr>
		</table>
	</div>

	<!-- map -->
	<div class="results-col" id="map"></div>

</div>
<!-- end of main page -->

<!-- footer -->
<div id="footer" class="row">
	<h2> FoodSearch.com @ 2019 fall</h2>
</div>
<!-- end of footer -->

</body>
</html>
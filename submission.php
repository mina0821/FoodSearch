<!DOCTYPE html>
<html>
<head>
	<!-- character encoding -->
	<meta charset="UTF-8">

	<!-- title of the page -->
	<title>Submission</title>

	<!-- define external css -->
	<link rel="stylesheet" type="text/css" href="css/submission.css">

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
<form id="submit-block" class="row">
		<!-- get restaurant name -->
		<div class="submit-col">
			<h2><label>Restaurant name:</label></h2>
		</div>

		<div class="submit-col">
			<input class="submit-input" type="text" placeholder="Restaurant name..." title="Restaurant Name" required>
		</div>

		<!-- get description -->
		<div class="submit-col">
			<h2><label>Description:</label></h2>
		</div>

		<div class="submit-col">
			<textarea class="submit-input" placeholder="Description..." maxlength="150" rows="5"></textarea>
		</div>

		<!-- get locations of the restaurant -->
		<div class="submit-col">
			<h2><label>Location:</label></h2>
		</div>

		<div class="submit-double-col-left">
			<input class="submit-input" type="number" step="0.01" placeholder="Latitude..." required>
		</div>

		<div class="submit-double-col-right">
			<input class="submit-input" type="number" step="0.01" placeholder="Longitude..." required>
		</div>

		<!-- get image -->
		<div class="submit-col">
			<h2><label>Upload image:</label></h2>
		</div>

		<div class="submit-col">
			<input class="submit-input" type="file" accept="image/*">
		</div>

		<!-- get video -->
		<div class="submit-col">
			<h2><label>Upload video:</label></h2>
		</div>

		<div class="submit-col">
			<input class="submit-input" type="file" accept="video/*">
		</div>

		<!-- submit button -->
		<div class="submit-col">
			<input id="submit-btn" type="submit" value="Submit">
		</div>
</form>
<!-- end of main page -->

<!-- footer -->
<div id="footer" class="row">
	<h2> FoodSearch.com @ 2019 fall</h2>
</div>
<!-- end of footer -->

</body>
</html>
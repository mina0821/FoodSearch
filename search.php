<?php
try {
    $conn = new PDO("mysql:host=localhost;dbname=db-rst", "root", "");
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
?>

<!DOCTYPE html>
<html>
<head>
	<!-- character encoding -->
	<meta charset="UTF-8">

	<!-- title of the page -->
	<title>Search</title>

	<!-- define external css -->
	<link rel="stylesheet" type="text/css" href="css/search.css">
	<!-- include external js file -->
	<script src="js/search.js" defer></script>

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
<div id="search-box" class="row">
		<!-- get food name label -->
		<div class="search-col">
			<h1><label>Name:</label></h1>
		</div>

		<!-- food name input box -->
		<div class="search-col">
			<input class="search-input" type="text" placeholder="Food name...">
		</div>

		<!-- get rating label-->
		<div class="search-col">
			<h1><label>Rating:</label></h1>
		</div>

		<!-- rating input box -->
		<div class="search-col">
			<select class="search-input">
				<option>1.0</option>
				<option>2.0</option>
				<option>3.0</option>
				<option>4.0</option>
				<option>5.0</option>
			</select>
		</div>

		<!-- get location label -->
		<div class="search-col">
			<h1><label>Location:</label></h1>
		</div>

		<!-- location input box -->
		<div class="search-col">
			<input class="search-input" type="text" placeholder="Latitude..." value="0.01">
		</div>

		<!-- location input box -->
		<div class="search-col">
			<input class="search-input" type="text" placeholder="Longitude..." value="0.01">
		</div>

		<!-- search button -->
		<div class="search-col">
			<input class="search-btn" type="submit" value="Search">
		</div>

		<!-- only for testing coordinates purpose -->
		<div class="search-col">
			<p><label id="test"></label></p>
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
<?php
//start the session
session_start();

//Check if the user is logged in.
if(isset($_SESSION['user_name']) || isset($_SESSION['logged_in'])){
    //User logged in. replace username with login link
    $user_login = "<a>".$_SESSION['user_name']." logged in</a>";
    //provide a method for user to loggout
    $user_loggout = "<a href='logout.php'>Logout</a>";
    //combine the string
    $user_link = $user_login . $user_loggout;
} else {
	//if not, show the link to login and register
	$user_link = "<a href='registration.php'>Registration</a><a href='login.php'>Login</a>";
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
  <a href="search.php">Search</a>
  <a href="submission.php">Submission</a>
  <div id="user-account"><?php echo $user_link; ?></div>
</div>


<!-- end of header -->

<!-- main page -->
<form id="search-box" class="row" action="results_sample.php" method="GET">
		<!-- get food name label -->
		<div class="search-col">
			<h1><label>Name:</label></h1>
		</div>

		<!-- food name input box -->
		<div class="search-col">
			<input class="search-input" type="text" name="name" placeholder="Restaurant name...">
		</div>

		<!-- get rating label-->
		<div class="search-col">
			<h1><label>Rating:</label></h1>
		</div>

		<!-- rating input box -->
		<div class="search-col">
			<input class="search-input" type="text" name="rating" placeholder="Rating above...">
		</div>

		<!-- get location label -->
		<div class="search-col">
			<h1><label>Location:</label></h1>
		</div>

		<!-- location input box -->
		<div class="search-col">
			<input class="search-input" type="text" name="lat" placeholder="Latitude..." value="43.57">
		</div>

		<!-- location input box -->
		<div class="search-col">
			<input class="search-input" type="text" name="longt" placeholder="Longitude..." value="-79.66">
		</div>

		<!-- search button -->
		<div class="search-col">
			<input class="search-btn" type="submit" value="Search">
		</div>

		<!-- only for testing coordinates purpose -->
		<div class="search-col">
			<p><label id="test"></label></p>
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
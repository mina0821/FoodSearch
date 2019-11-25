<!DOCTYPE html>
<html>
<head>
	<!-- character encoding -->
	<meta charset="UTF-8">

	<!-- title of the page -->
	<title>Registration</title>

	<!-- define external css -->
	<link rel="stylesheet" type="text/css" href="css/registration.css">
	<!-- define external js -->
	<script src="js/registration.js" defer></script>

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
<form id="register-block" class="row" onsubmit="return validateForm()">

		<!-- get username -->
		<div class="register-col">
			<h2><label>Username:</label></h2>
		</div>

		<!-- username error message-->
		<div class="register-col">
			<text class="error_msg" id="username_error"></text>
		</div>

		<!-- username input -->
		<div class="register-col">
			<input class="register-input" type="text" placeholder="Username..." id="username_input">
		</div>

		<!-- get password-->
		<div class="register-col">
			<h2><label>Password:</label></h2>
		</div>

		<!-- password error message-->
		<div class="register-col">
			<text class="error_msg" id="password_error"></text>
		</div>

		<!-- password input -->
		<div class="register-col">
			<input class="register-input" type="password" placeholder="Password..." id="password_input">
		</div>

		<!-- get gender -->
		<div class="register-col">
			<h2><label>Gender:</label></h2>
		</div>

		<!-- gender input -->
		<div class="register-col">
			<select class="register-input">
				<option>Female</option>
				<option>Male</option>
				<option>Prefer not to say</option>
			</select>
		</div>

		<!-- get email -->
		<div class="register-col">
			<h2><label>Email:</label></h2>
		</div>

		<!-- email error message-->
		<div class="register-col">
			<text class="error_msg" id="email_error"></text>
		</div>

		<!-- email input -->
		<div class="register-col">
			<input class="register-input" type="text" id="email_input">
		</div>

		<!-- get date of birth -->
		<div class="register-col">
			<h2><label>Date of Birth:</label></h2>
		</div>

		<!-- date error message-->
		<div class="register-col">
			<text class="error_msg" id="date_error"></text>
		</div>

		<!-- date input -->
		<div class="register-col">
			<input class="register-input" type="text" id="date_input" value="yyyy-mm-dd">
		</div>

		<!-- register button -->
		<div class="register-col">
			<input id="register-btn" type="submit" value="Register">
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
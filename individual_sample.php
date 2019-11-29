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

try {
	// connect to database
    $conn = new PDO("mysql:host=localhost;dbname=db-rst", "root", "root");
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
?>
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
	<script defer src="js/individual_sample.js"></script>
	<script defer
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
  <a href="search.php">Search</a>
  <a href="submission.php">Submission</a>
  <div id="user-account"><?php echo $user_link; ?></div>
</div>


<!-- end of header -->

<!-- main page -->
<!-- individual restaurant detail block -->
<div id="rest-block" class="row">

	<!-- restaurant title display -->
	<div class="rest-row rest-title">
	<?php
		//get value from query string
		$name = $_GET['name'];
		//send location data to js for map
		$lat = $_GET['lat'];
		$longt = $_GET['longt'];
		echo "<script>";
		echo 'var lat = ' . json_encode($lat) . ';';
		echo 'var longt = ' . json_encode($longt) . ';';
		echo "</script>";

		//display result restaurant name
		echo '<h1>'.$name.'</h1>';
		echo '</div><div class="rest-col"><div class="rest-title"><h2>Description:</h2></div>';
		echo '<h3>This is '.$name.'.</h3>';
	?>

		<!-- restaurant ratings -->
		<div class="rest-title"><h2>Ratings:</h2></div>
		<?php
			//mysql search query
			$pdoQuery = 'SELECT ROUND(AVG(`rating`),2) AS rating FROM `Review` WHERE `name` LIKE :name';

			//prepare the statement to prevent sql injection attack
			$pdoResult = $conn->prepare($pdoQuery);

			//bind the value to query
			$keyname = "%".$name."%";
			$pdoResult->bindParam(':name', $keyname, PDO::PARAM_STR);

			//execute statment
			$pdoExec = $pdoResult->execute();

			if ($pdoExec)
			{
				//if rating exist
				foreach($pdoResult as $row)
				{
					echo '<h3>'.$row['rating'].'</h3>';
				}
			}
		?>

		<!-- restaurant sample image -->
		<div class="rest-title"><h2>Image:</h2></div>
		<picture>
			<!-- sample image for desktop user -->
			<source media="(min-width: 800px)" srcset="img/sample_image.jpg">
			<!-- sample image for moblie user -->
			<source media="(max-width: 800px)" srcset="img/sample_image_moblie.jpg">
			<img class="rest-row" src="img/sample_image.jpg" alt="Picture of restaurant.">
		</picture>

	</div>

	<!-- restaurant location map -->
	<div class="rest-col" id="map"></div>

	<!-- restaurant reviews -->
	<div class="rest-row rest-title">
		<h2>Reviews:</h2>
	</div>

	<div class="rest-row rest-col">
		<?php
			//mysql search query
			$pdoQuery = 'SELECT `review` FROM `Review` WHERE `name` LIKE :name';

			//prepare the statement to prevent sql injection attack
			$pdoResult = $conn->prepare($pdoQuery);

			//bind the value to query
			$keyname = "%".$name."%";
			$pdoResult->bindParam(':name', $keyname, PDO::PARAM_STR);

			//execute statment
			$pdoExec = $pdoResult->execute();

			if ($pdoExec)
			{
				//if some review exist
				foreach($pdoResult as $row)
				{
					echo '<h3>'.$row['review'].'</h3>';
				}
			}
		?>
		<h3>More reviews comming soon...</h3>
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
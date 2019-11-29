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
<html>
<head>
	<!-- character encoding -->
	<meta charset="UTF-8">

	<!-- title of the page -->
	<title>Results Sample</title>

	<!-- define external css -->
	<link rel="stylesheet" type="text/css" href="css/results_sample.css">
	<!-- define external js file -->
	<script defer src="js/results_sample.js"></script>
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
<div id="results-block" class="row">
	<div class="results-col">
		<!-- show results in tabular form -->
		<table class="results-table">
			<tr>
				<th id="results-title">
					Results: 
				</th>
			</tr>
			<?php
			//gets value sent from search form
			$name = $_GET['name'];
			$rating = $_GET['rating'];
			$lat = $_GET['lat'];
			$longt = $_GET['longt'];

			//mysql search query
			$pdoQuery = 'SELECT Object.name, Object.lat, Object.longt FROM `Object` INNER JOIN `Review` ON Object.name = Review.name';

			//check if each field is empty
			//if not empty, add the search condition to query
			if(!empty($name))
			{
				$searchCon[] = 'Object.name LIKE :name';
			}

			if(!empty($rating))
			{
				$searchCon[] = 'Review.rating > :rating';
			}

			if(!empty($lat))
			{
				$searchCon[] = 'ABS(Object.lat-:lat) < 0.01';
			}

			if(!empty($longt))
			{
				$searchCon[] = 'ABS(Object.longt - :longt) < 0.01';
			}

			//if user at least specify one search condition
			if (!empty($searchCon))
			{
				$pdoQuery .= " WHERE ".implode(" AND " , $searchCon);
			}

			//prepare the statement to prevent sql injection attack
			$pdoResult = $conn->prepare($pdoQuery);

			//bind the search value to query
			if (!empty($name))
			{
				//add regexpr for names
				$keyname = "%".$name."%";
				$pdoResult->bindParam(':name', $keyname, PDO::PARAM_STR);
			}
			if (!empty($rating))
			{
				$pdoResult->bindParam(':rating', $rating);
			}
			if (!empty($lat))
			{
				$pdoResult->bindParam(':lat', $lat);
			}
			if (!empty($longt))
			{
				$pdoResult->bindParam(':longt', $longt);
			}

			//execute statement
			$pdoExec = $pdoResult->execute();

			if($pdoExec)
			{
				//if some restaurant meet the search condition
				//show data in order
				if($pdoResult->rowCount()>0)
				{
					//create a javascript array to store location data
					echo "<script>";
					echo "var restArray = new Array;";
					//create a query array for map restaurant link
					echo "var qArray = new Array;";
					echo "</script>";
					//for each restaurant that meet the search condition
					foreach($pdoResult as $row)
					{
						//store the data for live map
						$restname = $row['name'];
						$restlat = $row['lat'];
						$restlongt = $row['longt'];
						//use query string to pass the information between two pages
						$qstring = http_build_query($row);
						//pass the data to javascript array
						echo "<script>";
						//convert data to json form
						echo 'var temp = ' . json_encode($row) . ';';
						echo 'var qtemp = ' . json_encode($qstring) . ';';
						//add data to the javascript array
						echo "restArray.push(temp);";
						//add query data to javascript array
						echo "qArray.push(qtemp)";
						echo "</script>";

						//display restaurant name in html page
						//redirect each link to individual page
						echo '<tr><td class="results-cell"><a href="individual_sample.php?';
						echo $qstring.'">';
						echo $restname."</a></td></tr>";
					}
				}
			}
			?>
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
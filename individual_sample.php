<?php
//start the session
session_start();

require 'lib_aws/aws-autoloader.php';
use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;

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
// AWS Info
$bucketName = 'foodsearch';
$IAM_KEY = 'AKIA2SHTPM77UQDLY6H5';
$IAM_SECRET = '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';

// Connect to AWS
try {
	// You may need to change the region. It will say in the URL when the bucket is open
	// and on creation.
	$s3 = S3Client::factory(
		array(
			'credentials' => array(
				'key' => $IAM_KEY,
				'secret' => $IAM_SECRET
			),
			'version' => 'latest',
			'region'  => 'ca-central-1'
		)
	);
} catch (Exception $e) {
	// We use a die, so if this fails. It stops here. Typically this is a REST call so this would
	// return a json object.
	die("Error: " . $e->getMessage());
}

//get value from query string
$name = $_GET['name'];
//send location data to js for map
$lat = $_GET['lat'];
$longt = $_GET['longt'];

//if user submit a rating and review
if (isset($_POST['submit'])){

	//retrieve  the filed value from login form
    $rating = !empty($_POST['rating']) ? trim($_POST['rating']) : null;
    $review = !empty($_POST['review']) ? trim($_POST['review']) : null;

	//prepare sql insert statement to prevent sql injection attack
	$sql = "INSERT INTO Review (name, rating, review) VALUES (:name, :rating, :review)";
	$stmt = $conn->prepare($sql);

	//bind our variables
	$stmt->bindValue(':name', $name);
	$stmt->bindValue(':rating', $rating);
	$stmt->bindValue(':review', $review);
	
	//execute the statement to insert new account
	$result = $stmt->execute();
}

?>
<!DOCTYPE html>
<html itemscope itemtype="http://schema.org/WebPage">
<head>
	<!-- character encoding -->
	<meta charset="UTF-8">

	<!-- title of the page -->
	<title>Details</title>

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
		<?php
			$cmd = $s3->getCommand('GetObject', [
				'Bucket' => 'foodsearch',
				'Key' => 'Happy Lamb Hot Pot/20150403_000410000_iOS.gif'
			]);

			//The period of availability
			$request = $s3->createPresignedRequest($cmd, '+10 minutes');

			//Get the pre-signed URL
			$signedUrl = (string) $request->getUri();

			echo '<img class="rest-row" src="'.$signedUrl.'" alt="Picture of restaurant.">';
		?>
	</div>

	<!-- restaurant location map -->
	<div class="rest-col" id="map"></div>

	<!-- restaurant reviews -->
	<div class="rest-row rest-title">
		<h2>Reviews</h2>
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

	<div class="rest-row rest-title">
		<h2>Submit your rating and review</h2>
	</div>
	<?php
	//Check if the user is logged in.
	if(isset($_SESSION['user_name']) || isset($_SESSION['logged_in'])){
		//get the current url with query string
		$query_str = '?'.$_SERVER['QUERY_STRING'];
		$current_url = $_SERVER['PHP_SELF'].$query_str;

		//if it is, show a rating and review submission form
		echo '<form action="'.$current_url.'" method="post">
			<!-- get ratting -->
			<h3><label>Rating:</label></h3>
			<input class="submit-input" type="number" step="0.01" min="0" max="5" name="rating" required>

			<!-- get reviews -->
			<h3><label>Review:</label></h3>
			<textarea class="submit-input" maxlength="225" rows="3" name="review" required></textarea>
			
			<!-- submit button -->
			<input id="submit-btn" type="submit" name="submit">
		</form>';
	}
	else {
		//tell the user to login
		echo "<div class='rest-row rest-col'>";
		echo "<h2>Please log in to submit ratings and reviews. <a href='login.php'>Login</a></h2>";
		echo "</div>";
	}
	?>

</div>
<!-- end of main page -->

<!-- footer -->
<div id="footer" class="row">
	<h2> FoodSearch.com @ 2019 fall</h2>
</div>
<!-- end of footer -->

</body>
</html>
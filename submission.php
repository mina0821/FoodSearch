<?php
//start the session
session_start();

require 'lib_aws/aws-autoloader.php';
use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;

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

//define error message variable with empty string
$errMsg = "";

//if user submit a new object
if (isset($_POST['submit'])){
	//data validation when retrieving value from submission form
	//if such field is empty, report error
	if (empty($_POST['name'])) {
		$errMsg = $errMsg."Please fill in the name. ";
	} 
	else {
		$name = trim($_POST['name']);
	}

	//if such field is empty, report error
	if (empty($_POST['review'])) {
		$errMsg = $errMsg."Please fill in the review. ";
	}
	else {
		$review = trim($_POST['review']);
	}

	//if such field is empty, report error
	if (empty($_POST['rating'])) {
		$errMsg = $errMsg."Please fill in the rating. ";
	} 
	else {
		$rating = trim($_POST['rating']);
		//check if rating is in given range
	    if ((0 >= $rating) &&($rating <= 5)) {
	    	$errMsg = $errMsg."Rating is in the range of 0 to 5. "; 
		}
	}

	//if such field is empty, report error
	if (empty($_POST['lat'])) {
		$errMsg = $errMsg."Please fill in the latitude. ";
	} 
	else {
		$lat = trim($_POST['lat']);
		//check if rating is in given range
	    if ((-90 >= $lat) &&($lat <= 90)) {
	    	$errMsg = $errMsg."Latitude is in the range of -90 to 90. "; 
		}
	}

	//if such field is empty, report error
	if (empty($_POST['longt'])) {
		$errMsg = $errMsg."Please fill in the longitude. ";
	} 
	else {
		$longt = trim($_POST['longt']);
		//check if rating is in given range
	    if ((-180 >= $longt) &&($longt <= 180)) {
	    	$errMsg = $errMsg."Longitude is in the range of -180 to 180. "; 
		}
	}

	//if there is not error in data validation
	if (empty($errMsg)) {
		//check if user logged in 
		if(isset($_SESSION['user_name']) || isset($_SESSION['logged_in'])){
			//add user submitted data into object table
			//check if restaurant name already exist
			//construct sql statement
			$sql = "SELECT COUNT(name) AS num FROM Object WHERE name = :name";

			//prepare the statment to prevent hacker
			$stmt = $conn->prepare($sql);

			//bind the value to sql statement
			$stmt->bindValue(':name', $name);

			//execute the statement
			$stmt->execute();

			//fetch the row
			$row = $stmt->fetch(PDO::FETCH_ASSOC);

			//if the name do not exist, add it into table
			if($row['num'] == 0){
			    //prepare sql insert statement to prevent sql injection attack
			    $sql = "INSERT INTO Object (name, lat, longt) VALUES (:name, :lat, :longt)";
			    $stmt = $conn->prepare($sql);

			    //bind our variables
			    $stmt->bindValue(':name', $name);
			    $stmt->bindValue(':lat', $lat);
			    $stmt->bindValue(':longt', $longt);

			    //execute the statement to insert new object
			    $result = $stmt->execute();
			}

			//prepare sql insert statement to prevent sql injection attack
			$sql = "INSERT INTO Review (name, rating, review) VALUES (:name, :rating, :review)";
			$stmt = $conn->prepare($sql);

			//bind our variables
			$stmt->bindValue(':name', $name);
			$stmt->bindValue(':rating', $rating);
			$stmt->bindValue(':review', $review);
			
			//execute the statement to insert new account
			//$result = $stmt->execute();

			//upload the image to aws s3 bucket
			$keyName = $name.'/';
			$pathInS3 = 'https://s3.ca-central-1.amazonaws.com/' . $bucketName . '/' . $keyName;

			// Add it to S3
			if (!empty($_FILES["image"]["name"])) {
				try {
					// Uploaded:
					$file = $_FILES["image"]['tmp_name'];
					$image_name = $_FILES["image"]['name'];

					$s3->putObject(
						array(
							'Bucket'=>$bucketName,
							'Key' =>  $keyName.$image_name,
							'SourceFile' => $file,
							'StorageClass' => 'REDUCED_REDUNDANCY'
						)
					);
				} catch (S3Exception $e) {
					die('Error:' . $e->getMessage());
				} catch (Exception $e) {
					die('Error:' . $e->getMessage());
				}
			}

		}
		//if user does not logged in, display error
		else {
			$errMsg = $errMsg."Please log in. <a href='login.php'>Login</a>";
		}
	}
}

?>
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
  <a href="search.php">Search</a>
  <a href="submission.php">Submission</a>
  <div id="user-account"><?php echo $user_link; ?></div>
</div>


<!-- end of header -->

<!-- main page -->
<form id="submit-block" class="row" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">

		<!-- error message -->
		<h1><font color="red"><?php echo $errMsg; ?></font></h1>

		<!-- get restaurant name -->
		<div class="submit-col">
			<h2><label>Restaurant name:</label></h2>
		</div>

		<div class="submit-col">
			<input class="submit-input" type="text" placeholder="Restaurant name..." title="Restaurant Name" name="name" value="Liuyishou Hotpot" required>
		</div>

		<!--get rating -->
		<div class="submit-col">
			<h2><label>Rating:</label></h2>
		</div>

		<div class="submit-col">
			<input type="number" class="submit-input" placeholder="Rating..." step="0.01" min="0" max="5" name="rating" value="3.9" required></input>
		</div>

		<!-- get description -->
		<div class="submit-col">
			<h2><label>Review:</label></h2>
		</div>

		<div class="submit-col">
			<input type="text" required class="submit-input" placeholder="Description..." maxlength="225" name="review" value="Long queue time but nice food."></input>
		</div>

		<!-- get locations of the restaurant -->
		<div class="submit-col">
			<h2><label>Location:</label></h2>
		</div>

		<div class="submit-double-col-left">
			<input class="submit-input" type="number" step="0.01" name="lat" placeholder="Latitude..." value="43.84" min="-90" max="90" required>
		</div>

		<div class="submit-double-col-right">
			<input class="submit-input" type="number" step="0.01" name="longt" placeholder="Longitude..." value="-79.38" min="-180" max="180" required>
		</div>

		<!-- get image -->
		<div class="submit-col">
			<h2><label>Upload image:</label></h2>
		</div>

		<div class="submit-col">
			<input class="submit-input" type="file" accept="image/*" name="image">
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
			<input id="submit-btn" type="submit" value="Submit" name="submit">
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
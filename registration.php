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

//define variables and initialize with empty values
$nameErr = $passErr = $emailErr = $birthdayErr = $msg = "";
$name = $pass = $email = $birthday = "";

//if user submit a registration form
if (isset($_POST['register'])){
	//retrive the field values from registration form
	//data validation
	//if such field is empty, report error
	if (empty($_POST['username'])) {
		$nameErr = "Please fill in the username.";
	} 
	else {
		$name = trim($_POST['username']);
		//check if username already exist
		//construct sql statement
		$sql = "SELECT COUNT(username) AS num FROM Users WHERE username = :username";

		//prepare the statment to prevent hacker
		$stmt = $conn->prepare($sql);

		//bind the value to sql statement
		$stmt->bindValue(':username', $name);

		//execute the statement
		$stmt->execute();

		//fetch the row
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		//if the username already exist, update the username error
		if($row['num'] > 0){
			$nameErr = "Username already exists.";
		}
	}

	//if such field is empty, report error
	if (empty($_POST['password'])) {
		$passErr = "Please fill in the password.";
	}
	else {
		$pass = trim($_POST['password']);
		//test if password is at least six character
	    //numeric and alphabetic format check on password
		if (strlen($pass) < 6) {
	   		$passErr = "Please enter at least 6 character password."; 
		}
		//test if password includes one digit number
		else if (!preg_match("/[0-9]/",$pass)) {
			$passErr = "Please include at least one digit number.";
		}
		//test if password includes one upper case letter
		else if (!preg_match("/[A-Z]/", $pass)) {
			$passErr = "Please include at least one upper case letter.";
		}
	}

	//if such field is empty, report error
	if (empty($_POST['email'])) {
		$emailErr = "Please fill in the email.";
	} 
	else {
		$email = trim($_POST['email']);
		//email format check on email field
	    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
	    	$emailErr = "Please enter a valid email."; 
		}
	}

	//if such field is empty, report error
	if (empty($_POST['birthday'])) {
		$birthdayErr = "Please fill in the date of birth.";
	} 
	else {
		$birthday = trim($_POST['birthday']);
    	//date format check on birthday field
    	if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$birthday)) {
    		$birthdayErr = "Please enter a valid date.";
    	}
	}

	//if there is not error
	if (empty($nameErr) and empty($passErr) and empty($emailErr) and empty($birthdayErr)) {
		//hash the password
	    $passwordHash = password_hash($pass, PASSWORD_DEFAULT);

	    //prepare sql insert statement to prevent sql injection attack
	    $sql = "INSERT INTO Users (username, password, email, birthday) VALUES (:username, :password, :email, :birthday)";
	    $stmt = $conn->prepare($sql);

	    //bind our variables
	    $stmt->bindValue(':username', $name);
	    $stmt->bindValue(':password', $passwordHash);
	    $stmt->bindValue(':email', $email);
	    $stmt->bindValue(':birthday', $birthday);

	    //execute the statement to insert new account
	    $result = $stmt->execute();

	    //if sign up process is succesful
	    if ($result) {
	    	//give user a notice
	    	$msg = "Congratulations! Sign up succesufull. <a href=login.php>Login</a>";
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
  <a href="search.php">Search</a>
  <a href="submission.php">Submission</a>
  <div id="user-account"><?php echo $user_link; ?></div>
</div>


<!-- end of header -->

<!-- main page -->
<!-- onsubmit="return validateForm()" -->
<form id="register-block" class="row" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

		<!--sign up message -->
		<h1><font color="red"><?php echo $msg; ?></font></h1>

		<!-- get username -->
		<div class="register-col">
			<h2><label>Username:</label></h2>
		</div>

		<!-- username error message-->
		<div class="register-col">
			<text class="error_msg" id="username_error"><?php echo $nameErr; ?></text>
		</div>

		<!-- username input -->
		<div class="register-col">
			<input class="register-input" type="text" placeholder="Username..." id="username_input" name="username">
		</div>

		<!-- get password-->
		<div class="register-col">
			<h2><label>Password:</label></h2>
		</div>

		<!-- password error message-->
		<div class="register-col">
			<text class="error_msg" id="password_error"><?php echo $passErr; ?></text>
		</div>

		<!-- password input -->
		<div class="register-col">
			<input class="register-input" type="password" placeholder="Password..." id="password_input" name="password">
		</div>

		<!-- get email -->
		<div class="register-col">
			<h2><label>Email:</label></h2>
		</div>

		<!-- email error message-->
		<div class="register-col">
			<text class="error_msg" id="email_error"><?php echo $emailErr; ?></text>
		</div>

		<!-- email input -->
		<div class="register-col">
			<input class="register-input" type="text" id="email_input" name="email" value="example@example.com">
		</div>

		<!-- get date of birth -->
		<div class="register-col">
			<h2><label>Date of Birth:</label></h2>
		</div>

		<!-- date error message-->
		<div class="register-col">
			<text class="error_msg" id="date_error"><?php echo $birthdayErr; ?></text>
		</div>

		<!-- date input -->
		<div class="register-col">
			<input class="register-input" type="text" id="date_input" value="1999-01-01" name="birthday">
		</div>

		<!-- register button -->
		<div class="register-col">
			<input id="register-btn" type="submit" value="Register" name="register">
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
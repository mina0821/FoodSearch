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
$loginErr = "";

//if user submit a login form
if (isset($_POST['login'])){

	//retrieve  the filed value from login form
    $username = !empty($_POST['username']) ? trim($_POST['username']) : null;
    $passwordAttempt = !empty($_POST['password']) ? trim($_POST['password']) : null;

    //get user password for the given username
    $sql = "SELECT username, password FROM Users WHERE username = :username";

    //prepare the statment to prevent sql injection attack
    $stmt = $conn->prepare($sql);

    //Bind the value to statement
    $stmt->bindValue(':username', $username);
    
    //Execute statement
    $stmt->execute();
    
    //Fetch the row and store in user variable
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    //if we could not find a user with given username
    if($user === false){
        //print the error
        $loginErr = "Username does not exist.";
    } 
    else{
       	//Check to see if the given password matches the password hash
        //Compare the passwords.
        $validPassword = password_verify($passwordAttempt, $user['password']);
        
        //If $validPassword is TRUE, the login has been successful.
        if($validPassword){
            //Provide the user with a login session.
            $_SESSION['user_name'] = $user['username'];
            $_SESSION['logged_in'] = time();
            
            //empty the login error message
            $loginErr = "";

            //head to search page
            header('Location: search.php');
            
        } else {
            //$validPassword was FALSE. Passwords do not match.
            $loginErr = "Password was incorrect.";
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
	<title>Login</title>

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
<form id="register-block" class="row" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">

		<!--error message -->
		<h1><font color="red"><?php echo $loginErr; ?></font></h1>

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
			<input class="register-input" type="text" placeholder="Username..." id="username_input" name="username">
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
			<input class="register-input" type="password" placeholder="Password..." id="password_input" name="password">
		</div>

		<!-- register button -->
		<div class="register-col">
			<input id="register-btn" type="submit" value="Login" name="login">
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
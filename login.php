<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
        h1,h2,h3,h4,h5,h6 {font-family: "Raleway", Arial, Helvetica, sans-serif}
.mySlides {display: none}
    </style>
</head>
<body>
<p><a href="twobros.php">Back to Home</a></p>
    <div class="wrapper">
        <h2>Login</h2>
        <p>Please fill in your credentials to login.</p>
        <form action="" method="post">
            <div class="form-group <?php echo (!empty($customerId_err)) ? 'has-error' : ''; ?>">
                <label>customerId</label>
                <input type="text" name="customerId" class="form-control">
                <!-- <span class="help-block"><?php echo $customerId_err; ?></span> -->
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control">
                <!-- <span class="help-block"><?php echo $password_err; ?></span> -->
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
            <p>Don't have an account? <a href="register.php">Sign up now</a>.</p>
        </form>
    </div>    
</body>
</html>

<?php
error_reporting(0);
//Include config file
require_once "config.php";

/* Creating the Login Form */

// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to twobros home page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: twobros.php");
}

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $customerId = $_POST["customerId"];
    $password = $_POST["password"];

    $qq = "SELECT customerId, password FROM customer WHERE customerId = {$customerId} and password=\"{$password}\"";
    $result = mysqli_query($link, $qq) or die(mysqli_connect_error());
    $num_results = $result->num_rows;

    if ($num_results == 1){

        $_SESSION["loggedin"] = true;
        $_SESSION["userId"] = $customerId;

        header("location: twobros.php");
    } else {
        echo "Sorry, wrong Credentials.";
    }

    mysqli_close($link);
}

?>





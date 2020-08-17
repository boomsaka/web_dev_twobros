<html>
        <title>Sign Up for TwoBros</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
        body,h1,h2,h3,h4,h5,h6 {font-family: "Raleway", Arial, Helvetica, sans-serif}
        .mySlides {display: none}
        </style>
        
<head>
  <title>Enter your Username and Password</title>
</head>

<body class="w3-content w3-border-left w3-border-right">
<nav class="w3-sidebar w3-light-grey w3-collapse w3-top" style="z-index:3;width:260px" id="mySidebar">
    <div class="w3-container w3-display-container w3-padding-16">
  <p><a href="twobros.php">Back to Home</a></p>

  <form action="" method="post" enctype="multipart/form-data">
    <table border="0">
    <h3> Please fill in this form to create an account. </h3>
    
    <p><label for="username"><b>Username</b></label></p>
    <input class="w3-input w3-border" type="text" placeholder="Enter Username" name="username" required>

    <p><label for="psw"><b>Password</b></label></p>
    <input class="w3-input w3-border" type="password" placeholder="Enter Password" name="psw" required>

    <p><label for="psw-repeat"><b>Repeat Password</b></label></p>
    <input class="w3-input w3-border" type="password" placeholder="Repeat Password" name="psw-repeat" required>

    <br>
    <input name ="signup-button" type="submit" class="w3-button w3-red w3-round-xxlarge w3-border w3-left-align" value="Sign Up">
    
      
    </table>
  </form>
  </div>
  </nav>
</body>
</html>
<?php
error_reporting(0);
if(isset($_POST['signup-button'])) {
  // create short variable names
  $username=$_POST['username'];
  if ($_POST['psw'] == $_POST['psw-repeat']){
    $password=$_POST['psw'];
  }
  else{ echo "Password does not match.";}
  

  if (!$username || !$password) {
     
     exit;
  }

  if (!get_magic_quotes_gpc()) {
    $username = addslashes($username);
    $password = addslashes($password);
  }

  @ $db = new mysqli('localhost', 'bookorama', '123456789', 'twobros');

  if (mysqli_connect_errno()) {
     echo "Error: Could not connect to database.  Please try again later.";
     exit;
  }
  $date = date('Y-m-d');
  $query = "insert into `customer` (`customerId`, `password`, `username`, `createDate`) VALUES
  (NULL, '".$password."', '".$username."', '".$date."')";
  $result = $db->query($query);
  header("location: signin.php");


  if ($result) {
      echo  $db->affected_rows." customer inserted into database.";
      header("location: login.php");
  } else {
  	  echo "An error has occurred.  The item was not added.";
  }
}
  $db->close();
?>

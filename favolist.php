<?php
$page = $_SERVER['PHP_SELF'];
$sec = "1";
?>
<html>
<title>TwoBros Home Page</title>
<head>
    <meta http-equiv="refresh" content="<?php echo $sec?>;URL='<?php echo $page?>'">
    </head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body,h1,h2,h3,h4,h5,h6 {font-family: "Raleway", Arial, Helvetica, sans-serif}
.mySlides {display: none}
</style>
<body class="w3-content w3-border-left w3-border-right">

<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-light-grey w3-collapse w3-top" style="z-index:3;width:260px" id="mySidebar">
  <div class="w3-container w3-display-container w3-padding-16">
    <i onclick="w3_close()" class="fa fa-remove w3-hide-large w3-button w3-transparent w3-display-topright"></i>
    <h3>TwoBros</h3>
    <h3>Affordable Housing for Students in NYC</h3>

    <button onclick="window.location.href='twobros.php'"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Go back to home page</button>
  </div>
  
</nav>

<!-- Top menu on small screens -->
<header class="w3-bar w3-top w3-hide-large w3-black w3-xlarge">
  <span class="w3-bar-item">Rental</span>
  <a href="javascript:void(0)" class="w3-right w3-bar-item w3-button" onclick="w3_open()"><i class="fa fa-bars"></i></a>
</header>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main w3-white" style="margin-left:260px">

  <!-- Push down content on small screens -->
  <div class="w3-hide-large" style="margin-top:80px"></div>

  <!-- Slideshow Header -->

  <div class="w3-container" id='apartments'>
    <h2 class="w3-text-red">Your Favorite Apartment Listings</h2>
    <?php
    error_reporting(0);
    session_start();
    if(isset($_SESSION['customerID'])){
      $customerId = $_SESSION['customerID'];
    }
    else { echo "Please login!";}
    
  $mysqli_link = mysqli_connect('localhost', 'bookorama', '123456789', 'twobros');
  // Check connection
  if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  
  
  // builds the query // Please be aware the customerId need to be resolved with variables
  $query0 = "SELECT * FROM apartment WHERE apartmentId IN (SELECT apartmentId FROM user_apt_like where customerId = $customerId)";

  $result = mysqli_query($mysqli_link, $query0) or die(mysqli_connect_error());

  $num_results = $result->num_rows;
  mysqli_close($mysqli_link);

  for ($i=0; $i <$num_results; $i++) {
    $row = $result->fetch_assoc();
    echo "<p style='margin-left: 1;'><strong> Apartment ID: ";
    $apartmentId = stripslashes($row['apartmentId']);
    echo stripslashes($row['apartmentId']);
    echo "</strong><br>";
    echo "<img src='uploads/".$row['pictures']."' style='float:right;width:220;height:220;'>";
    echo "<br>";
    echo "<p style='margin-left: 1;'> Street Adress: ";
    echo htmlspecialchars(stripslashes($row['streetAddress']));
    echo "<br>";
    echo "<p style='margin-left: 1;'> Unit Number: ";
    echo stripslashes($row['unitNumber']);
    echo "<br>";
    echo "<p style='margin-left: 1;'> Price: ";
    echo stripslashes($row['price']);
    echo "<br>";
    echo "<p style='margin-left: 1;'> Size: ";
    echo stripslashes($row['size']);
    echo "<br>";
    echo "<p style='margin-left: 1;'> Picture: ";
    echo "<br>";
    echo "</p>";
    echo "<iframe id='upload_target' name='upload_target1' src='delete_favorite_item.php' style='width:0;height:0;border:0px solid #fff;'></iframe>";        
         // Add Delete buttons and hidden fields for each query result
    echo <<<_END
    <form action="delete_favorite_item.php" method="post" target='upload_target1'>
    <input tyle='text-align:center;' type="hidden" name="delete_favorite" value="yes" />
    <input type="hidden" name="apartmentId" value=$apartmentId />
    <input type="submit" value="Delete from Favorite" /></form>
_END;
    echo "<hr>";
}

//---------------
  if(isset($_POST['submit-button'])) {
      // define the list of fields
      $fields = array('streetAddress', 'price', 'size');
      $conditions = array();
      
      // loop through the defined fields
      foreach($fields as $field){
          // if the field is set and not empty
          if(isset($_POST[$field]) && $_POST[$field] != '') {
              // create a new condition while escaping the value inputed by the user (SQL Injection)
              $conditions[] = "`$field` LIKE '%" . $_POST[$field] . "%'";
          }
      }
     // echo "<p>Query: " . $query . "</p>";
      echo "<label><i class='fa fa-building'></i> Apartments found:</label>";
      echo $num_results;
    }
?>

    </div>

<!-- End page content -->
</div>

<script>
// Script to open and close sidebar when on tablets and phones
function w3_open() {
  document.getElementById("mySidebar").style.display = "block";
  document.getElementById("myOverlay").style.display = "block";
}
 
function w3_close() {
  document.getElementById("mySidebar").style.display = "none";
  document.getElementById("myOverlay").style.display = "none";
}

</script>
  
  
  
 
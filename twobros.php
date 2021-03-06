 <?php session_start(); ?>
 <html>
<title>TwoBros Home Page</title>
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
    <h6>Search NOW!</h6>
    <hr>
    <form action="" method="post">
      <!--
      <p><label><i class="fa fa-road"></i> Neighborhood</label></p>
      <input class="w3-input w3-border" type="text" placeholder="Manhattan" name="area" required>
      -->

      <p><label><i class="fa fa-map-marker"></i> Address</label></p>
      <input class="w3-input w3-border" type="text" name="streetAddress">

      <p><label><i class="fa fa-money"></i> Price</label></p>
      <input class="w3-input w3-border" type="text" name="price">  
      
      <p><label><i class="fa fa-dot-circle-o"></i> Floor Size</label></p>
      <input class="w3-input w3-border" type="text" name="size">

      <!-- 
      <p><label><i class="fa fa-bed"></i> Bedrooms</label></p>
      <input class="w3-input w3-border" type="number" value="1" name="bedroom" min="0" max="6">       
      
      <p><label><i class="fa fa-bath"></i> Bathrooms</label></p>
      <input class="w3-input w3-border" type="number" value="1" name="bathroom" min="0" max="4"> 
      -->
      <p><button class="w3-button w3-red w3-round-xxlarge w3-border w3-left-align" type="submit" name='submit-button'><i class="fa fa-search w3-margin-right"></i> Search </button></p>
    </form>
    <p><button class="w3-button w3-blue w3-round-xxlarge w3-border w3-left-align" onclick="window.location.href='favolist.php'"><i class="fa fa-heart w3-margin-right"></i>My Favorite List</button></p>
   <form action="login.php" method="post" target="_blank">
   <button class="w3-button w3-blue w3-round-xxlarge w3-border w3-left-align" type="submit" name='login-button'><i class="fa fa-sign-in w3-margin-right"></i>Login to Add to Favorite</button>
  </form>
  <form action="signup.php" method="post">
   <button class="w3-button w3-blue w3-round-xxlarge w3-border w3-left-align" type="submit" name='signup-button'><i class="fa fa-user-plus w3-margin-right"></i>Sign Up</button>
  </form>
  <iframe id='logout' name='logout' src='logout.php' style='width:0;height:0;border:0px solid #fff;'></iframe>
  <form action="logout.php" method="post" target="logout">
   <button class="w3-button w3-blue w3-round-xxlarge w3-border w3-left-align" type="submit" name='logout-button'><i class="fa fa-sign-out w3-margin-right"></i>Logout</button>
  </form>
</div>
  </div>

  <div class="w3-bar-block">
    <a href="#apartment" class="w3-bar-item w3-button w3-padding-16"><i class="fa fa-building"></i> Apartment</a>
    <a href="#contact" class="w3-bar-item w3-button w3-padding-16"><i class="fa fa-envelope"></i> Contact</a>
  </div>
  
  <form action="new_apartment.html" method="get" target="_blank">
         <button type="submit" class="w3-btn w3-block w3-red w3-border">Add New Apartment</button>
  </form>
  <form action="update_apartment.php" method="get" target="_blank">
         <button type="submit" class="w3-btn w3-block w3-red w3-border">Update Apartment</button>
  </form>
  <form action="delete_apartment.php" method="get" target="_blank">
         <button type="submit" class="w3-btn w3-block w3-red w3-border">Delete Apartment</button>
  </form>
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
  <div class="w3-container">
    <h2 class="w3-text-red">Our Mission</h2>
    <p><img src="images/logo.png" alt="logo" style="float:left;width:200px;height:110px;"></p>
    <p>We are here to help students find the right place to live, to study and to enjoy the local community here in NYC. We find afforable housing and handle all necessary documentation for our clients. There is nothing to worry about!</p>
  </div> <hr>


  <div class="w3-container" id='apartments'>
    <h2 class="w3-text-red">Apartment Listings</h2>
    <?php
    error_reporting(0);
    $customerId = $_SESSION['customerID'];
  $mysqli_link = mysqli_connect('localhost', 'bookorama', '123456789', 'twobros');
  
  // Check connection
  if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

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
      // builds the query
      $query = "SELECT * FROM apartment ";
      // if there are conditions defined
      if(count($conditions) > 0) {
          // append the conditions
          $query .= "WHERE " . implode (' AND ', $conditions); // you can change to 'OR', but I suggest to apply the filters cumulative
      }
     // echo "<p>Query: " . $query . "</p>";

      $result = mysqli_query($mysqli_link, $query) or die(mysqli_connect_error());

      $num_results = $result->num_rows;
      $apartmentId_list = []; 

      for ($i=0; $i <$num_results; $i++) {
          $row = $result->fetch_assoc();
          $apartmentId = stripslashes($row['apartmentId']);
          echo "<p style='margin-left: 1;'><strong> Apartment ID: ";
          echo stripslashes($row['apartmentId']);
          array_push($apartmentId_list, $row['apartmentId']);
          echo "<img src='uploads/".$row['pictures']."' style='float:right;width:240;height:220;'>";
          echo "</strong><br>";
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
          echo "</p>";

          //echo "<form action='favorite_list_action.php' method='get' target='upload_target'>";
          //echo "<i id=$i onclick=\"togglefavolist(this.id)\" class='fa fa-heart' style='font-size:18px;border:0px;background-color:#FFFFFF;'></i>";
          //echo "</form>";
         //echo "<iframe id='upload_target' name='upload_target' src='add_favorite_item.php' style='width:300;height:30;border:0px solid #fff;'></iframe>";        
         // Add Delete buttons and hidden fields for each query result
    echo <<<_END
    <form action="add_favorite_item.php" method="post" target='upload_target'>
    <input tyle='text-align:center;' type="hidden" name="add_favorite" value="yes" />
    <input type="hidden" name="apartmentId" value=$apartmentId />
    <input type="submit" value="❤ Add to Favorite" /><iframe id='upload_target' name='upload_target' src='add_favorite_item.php' style='width:300;height:30;border:0px solid #fff;'></iframe></form>
_END;
          //echo "<button id=$i name='heart' onclick=\"togglefavolist(this.id)\" class='fa fa-heart' style='font-size:18px'></button>";

          echo "<hr>";
          echo "</right>";
      }
      echo "<label><i class='fa fa-building'></i> Apartments found:</label>";
      echo $num_results;
      mysqli_close($mysqli_link);

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
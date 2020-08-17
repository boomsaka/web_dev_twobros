<?php 
 //error_reporting(0);
 session_start();
 if(isset($_SESSION['userId'])){
   $customerId = $_SESSION['customerID'];
 }
 else { echo "Login to add";}

 @ $db = new mysqli('localhost', 'bookorama', '123456789', 'twobros');

 if (mysqli_connect_errno()) {
    echo "Error: Could not connect to database.  Please try again later.";
    exit;
 }

if (isset($_POST['add_favorite']) && isset($_POST['apartmentId'])){

   $apartmentId=$_POST['apartmentId'];

   $date = date('Y-m-d');
   $query = "insert into user_apt_like (customerID, apartmentId, add_date) values ('$customerId','$apartmentId','$date')";
   $result = $db->query($query);

   if ($result) {
       //echo  $db->affected_rows." apartment added to favorite list.";
   } else {
      // echo "An error has occurred.  The item was not deleted.";
       exit;
   }
}

?>
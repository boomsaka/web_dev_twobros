<?php 
 @ $db = new mysqli('localhost', 'bookorama', '123456789', 'twobros');

 if (mysqli_connect_errno()) {
    echo "Error: Could not connect to database.  Please try again later.";
    exit;
 }

if (isset($_POST['delete_favorite']) && isset($_POST['apartmentId'])){

   $apartmentId=$_POST['apartmentId'];

   $query = "delete from user_apt_like where apartmentId = $apartmentId and customerId = 1";
   $result = $db->query($query);

   if ($result) {
       //echo  $db->affected_rows." apartment added to favorite list.";
   } else {
      // echo "An error has occurred.  The item was not deleted.";
       exit;
   }
}

?>
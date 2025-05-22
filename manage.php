<?php
    session_start();
    if (!isset($_SESSION['authenticated']) || !$_SESSION['authenticated']) {
        header("Location: ./login.php");
    }

// Include the settings file that has database connection details
require_once("settings.php");


// Connect to the MySQL database using the provided credentials
$conn = mysqli_connect($host, $username, $password, $database);


// Check if the connection is successful
if (!$conn) {
   // If the connection fails, stop the page and show an error message
   die("Database connection failed: " . mysqli_connect_error());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta name="description" content="This page has eoi table information">
   <meta name="keywords" content="job, reference number, name, status">
   <meta name="author" content="TO">


   <title>Manage Page</title>


   <!-- External CSS stylesheet -->
   <link rel="stylesheet" type="text/css" href="styles/style.css">


   <!-- Some embedded CSS for figcaption border -->
   <style>
       figcaption {
           border: 1px solid black;
       }
   </style>


</head>
<body>
   <!-- Include the site header -->
   <?php include 'header.inc'; ?>


   <section id="main">
       <?php
       // Check if the user is logged in and their username is 'sirdoki'
       if (isset($_SESSION['username']) && $_SESSION['username'] == 'manager') {
           echo '<h1>Hi Manager</h1>';
           echo '<p>List of EOIs:</p>';


           // Query to get all eois from the 'eoi' table
           $query = "SELECT id, name, description FROM eoi";
           $result = mysqli_query($conn, $query);


           // If there are rows returned, display them in a table
           if (mysqli_num_rows($result) > 0) {
               echo '<table border="1" cellpadding="10" cellspacing="0">';
               echo '<tr><th>ID</th><th>Name</th><th>Description</th></tr>';
              
               // Fetch each row and show it in the table
               while ($row = mysqli_fetch_assoc($result)) {
                   echo '<tr>';
                   echo '<td>' . $row['id'] . '</td>';
                   echo '<td>' . $row['name'] . '</td>';
                   echo '<td>' . $row['description'] . '</td>';
                   echo '</tr>';
               }


               echo '</table>';
           } else {
               // If no information is found in the table
               echo '<p>No information on following query!</p>';
           }
       } else {
           // If user is not the 'manager', show a warning message
           echo '<h1>Hi, you are not the manager</h1>';
           echo '<p>This page is for authorised users only.</p>';
       }
       ?>
   </section>


   <!-- Include the site footer -->
   <?php include_once 'footer.inc'; ?>
</body>
</html>


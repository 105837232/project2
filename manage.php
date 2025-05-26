<?php
   // Include database connection settings
   require_once "settings.php";


   // Establish database connection using mysqli (oop)
   $conn = new mysqli($host, $user, $pwd, $sql_db);


   // Check connection
   if ($conn->connect_error) {
       die("Connection failed: " . $conn->connect_error);
   }


   // Handle form submissions
   $action = isset($_POST['action']) ? $_POST['action'] : '';  // to determine which query the manager wants to run
   $result = '';   // store the outcome of database operations


   // Perform actions based on user input
   if ($_SERVER['REQUEST_METHOD'] === 'POST') {
       if ($action === 'list_all') {
           // Get sort field from form, default to EOInumber if not set
           $sort_field = isset($_POST['sort_field']) ? $conn->real_escape_string($_POST['sort_field']) : 'EOInumber';  // sanitized user input to prevent SQL injection
           // Validate sort field to prevent SQL injection
           $valid_sort_fields = ['EOInumber', 'jobRef', 'firstName', 'lastName', 'status'];
           if (!in_array($sort_field, $valid_sort_fields)) {
               $sort_field = 'EOInumber'; // Default fallback
           }
           // List all EOIs in order of sort_field
           $query = "SELECT * FROM eoi ORDER BY $sort_field ASC";
           $result = $conn->query($query);
       } elseif ($action === 'list_by_job') {
           // List EOIs by job reference
           $jobRef = $conn->real_escape_string($_POST['jobRef']);    // sanitized user input to prevent SQL injection
           $query = "SELECT * FROM eoi WHERE jobRef = '$jobRef'";
           $result = $conn->query($query);
       } elseif ($action === 'list_by_name') {
           // List EOIs by applicant name
           $firstname = $conn->real_escape_string($_POST['first_name']);  // sanitized user input to prevent SQL injection
           $lastname = $conn->real_escape_string($_POST['last_name']);    // sanitized user input to prevent SQL injection
           $query = "SELECT * FROM eoi WHERE firstName LIKE '%$firstname%' AND lastName LIKE '%$lastname%'";
           $result = $conn->query($query);
       } elseif ($action === 'delete_by_job') {
           // Delete EOIs by job reference number
           $jobRef = $conn->real_escape_string($_POST['job_ref_delete']); // sanitized user input to prevent SQL injection
           $query = "DELETE FROM eoi WHERE jobRef = '$jobRef'";
           if ($conn->query($query) === TRUE) {
               $result = "EOIs with Job Reference Number '$jobRef' deleted successfully.";
           } else {
               $result = "Error deleting EOIs: " . $conn->error;
           }
       } elseif ($action === 'update_status') {
           // Change the status of an EOI
           $eoi_number = $conn->real_escape_string($_POST['eoi_number']);  // sanitized user input to prevent SQL injection
           $new_status = $conn->real_escape_string($_POST['status']);  // sanitized user input to prevent SQL injection
           $query = "UPDATE eoi SET status = '$new_status' WHERE EOInumber = '$eoi_number'";
           if ($conn->query($query) === TRUE) {
               $result = "Status of EOI #$eoi_number updated to '$new_status'.";
           } else {
               $result = "Error updating status: " . $conn->error;
           }
       }
   }
?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta name="description" content="Manager login page for the EOI management system.">
   <meta name="author" content="Joshua Thai">
   <link rel="stylesheet" href="styles/styley.css">
   <title>EOI Management</title>
</head>
<body>
   <?php include 'header.inc'; ?>
   <h1>EOI Management Page</h1>


   <div class="EOI" >
   <!-- Form for listing all EOIs with sorting -->
       <h2 class="manage">List All EOIs</h2>
       <form method="post">
           <label class="label" for="sort_field">Sort by:</label>
           <select id="sort_field" name="sort_field">
               <option value="EOInumber">EOI Number</option>
               <option value="jobRef">Job Reference</option>
               <option value="firstName">First Name</option>
               <option value="lastName">Last Name</option>
               <option value="status">Status</option>
           </select>
           <br>
           <br>
           <input type="hidden" name="action" value="list_all">
           <input type="submit" value="Show All EOIs">
       </form>


       <!-- Form for listing EOIs by job reference -->
       <h2 class="manage">List EOIs by Job Reference Number</h2>
       <form method="post">
           <label class="label" for="jobRef">Job Reference Number:</label>
           <input type="text" id="jobRef" name="jobRef" required>
           <br>
           <br>
           <input type="hidden" name="action" value="list_by_job">
           <input type="submit" value="Search">
       </form>


       <!-- Form for listing EOIs by applicant name -->
       <h2 class="manage">List EOIs by Applicant Name</h2>
       <form method="post">
           <label class="label" for="firstName">First Name:</label>
           <input class="name" type="text" id="firstName" name="firstName">
           <br>
           <label class="label" for="lastName">Last Name:</label>
           <input class="name" type="text" id="lastName" name="lastName">
           <input type="hidden" name="action" value="list_by_name">
           <br>
           <input type="submit" value="Search">
       </form>


           <!-- Form for deleting EOIs by job reference -->
       <h2 class="manage">Delete EOIs by Job Reference Number</h2>
       <form method="post">
           <label class="label" for="job_ref_delete">Job Reference Number:</label>
           <input type="text" id="job_ref_delete" name="job_ref_delete" required>
           <br>
           <br>
           <input type="hidden" name="action" value="delete_by_job">
           <input type="submit" value="Delete" onclick="return confirm('Are you sure you want to delete all EOIs for this job reference?');">
       </form>


       <!-- Form for updating EOI status -->
       <h2 class="manage">Change EOI Status</h2>
       <form method="post">
           <label class="label" for="eoi_number">EOI Number:</label>
           <input class="name" type="number" id="eoi_number" name="eoi_number" required>
           <br>
           <label class="label" for="status">New Status:</label>
           <select id="status" name="status" required>
               <option value="New">New</option>
               <option value="Current">Current</option>
               <option value="Final">Final</option>
           </select>
           <br>
           <br>
           <input type="hidden" name="action" value="update_status">
           <input type="submit" value="Update Status">
       </form>
   </div>
  
</div>

  <!-- Display results -->
   <?php if (is_object($result) && $result->num_rows > 0) { ?>
       <h2 class="manage">Results</h2>
       <div class="table-container">
           <table class="manage_table">
               <tr>
                   <th>EOI Number</th>
                   <th>Job Reference</th>
                   <th>First Name</th>
                   <th>Last Name</th>
                   <th>Birthday</th>
                   <th>Gender</th>
                   <th>Street Address</th>
                   <th>Suburb/town</th>
                   <th>State</th>
                   <th>Postcode</th>
                   <th>Email</th>
                   <th>Phone</th>
                   <th>Status</th>
                   <th>Skills</th>
               </tr>
               <?php while ($row = $result->fetch_assoc()) { ?>
                   <tr>
                       <td><?php echo $row['EOInumber']; ?></td>
                       <td><?php echo $row['jobRef']; ?></td>
                       <td><?php echo $row['firstName']; ?></td>
                       <td><?php echo $row['lastName']; ?></td>
                       <td><?php echo $row['dob']; ?></td>
                       <td><?php echo $row['gender']; ?></td>
                       <td><?php echo $row['address']; ?></td>
                       <td><?php echo $row['suburb']; ?></td>
                       <td><?php echo $row['state']; ?></td>
                       <td><?php echo $row['postcode']; ?></td>
                       <td><?php echo $row['email']; ?></td>
                       <td><?php echo $row['phone']; ?></td>
                       <td><?php echo $row['status']; ?></td>
                       <td><?php echo $row['skills']; ?></td>
                       <td><?php echo $row['otherSkills']; ?></td>
                   </tr>
               <?php } ?>
           </table>
       </div>
       <br>
   <?php } elseif (is_string($result) && !empty($result)) { ?>
       <p><?php echo $result; ?></p>
   <?php } elseif (is_object($result) && $result->num_rows === 0) { ?>
       <p>No records found.</p>
   <?php } ?>


   <br>
   <?php include 'footer.inc'; ?>
</body>
</html>


<?php
// Close the database connection
$conn->close();
?>

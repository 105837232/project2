<?php
// Turn on error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include database config
require_once "settings.php";

// Function to clean input
function clean_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // Collect and sanitize inputs
  $jobRef = clean_input($_POST["referenceNumber"]);
  $firstName = clean_input($_POST["firstName"]);
  $lastName = clean_input($_POST["lastName"]);
  $dob = clean_input($_POST["date"]);
  $gender = clean_input($_POST["gender"]);
  $address = clean_input($_POST["address"]);
  $suburb = clean_input($_POST["suburb"]);
  $state = clean_input($_POST["state"]);
  $postcode = clean_input($_POST["postcode"]);
  $email = clean_input($_POST["email"]);
  $phone = clean_input($_POST["phone"]);
  $skills = $_POST["skills"] ?? [];
  $skill1 = $skills[0] ?? "";
  $skill2 = $skills[1] ?? "";
  $skill3 = $skills[2] ?? "";
  $skill4 = $skills[3] ?? "";
  $otherSkills = clean_input($_POST["otherSkillsDescription"] ?? "");

  // Error handling
  $errors = [];

  if (empty($jobRef)) $errors[] = "Job reference is required.";
  if (!preg_match("/^[a-zA-Z]{1,20}$/", $firstName)) $errors[] = "First name must be letters and max 20 chars.";
  if (!preg_match("/^[a-zA-Z]{1,20}$/", $lastName)) $errors[] = "Last name must be letters and max 20 chars.";
  if (!preg_match("/^\d{4}-\d{2}-\d{2}$/", $dob)) $errors[] = "Date of birth must be yyyy-mm-dd.";
  if (!in_array($gender, ["Male", "Female", "Other"])) $errors[] = "Gender is required.";
  if (empty($address)) $errors[] = "Address is required.";
  if (empty($suburb)) $errors[] = "Suburb is required.";
  if (!in_array($state, ['VIC','NSW','QLD','NT','WA','SA','TAS','ACT'])) $errors[] = "Invalid state.";
  if (!preg_match("/^\d{4}$/", $postcode)) $errors[] = "Postcode must be 4 digits.";
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Invalid email format.";
  if (!preg_match("/^\d{8,12}$/", $phone)) $errors[] = "Phone must be 8–12 digits.";

  // Show errors if any
  if (!empty($errors)) {
    echo "<h2>Form errors:</h2><ul>";
    foreach ($errors as $error) {
      echo "<li>$error</li>";
    }
    echo "</ul><a href='apply.php'>Go back</a>";
    exit();
  }

  // SQL Insert
  $query = "INSERT INTO eoi (
    referenceNumber, firstName, lastName, date, gender,
    address, suburb, state, postcode, email, phone,
    skill1, skill2, skill3, skill4, otherSkillsDescription, status
  ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'New')";

  // Prepare and bind
  $stmt = mysqli_prepare($conn, $query);
  mysqli_stmt_bind_param($stmt, "ssssssssssssssss",
    $jobRef, $firstName, $lastName, $dob, $gender,
    $address, $suburb, $state, $postcode, $email, $phone,
    $skill1, $skill2, $skill3, $skill4, $otherSkills
  );

  // Execute
  if (mysqli_stmt_execute($stmt)) {
    $eoiNumber = mysqli_insert_id($conn);
    echo "<h2>Application Submitted</h2>";
    echo "<p>Your Expression of Interest number is: <strong>$eoiNumber</strong></p>";
    echo "<a href='index.php'>Return to Home</a>";
  } else {
    echo "<p>There was a problem submitting your application.</p>";
  }

  // Close
  mysqli_stmt_close($stmt);
  mysqli_close($conn);

} else {
  header("Location: apply.php");
  exit();
}
?>

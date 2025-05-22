<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EOI Management</title>
</head>
<body>
    <h1>EOI Management Page</h1>
    
    <h2>List All EOIs</h2>
    <form method="post" action="">
        <input type="submit" name="list_all" value="List All EOIs">
    </form>
    
    <h2>List EOIs by Job Reference</h2>
    <form method="post" action="">
        <input type="text" name="job_ref" placeholder="Enter Job Reference Number" required>
        <input type="submit" name="list_by_job" value="List EOIs">
    </form>
    
    <h2>List EOIs by Applicant</h2>
    <form method="post" action="">
        <input type="text" name="first_name" placeholder="First Name">
        <input type="text" name="last_name" placeholder="Last Name">
        <input type="submit" name="list_by_applicant" value="List EOIs">
    </form>
    
    <h2>Delete EOIs by Job Reference</h2>
    <form method="post" action="">
        <input type="text" name="delete_job_ref" placeholder="Enter Job Reference Number" required>
        <input type="submit" name="delete_eoi" value="Delete EOIs">
    </form>
    
    <h2>Change EOI Status</h2>
    <form method="post" action="">
        <input type="text" name="status_job_ref" placeholder="Enter Job Reference Number" required>
        <input type="text" name="new_status" placeholder="Enter New Status" required>
        <input type="submit" name="change_status" value="Change Status">
    </form>

    <?php

    // Database connection
    $conn = new mysqli('localhost', 'username', 'password', 'database');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // List all EOIs
    if (isset($_POST['list_all'])) {
        $sql = "SELECT * FROM eoi";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "ID: " . $row["id"]. " - Job Ref: " . $row["job_ref"]. " - Applicant: " . $row["applicant_name"]. "<br>";
            }
        } else {
            echo "0 results";
        }
    }

    // List EOIs by Job Reference
    if (isset($_POST['list_by_job'])) {
        $job_ref = $_POST['job_ref'];
        $sql = "SELECT * FROM eoi WHERE job_ref = '$job_ref'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "ID: " . $row["id"]. " - Job Ref: " . $row["job_ref"]. " - Applicant: " . $row["applicant_name"]. "<br>";
            }
        } else {
            echo "0 results";
        }
    }

    // List EOIs by Applicant
    if (isset($_POST['list_by_applicant'])) {
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $sql = "SELECT * FROM eoi WHERE first_name LIKE '%$first_name%' AND last_name LIKE '%$last_name%'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "ID: " . $row["id"]. " - Job Ref: " . $row["job_ref"]. " - Applicant: " . $row["applicant_name"]. "<br>";
            }
        } else {
            echo "0 results";
        }
    }

    // Delete EOIs by Job Reference
    if (isset($_POST['delete_eoi'])) {
        $delete_job_ref = $_POST['delete_job_ref'];
        $sql = "DELETE FROM eoi WHERE job_ref = '$delete_job_ref'";
        if ($conn->query($sql) === TRUE) {
            echo "EOIs deleted successfully.";
        } else {
            echo "Error deleting EOIs: " . $conn->error;
        }
    }

    // Change EOI Status
    if (isset($_POST['change_status'])) {
        $status_job_ref = $_POST['status_job_ref'];
        $new_status = $_POST['new_status'];
        $sql = "UPDATE eoi SET status = '$new_status' WHERE job_ref = '$status_job_ref'";
        if ($conn->query($sql) === TRUE) {
            echo "Status updated successfully.";
        } else {
            echo "Error updating status: " . $conn->error;
        }
    }
    include 'footer.inc';
        //connect to data base
        require_once("settings.php");

    $conn->close();
    ?>
</body>
</html>
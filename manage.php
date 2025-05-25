<?php
session_start();
if (!isset($_SESSION['authenticated']) || !$_SESSION['authenticated']) {
    header("Location: ./login.php");
}

require_once("settings.php");
    $conn = mysqli_connect($host, $username, $password, $database);

if ($conn) {
    // Ensure the eoi table exists
    $new_table = file_get_contents("./functions/eoi.sql");
    if (mysqli_multi_query($conn, $new_table)) {
        do {
            if ($result = mysqli_store_result($conn)) {
                mysqli_free_result($result);
            }
        } while (mysqli_next_result($conn));
    }
}

$query = "SELECT * FROM eoi";

if (isset($_POST['referenceNumber']) && $_POST['referenceNumber'] != "") {
    $job_ref = $_POST['referenceNumber'];
    $query .= " WHERE referenceNumber = '$jobRef'";
}

if (isset($_POST['firstName']) && $_POST['firstName'] != "") {
    $firstName = $_POST['firstName'];
    $query .= (strpos($query, 'WHERE') === false ? " WHERE " : " AND ") . "firstName LIKE '$firstName%'";
}

if (isset($_POST['lastName']) && $_POST['lastName'] != "") {
    $lastName = $_POST['lastName'];
    $query .= (strpos($query, 'WHERE') === false ? " WHERE " : " AND ") . "lastName LIKE '$lastName%'";
}

if (isset($_POST['delete_job_ref'])) {
    $delete_job_ref = $_POST['delete_job_ref'];
    mysqli_query($conn, "DELETE FROM eoi WHERE referenceNumber = '$delete_job_ref'");
    header("Location: ./manage.php");
}

if (isset($_POST['eoi_id']) && isset($_POST['new_status'])) {
    $eoi_id = $_POST['eoi_id'];
    $new_status = $_POST['new_status'];
    mysqli_query($conn, "UPDATE eoi SET status = '$new_status' WHERE id = '$eoi_id'");
}

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Your Name">
    <meta name="keyword" content="manager, eoi">
    <meta name="description" content="Manage EOIs">
    <link rel="stylesheet" href="styles/style.css">
    <title>Manage EOIs</title>
</head>
<body>
    <?php include 'header.inc'; ?>
    <main>
        <h1>Manage EOIs</h1>
        <form action="manage.php" method="post">
            <label for="referenceNumber">Job Reference:</label>
            <input type="text" id="referenceNumber" name="referenceNumber">

            <label for="firstName">First Name:</label>
            <input type="text" id="firstName" name="firstName">

            <label for="lastName">Last Name:</label>
            <input type="text" id="lastName" name="lastName">

            <input type="submit" value="Search">
        </form>

        <form action="manage.php" method="post">
            <label for="delete_job_ref">Delete EOIs for Job Reference:</label>
            <input type="text" id="delete_job_ref" name="delete_job_ref">
            <input type="submit" value="Delete">
        </form>

        <table>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Job Reference</th>
                <th>Status</th>
                <th>Options</th>
            </tr>
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>{$row['id']}</td>";
                echo "<td>{$row['firstName']}</td>";
                echo "<td>{$row['lastName']}</td>";
                echo "<td>{$row['referenceNumber']}</td>";
                echo "<td>{$row['status']}</td>";
                echo "<td>
                        <form action='manage.php' method='post'>
                            <input type='hidden' name='eoi_id' value='{$row['id']}'>
                            <select name='new_status'>
                                <option value='PENDING'>PENDING</option>
                                <option value='APPROVED'>APPROVED</option>
                                <option value='REJECTED'>REJECTED</option>
                            </select>
                            <input type='submit' value='Change Status'>
                        </form>
                      </td>";
                echo "</tr>";
            }
            ?>
        </table>
    </main>
<?php include 'footer.inc'; ?>
</body>
</html>

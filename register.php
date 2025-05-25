<?php
require_once("settings.php");

$message = "";
$input_username = ""; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = mysqli_connect($host, $username, $password, $database);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $input_username = trim($_POST['username']); 
    $input_password = trim($_POST['password']);

    $password_valid = true;
    $password_error_message = "";

    $regex = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^A-Za-z0-9]).{8,}$/';

    if (!preg_match($regex, $input_password)) {
        $password_valid = false;
        $password_error_message .= "Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, one number, and one symbol.<br>";
    }

    if ($password_valid) {
        $hashed_password = password_hash($input_password, PASSWORD_DEFAULT);

        $query = "INSERT INTO users (username, password) VALUES (?, ?)";
        $stmt = mysqli_prepare($conn, $query);

        if ($stmt) {
            try {
                mysqli_stmt_bind_param($stmt, "ss", $input_username, $hashed_password);
                $result = mysqli_stmt_execute($stmt);

                if ($result) {
                    $message = "✅ Signup successful. You can now <a href='login.php'>login</a>.";
                    $input_username = ""; // Clear username on successful signup
                } else {
                    // This 'else' block might not be reached if an exception is thrown
                    $message = "❌ Signup failed. Please try again. Error: " . mysqli_error($conn);
                }
            } catch (mysqli_sql_exception $e) {
                // Catch the duplicate entry exception
                if ($e->getCode() == 1062) { // 1062 is the error code for duplicate entry
                    $message = "❌ Signup failed. Username already exists. Please choose a different one.";
                } else {
                    // Re-throw other unexpected SQL exceptions
                    $message = "❌ Signup failed. An unexpected database error occurred: " . $e->getMessage();
                    // For debugging, you might want to log the full exception: error_log($e->getMessage());
                }
            } finally {
                // Ensure statement is closed regardless of success or failure
                mysqli_stmt_close($stmt);
            }
        } else {
            $message = "❌ Signup failed: Could not prepare statement. " . mysqli_error($conn);
        }
    } else {
        $message = "❌ Signup failed: <br>" . $password_error_message;
        // Username already retained from $input_username assignment above
    }


    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title> <link rel="stylesheet" href="styles/styles.css">
</head>
<body>
    <?php include 'header.inc'; ?>
    <h2 id="applyh2">Manager Register</h2>
    <?php if (!empty($message)) : ?>
        <p><?php echo $message; ?></p>
    <?php endif; ?>
    <div class="container">
    <form action="register.php" method="post">
        <label for="username">Please enter a Username:</label><br>
        <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($input_username); ?>" required><br><br>
        <label for="password">Please enter a Password:</label><br>
        <input type="password" id="password" name="password" required><br><br>
        <input type="submit" value="Sign Up">
    </form>
    </div>
    <p>Already have an account? <a href="login.php">Login here</a>.</p>
    <?php include 'footer.inc'; ?>
</body>
</html>
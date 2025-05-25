<?php
require_once("settings.php");

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = mysqli_connect($host, $username, $password, $database);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $input_username = trim($_POST['username']);
    $input_password = trim($_POST['password']);

    $hashed_password = password_hash($input_password, PASSWORD_DEFAULT);

    $query = "INSERT INTO users (username, password) VALUES (?, ?)";
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ss", $input_username, $hashed_password);
        $result = mysqli_stmt_execute($stmt);

        if ($result) {
            $message = "✅ Signup successful. You can now <a href='login.php'>login</a>.";
        } else {
            if (mysqli_errno($conn) == 1062) { 
                $message = "❌ Signup failed. Username already exists. Please choose a different one.";
            } else {
                $message = "❌ Signup failed. Please try again. Error: " . mysqli_error($conn);
            }
        }
        mysqli_stmt_close($stmt);
    } else {
        $message = "❌ Signup failed: Could not prepare statement.";
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
    <h2>Register Page</h2>
    <?php if (!empty($message)) : ?>
        <p><?php echo $message; ?></p>
    <?php endif; ?>
    <div class="container">
    <form action="register.php" method="post"> <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" required><br><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br><br>
        <input type="submit" value="Sign Up">
    </form>
    </div>
    <p>Already have an account? <a href="login.php">Login here</a>.</p>
    <?php include 'footer.inc'; ?>
</body>
</html>
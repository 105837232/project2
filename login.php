<?php
session_start();
require_once("settings.php");

$message = ""; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = mysqli_connect($host, $username, $password, $database);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $input_username = trim($_POST['username']);
    $input_password = trim($_POST['password']);

    $query = "SELECT username, password FROM users WHERE username = ?";
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $input_username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $user = mysqli_fetch_assoc($result);

        if ($user && password_verify($input_password, $user['password'])) {
            $_SESSION['username'] = $user['username'];
            header("Location: welcome.php");
            exit();
        } else {
            $message = "❌ Incorrect username or password.";
        }
        mysqli_stmt_close($stmt);
    } else {
        $message = "❌ Login failed: Could not prepare statement.";
    }

    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles/styles.css">
</head>
<body>
    <?php include 'header.inc'; ?>
    <h2>Login</h2>
    <?php if (!empty($message)) : ?>
        <p><?php echo $message; ?></p>
    <?php endif; ?>
    <div class="container">
    <form action="login.php" method="post">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" required><br><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br><br>
        <input type="submit" value="Login">
    </form>
    </div>
    <p>Don't have an account? <a href="register.php">Register here</a>.</p>
    <?php include 'footer.inc'; ?>
</body>
</html>
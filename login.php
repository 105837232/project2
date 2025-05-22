<?php
//if logged in, go to manager page
    session_start();
    if (isset($_SESSION['authenticated']) && $_SESSION['authenticated']) {
        header("Location: ./manage.php");
    }

    require_once("settings.php");
    $conn = @mysqli_connect($host, $user, $pwd, $sql_db);

    if ($conn) {
        $new_table = file_get_contents("./functions/orderdb.sql");
        mysqli_multi_query($conn, $new_table);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Teagan O, Tisang L, Anna S, Joshua T">
    <meta name="keyword" content="login">
    <meta name="description" content="Assignment 2">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
    <link rel="stylesheet" href="styles/style.css">
    <title>Login</title>
</head>
<body>
	<?php 

        include 'includes/header.inc';
        //connect to data base
        require_once("settings.php");
    
        $conn = @mysqli_connect($host, $user, $pwd, $sql_db);
        if (!$conn) {
            echo "<p>Database connection failure</p>";
        }

    ?>

    <div class="loginpage">
        <form action="authentication.php" method="post" class="loginform" novalidate>
            <h2>Manager Login</h2>
            <label for="username">Username:</label>
            <input type="text" name="username" id="username">
    
            <label for="password">Password:</label>
            <input type="password" name="password" id="password">

            <input type="submit" value="Login">
            <p class="errMsg"> <?php if (isset($err) && $err != "") echo htmlspecialchars($err) ?> </p>
        </form>
    </div>

	<?php include 'includes/footer.inc' ?>

</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" >
    <meta name="description" content="About us page" >
    <meta name="keywords" content="HTML, About Members," >
    <meta name="author" content="Anna Sakaida"  >
    <title>About JigSaw</title>
    <link rel="stylesheet" href="styles/styles.css">
</head>

<body>
    <!--replaced the header with a php include-->
    <?php include 'header.inc'; ?>
    <main>
        <div id="container">
            <p>The enhancements that I have made to this project are to the register page. This allows the user to register themselves as a new manager and create a new name. 
            This is done by using a form that takes in the username and password. This information is then stored in a database called Project_2_db, in a table called users. 
            The page also includes a password validation technique that ensures the password entered by the user has at least 8 characters, one uppercase letter, one lowercase 
            letter, one number, and one symbol. The page also includes a form of hashing that encrypts the password entered by the user. This is achieved by using the 
            password_hash function in PHP. This ensures that the password is stored securely in the database. The page also includes a message that informs the user if the 
            registration was successful or not.</p>
        </div>
    <!--Footer Section-->
    <!--replaced the footer with a php include-->
      <?php include 'footer.inc'; ?>
</body>



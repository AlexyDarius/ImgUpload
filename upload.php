<!DOCTYPE html>
<html>
<head>
    <title>Upload images</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>

<?php
    session_start();
    if (!isset($_SESSION['authenticated']) || !$_SESSION['authenticated']) {
        header('Location: login.php'); // Redirect to the login page if not authenticated
        exit;
    }
?>

    <header>
        <h1>Hello World !</h1>
    </header>

<footer>
        &copy; 2023 Your Website Name
    </footer>
</body>
</html>
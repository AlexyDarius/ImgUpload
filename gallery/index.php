<!DOCTYPE html>
<html>
<head>
    <title>Image Gallery</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <header>
        <h1>Image Gallery</h1>
    </header>

    <div id="image-container">

<?php

require $_SERVER['DOCUMENT_ROOT']. '/gallery/requires/gallery_displayer.php';

?>

    </div>

    <a href="back_office.php">Gestion</a> <!-- Add the button with a link to login.php -->

    <footer>
        &copy; 2023 Your Website Name
    </footer>
</body>
</html>

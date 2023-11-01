<!DOCTYPE html>
<html>
<head>
    <title>Upload images</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>

<?php

require $_SERVER['DOCUMENT_ROOT']. '/gallery/auth/checker.php';
require $_SERVER['DOCUMENT_ROOT']. '/gallery/requires/upload_image.php';

?>

    <header>
        <h1>Hello World !</h1>
    </header>

    <!-- Form for uploading images -->
    <div id="upload-container">
        <form id="image-upload-form" method="post" enctype="multipart/form-data" onsubmit="uploadImage(event);">
            <label for="image">Select an image to upload:</label>
            <input type="file" name="image" id="image" accept="image/*" required>
            <input type="hidden" name="MAX_FILE_SIZE" value="100000"> <!-- 100ko -->
            <label for="legend">Image Legend:</label>
            <input type="text" name="legend" id="legend" required maxlength="255">
            <button type="submit">Upload Image</button>
            <div id="error-message" style="color: red; display: none;"></div>
        </form>
        <div id="status-message"></div>
    </div>

    <div id="image-container">

<?php

require $_SERVER['DOCUMENT_ROOT']. '/gallery/requires/back_office_display.php';

?>

    </div>
    <a href="index.php">Home</a>


    <footer>
        &copy; 2023 Your Website Name
    </footer>

    <script src="js/script.js"></script>
    <script src="js/uploadImage.js"></script>

</body>
</html>

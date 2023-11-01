<?php
include "https://dariusdev.fr/includes/head.php"
?>

    <title>Upload images</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body style="--bs-body-bg: #e3f3f5;--bs-body-bg-t: rgba(227, 243, 245, 0.9);--bs-primary: #0c3028;--bs-secondary: #f53219;--bs-primary-t: rgba(12, 48, 40, 0.85);background: var(--bs-body-bg);font-family: Lato-Regular;color: var(--bs-primary);">

<?php

require $_SERVER['DOCUMENT_ROOT']. '/gallery/auth/checker.php';
require $_SERVER['DOCUMENT_ROOT']. '/gallery/requires/upload_image.php';

?>

<?php
include "https://dariusdev.fr/includes/navbar.php"
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

<?php
include "https://dariusdev.fr/includes/footer.php"
?>

</body>
</html>

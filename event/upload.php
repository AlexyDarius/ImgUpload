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

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
    $upload_dir = "images/"; // Directory where you want to store uploaded images
    $uploaded_file = $upload_dir . basename($_FILES['image']['name']);
    $legend = $_POST['legend']; // Get the legend from the form

    if (move_uploaded_file($_FILES['image']['tmp_name'], $uploaded_file)) {
        // Image uploaded successfully
        $imageFilename = basename($_FILES['image']['name']);
        $uploadedBy = $_SESSION['username'];

        // Connect to the MySQL database
        $conn = new mysqli("localhost", "root", "root", "img_upload");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Insert image information and legend into the database
        $sql = "INSERT INTO images (filename, uploaded_by, legend) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $imageFilename, $uploadedBy, $legend);

        if ($stmt->execute()) {
            echo "Image uploaded and information stored in the database!";
        } else {
            header("HTTP/1.1 500 Internal Server Error");
            echo "Image uploaded, but failed to store information in the database. Please try again.";
        }

        $stmt->close();
        $conn->close();
    } else {
        header("HTTP/1.1 500 Internal Server Error");
        echo "Image upload failed. Please try again.";
    }
}

?>

    <header>
        <h1>Hello World !</h1>
    </header>

    <!-- Form for uploading images -->
    <div id="upload-container">
        <form id="image-upload-form" method="post" enctype="multipart/form-data" onsubmit="uploadImage(event);">
            <label for="image">Select an image to upload:</label>
            <input type="file" name="image" id="image" accept="image/*" required>
            <label for="legend">Image Legend:</label>
            <input type="text" name="legend" id="legend" required maxlength="255">
            <button type="submit">Upload Image</button>
        </form>
        <div id="status-message"></div>
    </div>



    <footer>
        &copy; 2023 Your Website Name
    </footer>

    <script src="js/AJAXForm.js">
    <script src="js/maxLength.js">

</body>
</html>

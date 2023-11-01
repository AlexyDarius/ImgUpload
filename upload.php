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

        if (move_uploaded_file($_FILES['image']['tmp_name'], $uploaded_file)) {
            echo "Image uploaded successfully!";
        } else {
            echo "Image upload failed. Please try again.";
        }
    }
?>

    <header>
        <h1>Hello World !</h1>
    </header>

    <!-- Form for uploading images -->
    <div id="upload-container">
        <form method="post" enctype="multipart/form-data">
            <label for="image">Select an image to upload:</label>
            <input type="file" name="image" id="image" accept="image/*" required>
            <button type="submit">Upload Image</button>
        </form>
    </div>

    <footer>
        &copy; 2023 Your Website Name
    </footer>
</body>
</html>

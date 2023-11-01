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
        // Image uploaded successfully, now insert the image information into the database
        $imageFilename = basename($_FILES['image']['name']);
        $uploadedBy = isset($_SESSION['username']) ? $_SESSION['username'] : ''; // Assuming you have a username in the session
        
        // Connect to the MySQL database (adjust the connection details as per your configuration)
        $conn = new mysqli("localhost", "root", "root", "img_upload");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Insert image information into the database
        $sql = "INSERT INTO images (filename, uploaded_by) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $imageFilename, $uploadedBy);

        if ($stmt->execute()) {
            echo "Image uploaded and information stored in the database!";
        } else {
            echo "Image uploaded, but failed to store information in the database. Error: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
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

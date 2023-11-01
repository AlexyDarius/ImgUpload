<?php

require $_SERVER['DOCUMENT_ROOT']. '/gallery/auth/checker.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['image_id'])) {
    // Retrieve the image ID from the POST request
    $imageId = $_POST['image_id'];

    // Connect to the MySQL database
    $conn = new mysqli("localhost", "root", "root", "img_upload");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve the image filename from the database
    $sql = "SELECT filename FROM images WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $imageId);
    $stmt->execute();
    $stmt->bind_result($imageFilename);
    $stmt->fetch();
    $stmt->close();

    if (!empty($imageFilename)) {
        // Delete the image file from the server
        $imagePath = "../images/" . $imageFilename;
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }

        // Delete the database entry
        $sql = "DELETE FROM images WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $imageId);
        $stmt->execute();
        $stmt->close();

        echo "Image deleted successfully!";
    } else {
        echo "Image not found.";
    }

    $conn->close();
}

?>

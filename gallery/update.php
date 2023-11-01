<?php
session_start();
if (!isset($_SESSION['authenticated']) || !$_SESSION['authenticated']) {
    header('Location: login.php'); // Redirect to the login page if not authenticated
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the image ID and edited legend from the POST data
    $imageId = $_POST['image_id'];
    $editedLegend = $_POST['legend'];

    // Update the database with the new legend (replace with your database update code)
    $conn = new mysqli("localhost", "root", "root", "img_upload");

    // Ensure you use prepared statements to prevent SQL injection
    $sql = "UPDATE images SET legend = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $editedLegend, $imageId);

    if ($stmt->execute()) {
        // Database update successful
        echo "Legend updated successfully!";
    } else {
        // Handle database update failure
        header("HTTP/1.1 500 Internal Server Error");
        echo "Legend update failed. Please try again.";
    }

    $stmt->close();
    $conn->close();
}
?>

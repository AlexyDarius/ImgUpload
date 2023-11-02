<?php

require $_SERVER['DOCUMENT_ROOT']. '/gallery/auth/checker.php';

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
        echo "Légende mise à jour avec succès !";
    } else {
        // Handle database update failure
        header("HTTP/1.1 500 Internal Server Error");
        echo "Impossible de metter à jour la légende. Réessayez.";
    }

    $stmt->close();
    $conn->close();
}
?>

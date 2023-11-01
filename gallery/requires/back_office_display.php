<?php
// Connect to the MySQL database (adjust the connection details as per your configuration)
$conn = new mysqli("localhost", "root", "root", "img_upload");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve image information from the database
$sql = "SELECT filename, legend, id FROM images ORDER BY upload_date DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $imagePath = "images/" . $row['filename'];
        $imageId = $row['id'];
        $legend = $row['legend'];
        
        echo "<div class='image-box'>";
        echo "<img src='$imagePath' alt='Image'>";
        echo "<p id='legend-$imageId'>$legend</p>";
        echo "<button class='delete-button' data-image-id='$imageId'>Delete</button>";
        echo " <button class='edit-button' data-image-id='$imageId'>Edit</button>";

        echo "<div class='edit-container' id='edit-container-$imageId' style='display: none;'>";
        echo "<input type='text' id='edited-legend-$imageId' placeholder='Edit the legend'>";
        echo "<button class='save-button' id='save-button-$imageId' data-image-id='$imageId'>Save</button>";
        echo "<button class='cancel-button' id='cancel-button-$imageId' data-image-id='$imageId'>Cancel</button>";
        echo "</div>";

        echo "</div>";
    }
} else {
    echo "No images found.";
}

$conn->close();
?>
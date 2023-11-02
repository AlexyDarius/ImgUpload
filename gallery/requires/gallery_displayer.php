<?php
// Connect to the MySQL database (adjust the connection details as per your configuration)
$conn = new mysqli("localhost", "root", "root", "img_upload");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve image information from the database
$sql = "SELECT filename, legend FROM images ORDER BY upload_date DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $imagePath = "images/" . $row['filename'];
        $legend = $row['legend'];
        
        echo "<div class='image-box'>";
        echo "<a href='$imagePath' class='image-link'>";
        echo "<img src='$imagePath' alt='$legend'>";
        echo "</a>";
        echo "<p>$legend</p>";
        echo "</div>";
    }
} else {
    echo "Aucune image trouvée.";
}

$conn->close();
?>
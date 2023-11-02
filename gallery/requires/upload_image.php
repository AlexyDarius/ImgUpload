<?php 
// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
    $upload_dir = "images/"; // Directory where you want to store uploaded images
    $uploaded_file = $upload_dir . basename($_FILES['image']['name']);
    $legend = $_POST['legend'];
    $max_file_size = 100000; // 100kb

    // Check the file size
   if ($_FILES['image']['size'] > $max_file_size) {
    header("HTTP/1.1 400 Bad Request");
    echo "File size exceeds the maximum allowed size (100KB).";
    }else{

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
                echo "Image téléchargée et information stockées !";
            } else {
                header("HTTP/1.1 500 Internal Server Error");
                echo "Image téléchargée mais il est impossible de stocker les informations. Réessayez.";
            }

            $stmt->close();
            $conn->close();
        } else {
            header("HTTP/1.1 500 Internal Server Error");
            echo "Impossible de télécharger l'image. Réessayez.";
        }
    }
}
?>

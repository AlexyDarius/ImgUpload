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
    </div>
    <!-- <div class="edit-container" style="display: none;">
        <input type="text" id="edited-legend" placeholder="Edit the legend">
        <button class="save-button">Save</button>
        <button class="cancel-button">Cancel</button>
    </div> -->
    <a href="index.php">Home</a>


    <footer>
        &copy; 2023 Your Website Name
    </footer>

    <script src="js/script.js"></script>

</body>
</html>

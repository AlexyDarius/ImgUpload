<!DOCTYPE html>
<html>
<head>
    <title>Image Gallery</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <header>
        <h1>Image Gallery</h1>
    </header>

    <div id="image-container">
        <?php
        // Connect to the MySQL database (adjust the connection details as per your configuration)
        $conn = new mysqli("localhost", "root", "root", "img_upload");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Retrieve image information from the database
        $sql = "SELECT filename, uploaded_by FROM images ORDER BY upload_date DESC";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $imagePath = "images/" . $row['filename'];
                $uploadedBy = $row['uploaded_by'];
                
                echo "<div class='image-box'>";
                echo "<img src='$imagePath' alt='Image'>";
                echo "<p>Uploaded by: $uploadedBy</p>";
                echo "</div>";
            }
        } else {
            echo "No images found.";
        }

        $conn->close();
        ?>
    </div>

    <a href="login.php">Login</a> <!-- Add the button with a link to login.php -->

    <footer>
        &copy; 2023 Your Website Name
    </footer>
</body>
</html>

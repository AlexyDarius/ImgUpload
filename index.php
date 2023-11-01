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
        // You would typically fetch image data from your database here and generate divs accordingly
        // For this example, we'll create a simple static div for demonstration purposes
        $imageData = array(
            array("analytics.webp", "User 1"),
            array("android.webp", "User 2"),
            array("apache.webp", "User 3"),
        );

        foreach ($imageData as $data) {
            $imagePath = "images/" . $data[0];
            $userName = $data[1];
            echo "<div class='image-box'>";
            echo "<img src='$imagePath' alt='Image'>";
            echo "<p>Uploaded by: $userName</p>";
            echo "</div>";
        }
        ?>
    </div>

    <footer>
        &copy; 2023 Your Website Name
    </footer>
</body>
</html>

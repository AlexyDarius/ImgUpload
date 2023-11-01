function uploadImage(event) {
    event.preventDefault(); // Prevent the form from being submitted normally

    let form = document.getElementById('image-upload-form');
    let legendInput = document.getElementById('legend');
    let errorMessage = document.getElementById('error-message');

    if (legendInput.value.length > 255) {
        errorMessage.textContent = "Legend is too long. Please keep it under 255 characters.";
        errorMessage.style.display = 'block'; // Display the error message
        return;
    }

    // Check the file size
    let maxFileSize = 100 * 1024; // 100KB in bytes
    if (document.getElementById('image').files[0].size > maxFileSize) {
        errorMessage.textContent = "File size exceeds the maximum allowed size (100KB).";
        errorMessage.style.display = 'block'; // Display the error message
        return;
    }

    // Reset error message if no errors
    errorMessage.style.display = 'none';

    //AJAX request
    let formData = new FormData(form);

    // Create an XMLHttpRequest object
    let xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                // Image uploaded successfully
                document.getElementById('status-message').textContent = 'Image uploaded successfully!';
                form.reset(); // Clear the form
            } else {
                // Image upload failed
                document.getElementById('status-message').textContent = 'Image upload failed. Please try again.';
            }
        }
    };

    // Open a POST request to the server
    xhr.open('POST', 'upload.php', true);

    // Send the form data as the request body
    xhr.send(formData);
}

document.addEventListener('DOMContentLoaded', function() {
    // Add an event listener to all delete buttons
    let deleteButtons = document.querySelectorAll('.delete-button');
    deleteButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            let imageId = button.getAttribute('data-image-id');

            // Ask for confirmation
            let confirmation = confirm('Are you sure you want to delete this image?');
            if (confirmation) {
                // User clicked "OK" in the confirmation dialog, proceed with deletion
                let xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        // Image deleted successfully, remove the image from the page
                        let imageBox = button.closest('.image-box');
                        imageBox.remove();
                    } else if (xhr.readyState === 4) {
                        // Handle error if needed
                        console.error("Image deletion failed.");
                    }
                };

                xhr.open('POST', 'delete_image.php', true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.send('image_id=' + imageId);
            } else {
                // User clicked "Cancel" in the confirmation dialog, do nothing
            }
        });
    });
});

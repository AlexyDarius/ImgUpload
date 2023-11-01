function uploadImage(event) {
    event.preventDefault(); // Prevent the form from being submitted normally

    let form = document.getElementById('image-upload-form');
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
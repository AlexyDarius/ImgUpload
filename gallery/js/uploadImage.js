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
    xhr.open('POST', 'back_office.php', true);

    // Send the form data as the request body
    xhr.send(formData);
}
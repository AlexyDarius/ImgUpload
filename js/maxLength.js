function uploadImage(event) {
    event.preventDefault(); // Prevent the form from being submitted normally

    let form = document.getElementById('image-upload-form');
    let legendInput = document.getElementById('legend');

    if (legendInput.value.length > 255) {
        alert("Legend is too long. Please keep it under 255 characters.");
        return;
    }

    let formData = new FormData(form);

    // Create an XMLHttpRequest object and continue with the AJAX request...
}
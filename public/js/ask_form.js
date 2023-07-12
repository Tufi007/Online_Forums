document.addEventListener('DOMContentLoaded', function() {
    const addImageButton = document.getElementById('addImage');
    const imageContainer = document.getElementById('imageContainer');
    const noImagesCheckbox = document.getElementById('noImages');
    const maxImages = 5; // Maximum number of images allowed

    let imageCount = 1; // Initial image count

    addImageButton.addEventListener('click', function() {
        if (imageCount < maxImages) {
            const newInput = document.createElement('input');
            newInput.type = 'file';
            newInput.name = 'images[]';
            newInput.accept = 'image/*';
            imageContainer.appendChild(newInput);
            imageCount++;
        } else {
            alert("You can upload a maximum of 5 images per one particular question");
        }
    });

    noImagesCheckbox.addEventListener('change', function() {
        const imageInputs = imageContainer.querySelectorAll('input[type="file"]');
        if (noImagesCheckbox.checked) {
            imageInputs.forEach(function(input) {
                input.disabled = true;
            });
        } else {
            imageInputs.forEach(function(input) {
                input.disabled = false;
            });
        }
    });
});

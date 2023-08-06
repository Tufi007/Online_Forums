// Code for adding more images while editing a question starts
document.addEventListener('DOMContentLoaded', function() {
    console.log("Heard!");
    const addImageButton = document.getElementById('addImageEditQ');
    const imageContainer = document.getElementById('imageContainerEditQ');
    const maxImages = 5; // Maximum number of images allowed

    let imageCount = 1; // Initial image count

    addImageButton.addEventListener('click', function() {
        console.log("Heard!");
        if (imageCount < maxImages) {
            const newInput = document.createElement('input');
            newInput.type = 'file';
            newInput.name = 'new_images[]';
            newInput.accept = 'image/*';
            imageContainer.appendChild(newInput);
            imageCount++;
        } else {
            alert("You can upload a maximum of 5 images per one particular question");
        }
    });
});
// Code for adding more images while editing a question ends

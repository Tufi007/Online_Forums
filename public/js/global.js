// Get all the image buttons
const imageButtons = document.querySelectorAll('.image-button');

// Add click event listener to each image button
imageButtons.forEach((button) => {
    button.addEventListener('click', () => {
        // Get the corresponding question ID
        const questionId = button.dataset.questionId;

        // Get the image container for this question
        const imageContainer = document.getElementById(`image-container-${questionId}`);

        // Toggle the visibility of the image container
        if (imageContainer.style.display === 'none') {
            imageContainer.style.display = 'block';
            button.textContent = 'Hide Image(s)';
        } else {
            imageContainer.style.display = 'none';
            button.textContent = 'View Image(s)';
        }
    });
});




document.addEventListener('DOMContentLoaded', function () {
    var imageContainer = document.getElementById('imageContainerAnswer');
    var addImageButton = document.getElementById('addImageAnswer');

    var imageCount = 1;
    var maxImages = 5;

    addImageButton.addEventListener('click', function () {
        if (imageCount < maxImages) {
            var imageInput = document.createElement('input');
            imageInput.type = 'file';
            imageInput.name = 'images[]';
            imageInput.accept = 'image/*';
            imageInput.required = false;

            imageContainer.appendChild(imageInput);
            imageCount++;

            if (imageCount === maxImages) {
                addImageButton.disabled = true;
            }
        }
    });
});


const toggleAnswersButton = document.getElementById('toggle-answers-button');
const answersContainer = document.getElementById('answers-container');
const toggleButtons = document.querySelectorAll('.toggle-image-button');

toggleAnswersButton.addEventListener('click', function() {
    if (answersContainer.style.display === 'none') {
        answersContainer.style.display = 'block';
        toggleAnswersButton.textContent = 'Hide Answers';
    } else {
        answersContainer.style.display = 'none';
        toggleAnswersButton.textContent = 'View Answers';
    }
});

toggleButtons.forEach(button => {
    button.addEventListener('click', function() {
        const images = this.parentNode.querySelectorAll('.answer-image');
        images.forEach(image => {
            if (image.style.display === 'none') {
                image.style.display = 'block';
            } else {
                image.style.display = 'none';
            }
        });
    });
});

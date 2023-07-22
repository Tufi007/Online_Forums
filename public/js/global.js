$(document).ready(function() {
    console.log('jQuery is working!');
  });

  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


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

// Upvote Button Click Event
function upvoteQuestion(buttonId) {
    var questionId = $('#' + buttonId).data('id');
    $.ajax({
        url: '/upvote_question/' + questionId,
        type: 'POST',
        success: function(response) {
            // Handle the success response
            console.log(response.message);
        },
        error: function(response) {
            // Handle the error response
            console.log(response);
        }
    });
}

// Downvote Button Click Event
function downvoteQuestion(buttonId) {
    var questionId = $('#' + buttonId).data('id');
    $.ajax({
        url: '/downvote_question/' + questionId,
        type: 'POST',
        success: function(response) {
            // Handle the success response
            console.log(response.message);
        },
        error: function(response) {
            // Handle the error response
            console.log(response);
        }
    });
}


// Upvote Button Click Event for the answer
function upvoteAnswer(buttonId) {
    var answerId = $('#' + buttonId).data('id');
    $.ajax({
        url: '/upvote_answer/' + answerId,
        type: 'POST',
        success: function(response) {
            // Handle the success response
            console.log(response.message);
        },
        error: function(response) {
            // Handle the error response
            console.log(response);
        }
    });
}

// Downvote Button Click Event for the answer
function downvoteAnswer(buttonId) {
    var answerId = $('#' + buttonId).data('id');
    $.ajax({
        url: '/downvote_answer/' + answerId,
        type: 'POST',
        success: function(response) {
            // Handle the success response
            console.log(response.message);
        },
        error: function(response) {
            // Handle the error response
            console.log(response);
        }
    });
}



// Function to show or hide comments
function showComments(buttonId) {
    var button = document.getElementById(buttonId);
    var answerId = button.getAttribute('data-answer-id');
    var commentsContainer = document.getElementById('comments-container-' + answerId);

    if (commentsContainer.style.display === 'none') {
        // Comments container is hidden, show it
        commentsContainer.style.display = 'block';
    } else {
        // Comments container is visible, hide it
        commentsContainer.style.display = 'none';
    }
}


function showData(dataType) {
    // Hide all data divs
    document.getElementById('profileData').style.display = 'none';
    document.getElementById('questionsData').style.display = 'none';
    document.getElementById('answersData').style.display = 'none';
    document.getElementById('commentsData').style.display = 'none';
    document.getElementById('changePasswordData').style.display = 'none';
    document.getElementById('deleteAccountData').style.display = 'none';

    // Show the selected data div
    if (dataType === 'profile') {
        document.getElementById('profileData').style.display = 'block';
    } else if(dataType === 'changePassword'){
        document.getElementById('changePasswordData').style.display = 'block';
    }
    else if (dataType === 'questions') {
        document.getElementById('questionsData').style.display = 'block';
    } else if (dataType === 'answers') {
        document.getElementById('answersData').style.display = 'block';
    } else if (dataType === 'comments') {
        document.getElementById('commentsData').style.display = 'block';
    } else if(dataType === 'deleteAccount'){
        document.getElementById('deleteAccountData').style.display = 'block';
    }
}

// Call the showData function with a default data type (e.g., 'profile')
showData('profile');


function validatePassword() {
    const newPassword = document.getElementById('new_password').value;
    const confirmNewPassword = document.getElementById('confirm_new_password').value;

    if (newPassword !== confirmNewPassword) {
        alert('New password and Confirm new password do not match.');
        return false;
    }

    if (newPassword.length < 8) {
        alert('New password must be at least 8 characters long.');
        return false;
    }

    return true;
}


function confirmDelete() {
    return confirm('Are you sure you want to delete your account?');
}

function navToggleAuth(navBtnId){
    const navBtn = document.getElementById(navBtnId);
    const navItems = document.querySelectorAll('.nav-item');
    const navProfile = document.getElementById("nav-profile");
    navItems.forEach(element => {
        const computedStyle = window.getComputedStyle(element);
        const displayValue = computedStyle.getPropertyValue('display');
        if(displayValue === 'none'){
            element.style.display = "block";
            navProfile.style.display = "flex";
            navBtn.innerHTML = "<i class=\"fa-solid fa-xmark\"></i>";
            navBtn.style.alignSelf = "center";
        } else {
            element.style.display = "none";
            navProfile.style.display = "none";
            navBtn.innerHTML = "<i class=\"fa-solid fa-bars\"></i>";
            navBtn.style.alignSelf = "end";
        }
    });
}
function navToggleGuest(navBtnId){
    const navBtn = document.getElementById(navBtnId);
    const navItems = document.querySelectorAll('.nav-item');
    navItems.forEach(element => {
        const computedStyle = window.getComputedStyle(element);
        const displayValue = computedStyle.getPropertyValue('display');
        if(displayValue === 'none'){
            element.style.display = "block";
            navBtn.innerHTML = "<i class=\"fa-solid fa-xmark\"></i>";
            navBtn.style.alignSelf = "center";
        } else {
            element.style.display = "none";
            navBtn.innerHTML = "<i class=\"fa-solid fa-bars\"></i>";
            navBtn.style.alignSelf = "end";
        }
    });
}

document.addEventListener("DOMContentLoaded", function() {
    const guestNavbar = document.getElementById('guest-navbar');
    const modal = document.getElementById('terms-and-conditions');
    const registerHeading = document.getElementById('register-heading');
    const registerDescription = document.getElementById('register-description');
    const aboutMe = document.getElementById('about_me');
    const note = document.getElementById("note");
    const description = document.getElementById("description");
    const characterCountElement = document.getElementById('character_count');
    const editProfile = document.getElementById('edit-profile');
    const photoUpload = document.getElementById('photo-upload');
    const profileForm = document.getElementById('profile-form');
    const rejectButton = document.getElementById('rejectBooking');
    const yearElement = document.getElementById('currentYear');
    const backButton = document.getElementById('backButton');
    const currentYear = new Date().getFullYear();
  
    if (backButton) {
        backButton.addEventListener('click', function(event) {
            event.preventDefault();
            window.history.back();
        });
    }

    if (aboutMe) {
        aboutMe.addEventListener('input', function() {
            let characterCount = aboutMe.value.length;
            let remainingCount = 500 - characterCount;
            characterCountElement.textContent = remainingCount + ' characters remaining';
        });
    }

    if (note) {
        note.addEventListener('input', function() {
            let characterCount = note.value.length;
            let remainingCount = 300 - characterCount;
            characterCountElement.textContent = remainingCount + ' characters remaining';
        });
    }

    if (description) {
        description.addEventListener('input', function() {
            let characterCount = description.value.length;
            let remainingCount = 300 - characterCount;
            characterCountElement.textContent = remainingCount + ' characters remaining';
        });
    }
    
    if (editProfile) {
        editProfile.addEventListener('click', function(event) {
            event.preventDefault();
            photoUpload.click();
        });
    }
    
    if (photoUpload) {
        photoUpload.addEventListener('change', function() {
            profileForm.submit();
        });
    }

    if (currentYear) {
        yearElement.textContent = currentYear;
    }

    if (rejectButton) {
        rejectButton.addEventListener('click', function(event) {
            event.preventDefault();

            var confirmation = confirm('Are you sure to reject this booking?');
            if (confirmation) {
                window.location.href = rejectButton.href;
            }
        });
    }

    if (modal && guestNavbar && registerHeading && registerDescription) {
        modal.addEventListener('show.bs.modal', function () {
            guestNavbar.style.display = 'none';
        });
        
        modal.addEventListener('hide.bs.modal', function () {
            guestNavbar.style.display = 'block';
        });

        modal.addEventListener('show.bs.modal', function () {
            registerHeading.classList.add('d-none');
            registerDescription.classList.add('d-none');
        });
        
        modal.addEventListener('hide.bs.modal', function () {
            registerHeading.classList.remove('d-none');
            registerDescription.classList.remove('d-none');
        });
    }
});
  
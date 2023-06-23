document.addEventListener("DOMContentLoaded", function() {
    const aboutMe = document.getElementById('about_me');
    const characterCountElement = document.getElementById('character_count');
    const editProfile = document.getElementById('.edit-profile');
    const photoUpload = document.getElementById('photo-upload');
    const profileForm = document.getElementById('profile-form');
    const yearElement = document.getElementById('currentYear');
    const currentYear = new Date().getFullYear();
  
    if (aboutMe) {
        aboutMe.addEventListener('input', function() {
            let characterCount = aboutMe.value.length;
            let remainingCount = 500 - characterCount;
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
});
  
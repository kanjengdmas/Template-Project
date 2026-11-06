// JS to update file input label when a file is selected
document.addEventListener("DOMContentLoaded", function() {
    const fileInput = document.getElementById('avatarFile');
    if (fileInput) {
        fileInput.addEventListener('change', function(e) {
            const fileName = e.target.files[0]?.name || 'Pilih file...';
            const label = e.target.nextElementSibling;
            if (label) {
                label.textContent = fileName;
            }
        });
    }
    
    // Frontend match validation for new password & confirm password
    const form = document.getElementById('changePasswordForm');
    if (form) {
        form.addEventListener('submit', function(e) {
            const newPass = document.getElementById('newPassword').value;
            const confPass = document.getElementById('confirmPassword').value;
            if (newPass !== confPass) {
                e.preventDefault();
                alert('Konfirmasi password baru tidak cocok!');
            }
        });
    }
});

// Live preview of uploaded avatar and label update
document.getElementById('foto').addEventListener('change', function(e) {
    const file = this.files[0];
    if (file) {
        // Check file size
        if (file.size > 2 * 1024 * 1024) {
            alert("Ukuran gambar terlalu besar. Maksimal 2MB!");
            this.value = '';
            return;
        }
        
        // Show preview
        const reader = new FileReader();
        reader.onload = function(event) {
            document.getElementById('avatar-preview').setAttribute('src', event.target.result);
        }
        reader.readAsDataURL(file);
        
        // Show file name
        const infoDiv = document.getElementById('file-name-info');
        infoDiv.innerText = "Terpilih: " + file.name;
        infoDiv.style.display = 'block';
    }
});

// Toggle Password Visibility
document.querySelectorAll('.toggle-password').forEach(function(element) {
    element.addEventListener('click', function() {
        var targetSelector = this.getAttribute('data-target');
        var targetInput = document.querySelector(targetSelector);
        var type = targetInput.getAttribute('type') === 'password' ? 'text' : 'password';
        targetInput.setAttribute('type', type);
        
        var icon = this.querySelector('i');
        icon.classList.toggle('fa-eye-slash');
        icon.classList.toggle('fa-eye');
    });
});

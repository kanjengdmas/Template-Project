document.addEventListener("DOMContentLoaded", function() {
    // Instant profile picture preview
    $('#fotoInput').change(function() {
        const file = this.files[0];
        if (file) {
            let reader = new FileReader();
            reader.onload = function(event) {
                $('#previewFoto').attr('src', event.target.result);
            }
            reader.readAsDataURL(file);
        }
    });

    // Toggle Password Visibility
    $('#toggle-password-btn').on('click', function() {
        let passwordField = $('#password');
        let passwordFieldType = passwordField.attr('type');
        let eyeIcon = $(this).find('i');
        
        if (passwordFieldType === 'password') {
            passwordField.attr('type', 'text');
            eyeIcon.removeClass('fa-eye').addClass('fa-eye-slash');
        } else {
            passwordField.attr('type', 'password');
            eyeIcon.removeClass('fa-eye-slash').addClass('fa-eye');
        }
    });

    $('#formProfil').submit(function(e) {
        e.preventDefault();
        let btn = $('#btnSave');
        btn.html('<i class="fas fa-spinner fa-spin"></i> Menyimpan...').prop('disabled', true);

        let formData = new FormData(this);
        const baseUrl = window.location.origin + '/' + window.location.pathname.split('/')[1] + '/';
        const apiBase = window.AppConfig ? window.AppConfig.baseUrl : baseUrl;

        $.ajax({
            url: apiBase + 'anggota/update_profil',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(response) {
                if(response.status == 'success'){
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: response.message,
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => location.reload());
                } else {
                    Swal.fire('Gagal', response.message, 'error');
                    btn.html('Simpan Perubahan').prop('disabled', false);
                }
            },
            error: function() {
                Swal.fire('Error', 'Terjadi kesalahan sistem.', 'error');
                btn.html('Simpan Perubahan').prop('disabled', false);
            }
        });
    });
});

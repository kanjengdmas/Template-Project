// Preview Image in Modal before uploading
function previewImage(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#profilePreviewModal').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

// Open Modals
function openEditProfileModal() {
    $('#modalEditProfile').modal('show');
}

function openChangePasswordModal() {
    $('#formChangePassword')[0].reset();
    $('#modalChangePassword').modal('show');
}

$(document).ready(function() {
    const baseUrl = window.AppConfig ? window.AppConfig.baseUrl : window.location.origin + '/' + window.location.pathname.split('/')[1] + '/';

    // Submit Edit Profile Form
    $('#formEditProfile').on('submit', function(e) {
        e.preventDefault();
        
        var btn = $('#btnSaveProfile');
        var originalText = btn.html();
        btn.html('<i class="fas fa-spinner fa-spin me-2"></i>Menyimpan...').prop('disabled', true);

        var formData = new FormData(this);

        $.ajax({
            url: baseUrl + 'admin/update_profile',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(res) {
                if (res.status === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: res.message,
                        confirmButtonColor: '#2563EB',
                        timer: 2000
                    }).then(() => {
                        // Reload the page to reflect all header/sidebar avatar/name changes
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: res.message,
                        confirmButtonColor: '#2563EB'
                    });
                    btn.html(originalText).prop('disabled', false);
                }
            },
            error: function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Terjadi kesalahan sistem saat memperbarui profil.',
                    confirmButtonColor: '#2563EB'
                });
                btn.html(originalText).prop('disabled', false);
            }
        });
    });

    // Submit Change Password Form
    $('#formChangePassword').on('submit', function(e) {
        e.preventDefault();

        var passwordLama = $('#inputPasswordLama').val();
        var passwordBaru = $('#inputPasswordBaru').val();
        var konfirmasiPassword = $('#inputKonfirmasiPassword').val();

        // Client-side validations
        if (passwordBaru.length < 8) {
            Swal.fire({
                icon: 'warning',
                title: 'Validasi Gagal',
                text: 'Password baru minimal harus 8 karakter!',
                confirmButtonColor: '#2563EB'
            });
            return;
        }

        if (passwordBaru !== konfirmasiPassword) {
            Swal.fire({
                icon: 'warning',
                title: 'Konfirmasi password tidak cocok.',
                text: 'Pastikan konfirmasi password baru sama dengan password baru Anda.',
                confirmButtonColor: '#2563EB'
            });
            return;
        }

        var btn = $('#btnSavePassword');
        var originalText = btn.html();
        btn.html('<i class="fas fa-spinner fa-spin me-2"></i>Memproses...').prop('disabled', true);

        $.ajax({
            url: baseUrl + 'admin/change_password',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(res) {
                if (res.status === 'success') {
                    $('#modalChangePassword').modal('hide');
                    Swal.fire({
                        icon: 'success',
                        title: 'Password berhasil diubah.',
                        text: res.message,
                        confirmButtonColor: '#2563EB',
                        timer: 2000
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Password lama tidak sesuai.',
                        text: res.message,
                        confirmButtonColor: '#2563EB'
                    });
                }
                btn.html(originalText).prop('disabled', false);
            },
            error: function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Terjadi kesalahan sistem saat memperbarui password.',
                    confirmButtonColor: '#2563EB'
                });
                btn.html(originalText).prop('disabled', false);
            }
        });
    });
});

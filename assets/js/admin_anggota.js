function tambahAnggota() {
    $('#formAnggota')[0].reset();
    $('#id_user').val('');
    $('#modalTitle').text('Tambah Anggota');
    $('#password').prop('required', true);
    $('#passHelp').hide();
    $('#modalAnggota').modal('show');
}

function editAnggota(id) {
    const baseUrl = window.location.origin + '/' + window.location.pathname.split('/')[1] + '/';
    const apiBase = window.AppConfig ? window.AppConfig.baseUrl : baseUrl;

    $.ajax({
        url: apiBase + 'admin/get_anggota/' + id,
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            $('#id_user').val(data.id_user);
            $('#nama').val(data.nama);
            $('#username').val(data.username);
            $('#email').val(data.email);
            $('#telepon').val(data.telepon);
            $('#alamat').val(data.alamat);
            $('#password').prop('required', false).val('');
            $('#modalTitle').text('Edit Anggota');
            $('#passHelp').show();
            $('#modalAnggota').modal('show');
        }
    });
}

function detailAnggota(id) {
    const baseUrl = window.location.origin + '/' + window.location.pathname.split('/')[1] + '/';
    const apiBase = window.AppConfig ? window.AppConfig.baseUrl : baseUrl;

    $.ajax({
        url: apiBase + 'admin/get_anggota/' + id,
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            let imgUrl = apiBase + 'assets/img/users/' + data.foto;
            let html = `
                <img src="${imgUrl}" class="rounded-circle shadow-sm mb-3" width="100" height="100" style="object-fit:cover;">
                <h4 class="fw-bold">${data.nama}</h4>
                <p class="text-muted mb-3">@${data.username}</p>
                <ul class="list-group list-group-flush text-start mt-3">
                    <li class="list-group-item"><i class="fas fa-envelope text-primary me-2"></i> ${data.email}</li>
                    <li class="list-group-item"><i class="fas fa-phone text-primary me-2"></i> ${data.telepon}</li>
                    <li class="list-group-item"><i class="fas fa-map-marker-alt text-primary me-2"></i> ${data.alamat}</li>
                </ul>
            `;
            $('#detailContent').html(html);
            $('#modalDetail').modal('show');
        }
    });
}

document.addEventListener("DOMContentLoaded", function() {
    $('#formAnggota').submit(function(e) {
        e.preventDefault();
        let btn = $('#btnSave');
        btn.html('<i class="fas fa-spinner fa-spin"></i> Menyimpan...').prop('disabled', true);

        const baseUrl = window.location.origin + '/' + window.location.pathname.split('/')[1] + '/';
        const apiBase = window.AppConfig ? window.AppConfig.baseUrl : baseUrl;

        $.ajax({
            url: apiBase + 'admin/save_anggota',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response) {
                $('#modalAnggota').modal('hide');
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: response.message,
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => location.reload());
            },
            error: function() {
                Swal.fire('Error', 'Terjadi kesalahan.', 'error');
                btn.html('Simpan').prop('disabled', false);
            }
        });
    });
});

function hapusAnggota(id) {
    const baseUrl = window.location.origin + '/' + window.location.pathname.split('/')[1] + '/';
    const apiBase = window.AppConfig ? window.AppConfig.baseUrl : baseUrl;

    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Data anggota akan dihapus permanen beserta seluruh riwayat peminjamannya!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: apiBase + 'admin/delete_anggota/' + id,
                type: 'POST',
                dataType: 'json',
                success: function(res) {
                    if (res.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Terhapus!',
                            text: 'Data anggota berhasil dihapus.',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => location.reload());
                    } else {
                        Swal.fire('Gagal', res.message || 'Gagal menghapus anggota.', 'error');
                    }
                },
                error: function() {
                    Swal.fire('Error', 'Terjadi kesalahan sistem saat menghapus data.', 'error');
                }
            });
        }
    })
}

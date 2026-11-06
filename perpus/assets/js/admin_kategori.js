function tambahKategori() {
    $('#formKategori')[0].reset();
    $('#id_kategori').val('');
    $('#modalTitle').text('Tambah Kategori');
    $('#modalKategori').modal('show');
}

function editKategori(id) {
    const baseUrl = window.location.origin + '/' + window.location.pathname.split('/')[1] + '/';
    const apiBase = window.AppConfig ? window.AppConfig.baseUrl : baseUrl;

    $.ajax({
        url: apiBase + 'admin/get_kategori/' + id,
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            $('#id_kategori').val(data.id_kategori);
            $('#nama_kategori').val(data.nama_kategori);
            $('#modalTitle').text('Edit Kategori');
            $('#modalKategori').modal('show');
        }
    });
}

document.addEventListener("DOMContentLoaded", function() {
    $('#formKategori').submit(function(e) {
        e.preventDefault();
        let btn = $('#btnSave');
        btn.html('<i class="fas fa-spinner fa-spin"></i> Menyimpan...').prop('disabled', true);

        const baseUrl = window.location.origin + '/' + window.location.pathname.split('/')[1] + '/';
        const apiBase = window.AppConfig ? window.AppConfig.baseUrl : baseUrl;

        $.ajax({
            url: apiBase + 'admin/save_kategori',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response) {
                $('#modalKategori').modal('hide');
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

function hapusKategori(id) {
    const baseUrl = window.location.origin + '/' + window.location.pathname.split('/')[1] + '/';
    const apiBase = window.AppConfig ? window.AppConfig.baseUrl : baseUrl;

    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Data kategori akan dihapus permanen!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: apiBase + 'admin/delete_kategori/' + id,
                type: 'POST',
                dataType: 'json',
                success: function(res) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Terhapus!',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => location.reload());
                }
            });
        }
    })
}

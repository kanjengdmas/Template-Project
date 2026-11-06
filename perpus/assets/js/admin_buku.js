function tambahBuku() {
    $('#formBuku')[0].reset();
    $('#id_buku').val('');
    $('#previewContainer').hide();
    $('#coverPreview').attr('src', '');
    $('#modalTitle').text('Tambah Buku');
    $('#modalBuku').modal('show');
}

function editBuku(id) {
    const baseUrl = window.location.origin + '/' + window.location.pathname.split('/')[1] + '/';
    const apiBase = window.AppConfig ? window.AppConfig.baseUrl : baseUrl;

    $.ajax({
        url: apiBase + 'admin/get_buku/' + id,
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            $('#id_buku').val(data.id_buku);
            $('#judul').val(data.judul);
            $('#id_kategori').val(data.id_kategori);
            $('#penulis').val(data.penulis);
            $('#penerbit').val(data.penerbit);
            $('#tahun_terbit').val(data.tahun_terbit);
            $('#stok').val(data.stok);
            $('#deskripsi').val(data.deskripsi);
            
            let imgUrl = apiBase + 'assets/img/buku/' + (data.cover ? data.cover : 'default_book.jpg');
            $('#coverPreview').attr('src', imgUrl);
            $('#previewContainer').show();
            
            $('#modalTitle').text('Edit Buku');
            $('#modalBuku').modal('show');
        }
    });
}

// Instant cover preview on input change
document.addEventListener("DOMContentLoaded", function() {
    $('#cover').change(function() {
        const file = this.files[0];
        if (file) {
            let reader = new FileReader();
            reader.onload = function(event) {
                $('#coverPreview').attr('src', event.target.result);
                $('#previewContainer').show();
            }
            reader.readAsDataURL(file);
        }
    });
});

function detailBuku(id) {
    const baseUrl = window.location.origin + '/' + window.location.pathname.split('/')[1] + '/';
    const apiBase = window.AppConfig ? window.AppConfig.baseUrl : baseUrl;

    $.ajax({
        url: apiBase + 'admin/get_buku/' + id,
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            let imgUrl = apiBase + 'assets/img/buku/' + (data.cover ? data.cover : 'default_book.jpg');
            let html = `
                <img src="${imgUrl}" class="img-fluid rounded shadow-sm mb-3" style="max-height:250px;">
                <h4 class="fw-bold">${data.judul}</h4>
                <p class="text-muted mb-2">${data.penulis}</p>
                <span class="badge bg-primary mb-3">${data.nama_kategori}</span>
                <div class="text-start mt-3">
                    <p><strong>Penerbit:</strong> ${data.penerbit}</p>
                    <p><strong>Tahun Terbit:</strong> ${data.tahun_terbit}</p>
                    <p><strong>Stok:</strong> ${data.stok}</p>
                    <p><strong>Deskripsi:</strong><br>${data.deskripsi ? data.deskripsi : '-'}</p>
                </div>
            `;
            $('#detailContent').html(html);
            $('#modalDetail').modal('show');
        }
    });
}

document.addEventListener("DOMContentLoaded", function() {
    $('#formBuku').submit(function(e) {
        e.preventDefault();
        let formData = new FormData(this);
        let btn = $('#btnSave');
        btn.html('<i class="fas fa-spinner fa-spin"></i> Menyimpan...').prop('disabled', true);

        const baseUrl = window.location.origin + '/' + window.location.pathname.split('/')[1] + '/';
        const apiBase = window.AppConfig ? window.AppConfig.baseUrl : baseUrl;

        $.ajax({
            url: apiBase + 'admin/save_buku',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(response) {
                $('#modalBuku').modal('hide');
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

function hapusBuku(id) {
    const baseUrl = window.location.origin + '/' + window.location.pathname.split('/')[1] + '/';
    const apiBase = window.AppConfig ? window.AppConfig.baseUrl : baseUrl;

    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Data buku akan dihapus permanen!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: apiBase + 'admin/delete_buku/' + id,
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

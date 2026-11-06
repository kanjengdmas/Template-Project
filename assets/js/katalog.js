document.addEventListener("DOMContentLoaded", function() {
    // Prevent form submit on Enter
    $('#filterForm').submit(function(e) {
        e.preventDefault();
    });

    // Filter Script
    $('#btnFilter').click(function() {
        let search = $('#searchInput').val().toLowerCase().trim();
        let kategori = $('#kategoriSelect').val();
        let count = 0;

        $('.buku-item').each(function() {
            let title = $(this).find('.card-title').text().toLowerCase();
            let kat = $(this).data('kategori');
            let show = true;

            if (search !== '' && title.indexOf(search) === -1) show = false;
            if (kategori !== 'all' && kat != kategori) show = false;

            if (show) {
                $(this).removeClass('d-none');
                count++;
            } else {
                $(this).addClass('d-none');
            }
        });

        if(count === 0) {
            $('#noData').removeClass('d-none');
        } else {
            $('#noData').addClass('d-none');
        }
    });

    $('#searchInput').on('keyup', function() {
        $('#btnFilter').click();
    });
    $('#kategoriSelect').on('change', function() {
        $('#btnFilter').click();
    });
});

function detailBuku(id) {
    const baseUrl = window.location.origin + '/' + window.location.pathname.split('/')[1] + '/';
    const apiBase = window.AppConfig ? window.AppConfig.baseUrl : baseUrl;
    
    $.ajax({
        url: apiBase + 'admin/get_buku/' + id, // re-using admin endpoint for detail read
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
                    <p><strong>Stok:</strong> <span class="badge ${data.stok > 0 ? 'bg-success' : 'bg-danger'}">${data.stok}</span></p>
                    <p><strong>Deskripsi:</strong><br>${data.deskripsi ? data.deskripsi : '-'}</p>
                </div>
            `;
            $('#detailContent').html(html);
            $('#modalDetail').modal('show');
        }
    });
}

function pinjamBuku(id, judul) {
    const baseUrl = window.location.origin + '/' + window.location.pathname.split('/')[1] + '/';
    const apiBase = window.AppConfig ? window.AppConfig.baseUrl : baseUrl;

    Swal.fire({
        title: 'Pinjam Buku?',
        html: `Anda akan meminjam buku <b>${judul}</b>.<br>Batas peminjaman adalah 7 hari.`,
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#2563EB',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Pinjam!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: apiBase + 'anggota/pinjam',
                type: 'POST',
                data: { id_buku: id },
                dataType: 'json',
                success: function(res) {
                    if(res.status == 'success'){
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: res.message,
                        }).then(() => window.location.href = apiBase + 'anggota/dipinjam');
                    }else{
                        Swal.fire('Gagal', res.message, 'error');
                    }
                }
            });
        }
    });
}

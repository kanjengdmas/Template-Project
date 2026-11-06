function kembalikanBuku(id) {
    const baseUrl = window.location.origin + '/' + window.location.pathname.split('/')[1] + '/';
    const apiBase = window.AppConfig ? window.AppConfig.baseUrl : baseUrl;

    Swal.fire({
        title: 'Ajukan Pengembalian?',
        text: "Status akan berubah menjadi Menunggu Verifikasi. Silakan bawa buku fisik ke perpustakaan untuk diverifikasi admin.",
        icon: 'info',
        showCancelButton: true,
        confirmButtonColor: '#2563EB',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Ajukan!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: apiBase + 'anggota/kembalikan',
                type: 'POST',
                data: { id_pinjam: id },
                dataType: 'json',
                success: function(res) {
                    if(res.status == 'success'){
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: res.message,
                        }).then(() => location.reload());
                    }else{
                        Swal.fire('Gagal', res.message, 'error');
                    }
                }
            });
        }
    });
}

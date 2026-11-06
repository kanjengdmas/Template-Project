function verifikasiPengembalian(id) {
    const baseUrl = window.location.origin + '/' + window.location.pathname.split('/')[1] + '/';
    const apiBase = window.AppConfig ? window.AppConfig.baseUrl : baseUrl;

    Swal.fire({
        title: 'Verifikasi Pengembalian?',
        text: "Pastikan buku fisik telah diterima dalam kondisi baik.",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#28a745',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Verifikasi!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: apiBase + 'admin/verifikasi_pengembalian/' + id,
                type: 'POST',
                dataType: 'json',
                success: function(res) {
                    if(res.status == 'success'){
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: res.message,
                            showConfirmButton: false,
                            timer: 2000
                        }).then(() => location.reload());
                    }else{
                        Swal.fire('Error', res.message, 'error');
                    }
                }
            });
        }
    })
}

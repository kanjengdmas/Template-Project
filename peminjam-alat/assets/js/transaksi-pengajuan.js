document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.btn-action').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const url = this.getAttribute('href');
            Swal.fire({
                title: 'Proses Pengajuan?',
                text: "Status pengajuan peminjaman akan diubah.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Lanjutkan!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url;
                }
            });
        });
    });

    // Detail button modal handler
    document.querySelectorAll('.detail-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            document.getElementById('detail-kode').innerText = this.getAttribute('data-kode');
            document.getElementById('detail-nama').innerText = this.getAttribute('data-nama');
            document.getElementById('detail-alat').innerText = this.getAttribute('data-alat');
            document.getElementById('detail-jumlah').innerText = this.getAttribute('data-jumlah');
            document.getElementById('detail-tgl').innerText = this.getAttribute('data-tgl');
            document.getElementById('detail-status').innerText = this.getAttribute('data-status');
            document.getElementById('detail-keterangan').innerText = this.getAttribute('data-keterangan') || '-';
        });
    });
});

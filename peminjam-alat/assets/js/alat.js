document.addEventListener('DOMContentLoaded', function() {
    // Edit button
    document.querySelectorAll('.edit-btn').forEach(button => {
        button.addEventListener('click', function() {
            document.getElementById('edit-id').value = this.getAttribute('data-id');
            document.getElementById('edit-nama').value = this.getAttribute('data-nama');
            document.getElementById('edit-kategori').value = this.getAttribute('data-kategori');
            document.getElementById('edit-stok').value = this.getAttribute('data-stok');
            document.getElementById('edit-kondisi').value = this.getAttribute('data-kondisi');
            document.getElementById('edit-lokasi').value = this.getAttribute('data-lokasi');
            document.getElementById('edit-status').value = this.getAttribute('data-status');
        });
    });

    // Detail button
    document.querySelectorAll('.detail-btn').forEach(button => {
        button.addEventListener('click', function() {
            document.getElementById('detail-foto').src = this.getAttribute('data-foto');
            document.getElementById('detail-nama').innerText = this.getAttribute('data-nama');
            document.getElementById('detail-kode').innerText = this.getAttribute('data-kode');
            document.getElementById('detail-kategori').innerText = this.getAttribute('data-kategori');
            document.getElementById('detail-stok').innerText = this.getAttribute('data-stok');
            document.getElementById('detail-kondisi').innerText = this.getAttribute('data-kondisi');
            document.getElementById('detail-lokasi').innerText = this.getAttribute('data-lokasi');
            document.getElementById('detail-status').innerText = this.getAttribute('data-status');
        });
    });

    // Delete SweetAlert
    document.querySelectorAll('.btn-hapus').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const url = this.getAttribute('href');
            Swal.fire({
                title: 'Apakah Anda Yakin?',
                text: "Data alat akan dihapus permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url;
                }
            });
        });
    });
});

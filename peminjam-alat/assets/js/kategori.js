document.addEventListener('DOMContentLoaded', function() {
    // Edit button click
    document.querySelectorAll('.edit-btn').forEach(button => {
        button.addEventListener('click', function() {
            document.getElementById('edit-id').value = this.getAttribute('data-id');
            document.getElementById('edit-nama').value = this.getAttribute('data-nama');
        });
    });

    // SweetAlert for Delete
    document.querySelectorAll('.btn-hapus').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const url = this.getAttribute('href');
            Swal.fire({
                title: 'Apakah Anda Yakin?',
                text: "Data kategori akan dihapus permanen!",
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

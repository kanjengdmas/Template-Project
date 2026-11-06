document.addEventListener('DOMContentLoaded', function() {
    // Edit button
    document.querySelectorAll('.edit-btn').forEach(button => {
        button.addEventListener('click', function() {
            document.getElementById('edit-id').value = this.getAttribute('data-id');
            document.getElementById('edit-nama').value = this.getAttribute('data-nama');
            document.getElementById('edit-role').value = this.getAttribute('data-role');
            document.getElementById('edit-nim').value = this.getAttribute('data-nim');
            document.getElementById('edit-telp').value = this.getAttribute('data-telp');
            document.getElementById('edit-alamat').value = this.getAttribute('data-alamat');
        });
    });

    // Detail button
    document.querySelectorAll('.detail-btn').forEach(button => {
        button.addEventListener('click', function() {
            const name = this.getAttribute('data-nama');
            const username = this.getAttribute('data-username');
            const role = this.getAttribute('data-role');
            const nim = this.getAttribute('data-nim') || '-';
            const telp = this.getAttribute('data-telp') || '-';
            const alamat = this.getAttribute('data-alamat') || '-';

            document.getElementById('detail-nama').innerText = name;
            document.getElementById('detail-username').innerText = username;
            document.getElementById('detail-nim').innerText = nim;
            document.getElementById('detail-telp').innerText = telp;
            document.getElementById('detail-alamat').innerText = alamat;

            // Adjust role badge in modal
            const badge = document.getElementById('detail-role-badge');
            badge.className = 'badge badge-soft';
            if (role === 'Admin') {
                badge.classList.add('badge-soft-danger');
                badge.innerHTML = '<i class="fas fa-user-shield"></i> Admin';
            } else if (role === 'Petugas') {
                badge.classList.add('badge-soft-warning');
                badge.innerHTML = '<i class="fas fa-user-cog"></i> Petugas';
            } else {
                badge.classList.add('badge-soft-info');
                badge.innerHTML = '<i class="fas fa-user"></i> Peminjam';
            }
        });
    });

    // Delete SweetAlert
    document.querySelectorAll('.btn-hapus').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const url = this.getAttribute('href');
            Swal.fire({
                title: 'Apakah Anda Yakin?',
                text: "Data akun ini akan dihapus permanen!",
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

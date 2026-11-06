document.addEventListener('DOMContentLoaded', function() {
    // Modal data setup
    document.querySelectorAll('.kembali-btn').forEach(button => {
        button.addEventListener('click', function() {
            document.getElementById('kembali-id').value = this.getAttribute('data-id');
            document.getElementById('kembali-alat-id').value = this.getAttribute('data-alat-id');
            document.getElementById('kembali-jumlah').value = this.getAttribute('data-jumlah');
            document.getElementById('kembali-nama').value = this.getAttribute('data-kode') + ' - ' + this.getAttribute('data-nama');
            document.getElementById('kembali-alat').value = this.getAttribute('data-alat') + ' (' + this.getAttribute('data-jumlah') + ' unit)';
            
            // Reset form state
            document.getElementById('kondisi-select').value = 'Baik';
            document.getElementById('denda-div').classList.add('d-none');
            document.getElementById('nominal-denda').value = '0';
        });
    });

    // Toggle denda input
    document.getElementById('kondisi-select').addEventListener('change', function() {
        if (this.value === 'Baik') {
            document.getElementById('denda-div').classList.add('d-none');
            document.getElementById('nominal-denda').value = '0';
        } else {
            document.getElementById('denda-div').classList.remove('d-none');
            document.getElementById('nominal-denda').value = '';
        }
    });

    // Detail button modal handler
    document.querySelectorAll('.detail-kembali-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            document.getElementById('detail-kembali-kode').innerText = this.getAttribute('data-kode');
            document.getElementById('detail-kembali-nama').innerText = this.getAttribute('data-nama');
            document.getElementById('detail-kembali-alat').innerText = this.getAttribute('data-alat');
            document.getElementById('detail-kembali-jumlah').innerText = this.getAttribute('data-jumlah');
            document.getElementById('detail-kembali-tgl-pinjam').innerText = this.getAttribute('data-tgl-pinjam');
            document.getElementById('detail-kembali-tgl-rencana').innerText = this.getAttribute('data-tgl-kembali-rencana');
            document.getElementById('detail-kembali-keterangan').innerText = this.getAttribute('data-keterangan') || '-';
            
            const status = this.getAttribute('data-status');
            document.getElementById('detail-kembali-status').innerText = status;
            
            const selesaiInfo = document.getElementById('detail-kembali-selesai-info');
            if (status === 'Selesai') {
                selesaiInfo.classList.remove('d-none');
                document.getElementById('detail-kembali-tgl-dikembalikan').innerText = this.getAttribute('data-tgl-dikembalikan');
                document.getElementById('detail-kembali-kondisi').innerText = this.getAttribute('data-kondisi-kembali');
                document.getElementById('detail-kembali-catatan').innerText = this.getAttribute('data-catatan-kembali') || '-';
                document.getElementById('detail-kembali-denda').innerText = this.getAttribute('data-denda');
            } else {
                selesaiInfo.classList.add('d-none');
            }
        });
    });
});

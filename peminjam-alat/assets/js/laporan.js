document.addEventListener('DOMContentLoaded', function() {
    const jenisLaporan = document.getElementById('jenis_laporan');
    if (jenisLaporan) {
        jenisLaporan.addEventListener('change', function() {
            if (this.value === 'alat') {
                document.getElementById('filter-tanggal').classList.add('d-none');
            } else {
                document.getElementById('filter-tanggal').classList.remove('d-none');
            }
        });
    }
});

document.addEventListener("DOMContentLoaded", function() {
    var ctx = document.getElementById('borrowChart');
    if (ctx) {
        var dipinjam = window.AppConfig ? window.AppConfig.bukuDipinjam : 0;
        var verifikasi = window.AppConfig ? window.AppConfig.menungguVerifikasi : 0;
        var dikembalikan = window.AppConfig ? window.AppConfig.bukuDikembalikan : 0;

        var borrowChart = new Chart(ctx.getContext('2d'), {
            type: 'bar',
            data: {
                labels: ['Buku Dipinjam', 'Menunggu Verifikasi', 'Dikembalikan'],
                datasets: [{
                    label: 'Status Peminjaman',
                    data: [dipinjam, verifikasi, dikembalikan],
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.7)',
                        'rgba(255, 206, 86, 0.7)',
                        'rgba(75, 192, 192, 0.7)'
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)'
                    ],
                    borderWidth: 1,
                    borderRadius: 5
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    }
});

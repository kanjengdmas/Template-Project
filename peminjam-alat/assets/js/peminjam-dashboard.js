document.addEventListener('DOMContentLoaded', function() {
    // Sparkline Config helper
    const createSparkline = (id, color, data) => {
        const ctx = document.getElementById(id);
        if (!ctx) return;
        new Chart(ctx, {
            type: 'line',
            data: { labels: ['1', '2', '3', '4', '5', '6', '7'], datasets: [{ data: data, borderColor: color, borderWidth: 2, fill: false, tension: 0.4, pointRadius: 0 }] },
            options: { 
                responsive: true, 
                maintainAspectRatio: false, 
                plugins: { legend: { display: false }, tooltip: { enabled: false } }, 
                scales: { x: { display: false }, y: { display: false } }, 
                layout: { padding: 0 },
                animation: { duration: 1000 }
            }
        });
    };
    
    if (typeof peminjamDashboardData !== 'undefined') {
        // Mock sparkline data
        createSparkline('sparkPengajuan', '#2563EB', [0, 2, 1, 3, 2, 4, peminjamDashboardData.totalPengajuan]);
        createSparkline('sparkMenunggu', '#F59E0B', [1, 0, 1, 0, 0, 0, peminjamDashboardData.menunggu]);
        createSparkline('sparkDipinjam', '#22C55E', [1, 2, 1, 0, 2, 1, peminjamDashboardData.dipinjam]);

        // Doughnut Chart
        const doughnutCtx = document.getElementById('doughnutChart');
        if (doughnutCtx) {
            const statusData = peminjamDashboardData.statusDist;
            new Chart(doughnutCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Selesai', 'Sedang Dipinjam', 'Menunggu Persetujuan', 'Ditolak'],
                    datasets: [{
                        data: statusData,
                        backgroundColor: ['#2563EB', '#22C55E', '#F59E0B', '#EF4444'],
                        borderWidth: 0,
                        cutout: '75%'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false }
                    },
                    animation: {
                        animateRotate: true,
                        animateScale: true,
                        duration: 1800,
                        easing: 'easeOutBack'
                    }
                }
            });
        }
    }
});

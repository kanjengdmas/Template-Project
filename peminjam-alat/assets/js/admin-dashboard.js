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
    
    // Count Up Animation
    const countUp = (el) => {
        const target = parseFloat(el.getAttribute('data-target'));
        const prefix = el.getAttribute('data-prefix') || '';
        const isRupiah = el.getAttribute('data-format') === 'rupiah';
        const duration = 1200; // 1.2 seconds
        const startTime = performance.now();
        
        const updateCount = (currentTime) => {
            const elapsedTime = currentTime - startTime;
            const progress = Math.min(elapsedTime / duration, 1);
            
            // Ease out quad
            const easeProgress = progress * (2 - progress);
            const currentVal = Math.floor(easeProgress * target);
            
            if (isRupiah) {
                el.innerText = prefix + new Intl.NumberFormat('id-ID').format(currentVal);
            } else {
                el.innerText = prefix + currentVal;
            }
            
            if (progress < 1) {
                requestAnimationFrame(updateCount);
            } else {
                if (isRupiah) {
                    el.innerText = prefix + new Intl.NumberFormat('id-ID').format(target);
                } else {
                    el.innerText = prefix + target;
                }
            }
        };
        
        requestAnimationFrame(updateCount);
    };
    
    document.querySelectorAll('.count-up').forEach(el => countUp(el));

    if (typeof dashboardData !== 'undefined') {
        createSparkline('sparkAlat', '#2563EB', [10, 20, 15, 25, 22, 30, dashboardData.totalAlat]);
        createSparkline('sparkTransaksi', '#22C55E', [5, 12, 8, 15, 20, 25, dashboardData.totalTransaksi]);
        createSparkline('sparkPeminjam', '#8B5CF6', [40, 50, 45, 60, 75, 80, dashboardData.totalPeminjam]);
        createSparkline('sparkDenda', '#F59E0B', [0, 5000, 0, 15000, 5000, 25000, dashboardData.totalDenda]);

        // Main Chart
        const mainChartCtx = document.getElementById('mainChart');
        if (mainChartCtx) {
            new Chart(mainChartCtx, {
                type: 'line',
                data: {
                    labels: dashboardData.chartLabels,
                    datasets: [
                        {
                            label: 'Peminjaman',
                            data: dashboardData.chartPeminjaman,
                            borderColor: '#2563EB',
                            backgroundColor: 'transparent',
                            borderWidth: 2,
                            tension: 0.4,
                            pointBackgroundColor: '#2563EB'
                        },
                        {
                            label: 'Pengembalian',
                            data: dashboardData.chartPengembalian,
                            borderColor: '#22C55E',
                            backgroundColor: 'transparent',
                            borderWidth: 2,
                            tension: 0.4,
                            pointBackgroundColor: '#22C55E'
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    animation: {
                        duration: 1800,
                        easing: 'easeOutQuart'
                    },
                    plugins: {
                        legend: { position: 'top', labels: { usePointStyle: true, boxWidth: 8 } }
                    },
                    scales: {
                        y: { beginAtZero: true, grid: { borderDash: [5, 5] } },
                        x: { grid: { display: false } }
                    }
                }
            });
        }

        // Doughnut Chart
        const doughnutChartCtx = document.getElementById('doughnutChart');
        if (doughnutChartCtx) {
            new Chart(doughnutChartCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Menunggu', 'Dipinjam', 'Ditolak', 'Selesai'],
                    datasets: [{
                        data: dashboardData.statusDist,
                        backgroundColor: ['#F59E0B', '#2563EB', '#EF4444', '#22C55E'],
                        borderWidth: 0,
                        cutout: '75%'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    animation: {
                        animateRotate: true,
                        animateScale: true,
                        duration: 1800,
                        easing: 'easeOutBack'
                    },
                    plugins: {
                        legend: { display: false }
                    }
                }
            });
        }
    }
});

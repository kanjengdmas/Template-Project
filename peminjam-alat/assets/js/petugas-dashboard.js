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
        createSparkline('sparkMenunggu', '#F59E0B', [2, 5, 3, 7, 4, 6, dashboardData.menunggu]);
        createSparkline('sparkDipinjam', '#2563EB', [10, 8, 12, 15, 10, 14, dashboardData.dipinjam]);
        createSparkline('sparkKembali', '#22C55E', [5, 2, 8, 4, 6, 3, dashboardData.kembaliHariIni]);
        createSparkline('sparkSelesai', '#8B5CF6', [20, 25, 22, 30, 28, 24, dashboardData.selesai]);

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
    }
});

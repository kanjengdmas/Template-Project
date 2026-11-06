document.addEventListener("DOMContentLoaded", function() {
    var chartCanvas = document.getElementById('salesChart');
    if (chartCanvas && typeof Chart !== 'undefined') {
        var ctx = chartCanvas.getContext('2d');
        var chartData = typeof CHART_DATA !== 'undefined' ? CHART_DATA : [];
        
        var gradient = ctx.createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, 'rgba(16, 185, 129, 0.2)');
        gradient.addColorStop(1, 'rgba(16, 185, 129, 0)');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: chartData.map(d => d.label),
                datasets: [{
                    label: 'Penjualan',
                    data: chartData.map(d => d.total),
                    borderColor: '#10B981',
                    backgroundColor: gradient,
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: '#10B981',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 5,
                    pointHoverRadius: 7,
                    borderWidth: 3
                }]
            },
            options: {
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { 
                            color: 'rgba(255, 255, 255, 0.05)',
                            borderDash: [5, 5],
                            drawBorder: false
                        },
                        ticks: { 
                            color: '#A7B7B3',
                            font: { size: 11 },
                            callback: function(value) {
                                if (value >= 1000000) {
                                    return 'Rp ' + (value / 1000000) + 'M';
                                }
                                return 'Rp ' + (value / 1000).toLocaleString() + 'k';
                            },
                            stepSize: 20000000
                        }
                    },
                    x: {
                        grid: { display: false },
                        ticks: { 
                            color: '#A7B7B3',
                            font: { size: 11 }
                        }
                    }
                },
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#12352F',
                        titleColor: '#10B981',
                        bodyColor: '#fff',
                        borderColor: '#10B981',
                        borderWidth: 1,
                        displayColors: false,
                        callbacks: {
                            label: function(context) {
                                return 'Total: Rp ' + context.parsed.y.toLocaleString();
                            }
                        }
                    }
                }
            }
        });
    }
});

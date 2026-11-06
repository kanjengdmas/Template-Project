// Custom Chart Initialization for Dark Theme
document.addEventListener("DOMContentLoaded", function() {
    if (typeof Chart !== 'undefined') {
        // Global defaults
        Chart.defaults.global.defaultFontFamily = "'Inter', 'Nunito', sans-serif";
        Chart.defaults.global.defaultFontColor = '#a0aec0';
        
        // Area Chart
        var ctx = document.getElementById("dashboardAreaChart");
        if(ctx) {
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des"],
                    datasets: [{
                        label: "Earnings",
                        lineTension: 0.3,
                        backgroundColor: "rgba(74, 222, 128, 0.05)",
                        borderColor: "#4ade80",
                        pointRadius: 3,
                        pointBackgroundColor: "#4ade80",
                        pointBorderColor: "#4ade80",
                        pointHoverRadius: 3,
                        pointHoverBackgroundColor: "#4ade80",
                        pointHoverBorderColor: "#4ade80",
                        pointHitRadius: 10,
                        pointBorderWidth: 2,
                        data: typeof MONTHLY_SALES !== 'undefined' ? MONTHLY_SALES : [],
                    }],
                },
                options: {
                    maintainAspectRatio: false,
                    layout: { padding: { left: 10, right: 25, top: 25, bottom: 0 } },
                    scales: {
                        xAxes: [{
                            time: { unit: 'date' },
                            gridLines: { display: false, drawBorder: false },
                            ticks: { maxTicksLimit: 12 }
                        }],
                        yAxes: [{
                            ticks: {
                                maxTicksLimit: 5, padding: 10,
                                callback: function(value, index, values) { return 'Rp ' + (value/1000000) + 'M'; }
                            },
                            gridLines: { color: "rgba(255, 255, 255, 0.05)", zeroLineColor: "rgba(255, 255, 255, 0.05)", drawBorder: false, borderDash: [2], zeroLineBorderDash: [2] }
                        }],
                    },
                    legend: { display: false },
                    tooltips: {
                        backgroundColor: "#141a18",
                        bodyFontColor: "#e2e8f0",
                        titleFontColor: "#4ade80",
                        borderColor: '#1f2924',
                        borderWidth: 1,
                        xPadding: 15,
                        yPadding: 15,
                        displayColors: false,
                        intersect: false,
                        mode: 'index',
                        caretPadding: 10,
                    }
                }
            });
        }

        // Pie Chart
        var ctxPie = document.getElementById("dashboardPieChart");
        if(ctxPie) {
            new Chart(ctxPie, {
                type: 'doughnut',
                data: {
                    labels: typeof POPULAR_CATEGORY_NAMES !== 'undefined' ? POPULAR_CATEGORY_NAMES : [],
                    datasets: [{
                        data: typeof POPULAR_CATEGORY_TOTALS !== 'undefined' ? POPULAR_CATEGORY_TOTALS : [],
                        backgroundColor: ['#4ade80', '#2f855a', '#9ae6b4'],
                        hoverBackgroundColor: ['#22c55e', '#276749', '#68d391'],
                        hoverBorderColor: "#141a18",
                        borderColor: "#141a18",
                        borderWidth: 4
                    }],
                },
                options: {
                    maintainAspectRatio: false,
                    tooltips: {
                        backgroundColor: "#141a18",
                        bodyFontColor: "#e2e8f0",
                        borderColor: '#1f2924',
                        borderWidth: 1,
                        xPadding: 15,
                        yPadding: 15,
                        displayColors: false,
                        caretPadding: 10,
                    },
                    legend: { display: false },
                    cutoutPercentage: 75,
                },
            });
        }
    }
});

// Dashboard Statistics Counter Animation
function animateDashboardCounters() {
    const counters = document.querySelectorAll('.counter-number');
    counters.forEach(counter => {
        const target = parseInt(counter.getAttribute('data-target'), 10);
        if (isNaN(target)) return;
        
        const duration = 1500;
        const startTime = performance.now();
        
        const updateCounter = (currentTime) => {
            const elapsedTime = currentTime - startTime;
            const progress = Math.min(elapsedTime / duration, 1);
            const easeOutCubic = 1 - Math.pow(1 - progress, 3);
            const currentVal = Math.floor(easeOutCubic * target);
            
            counter.innerText = currentVal;
            
            if (progress < 1) {
                requestAnimationFrame(updateCounter);
            } else {
                counter.innerText = target;
            }
        };
        requestAnimationFrame(updateCounter);
    });
}

// Force trigger on load
window.addEventListener('load', function() {
    setTimeout(animateDashboardCounters, 500);
});

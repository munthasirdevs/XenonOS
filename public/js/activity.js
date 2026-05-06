/* Activity Page JS */
(function() {
    'use strict';
    
    // Initialize chart when DOM is ready
    document.addEventListener('DOMContentLoaded', function() {
        var chartCanvas = document.getElementById('activityTrendChart');
        if (chartCanvas && typeof Chart !== 'undefined') {
            initActivityChart();
        }
    });
    
    function initActivityChart() {
        var ctx = document.getElementById('activityTrendChart').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: [],
                datasets: [{
                    label: 'System Actions',
                    data: [],
                    borderColor: '#818cf8',
                    backgroundColor: 'rgba(129, 140, 248, 0.1)',
                    fill: true,
                    tension: 0.4,
                    borderWidth: 2
                }, {
                    label: 'Security Flags',
                    data: [],
                    borderColor: '#c084fc',
                    backgroundColor: 'rgba(192, 132, 252, 0.1)',
                    fill: true,
                    tension: 0.4,
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    x: { grid: { color: 'rgba(255,255,255,0.05)' }, ticks: { color: '#64748b' } },
                    y: { grid: { color: 'rgba(255,255,255,0.05)' }, ticks: { color: '#64748b' } }
                }
            }
        });
        
        // Fetch data
        var activityChartsUrl = document.querySelector('meta[name="activity-charts-url"]')?.content || '/activity/charts';
        fetch(activityChartsUrl)
            .then(function(res) { return res.json(); })
            .then(function(data) {
                chart.data.labels = data.labels;
                chart.data.datasets[0].data = data.activity;
                chart.data.datasets[1].data = data.security;
                chart.update();
            });
    }
    
})();
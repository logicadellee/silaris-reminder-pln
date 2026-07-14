
import 'bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

window.addEventListener('load', () => {
    const chartCanvas = document.getElementById('monthlyReminderChart');

    if (!chartCanvas || typeof window.Chart === 'undefined') {
        return;
    }

    new window.Chart(chartCanvas, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
            datasets: [
                {
                    label: 'Reminder',
                    data: [12, 18, 15, 22, 28, 19],
                    backgroundColor: ['#0d6efd', '#198754', '#0dcaf0', '#ffc107', '#6610f2', '#dc3545'],
                    borderRadius: 8,
                    maxBarThickness: 40,
                },
            ],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false,
                },
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0,
                    },
                },
            },
        },
    });
});

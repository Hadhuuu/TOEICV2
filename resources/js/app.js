import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import Chart from 'chart.js/auto'; // Import Chart.js
window.Chart = Chart; // Membuatnya global jika diperlukan di script inline Blade
import dayjs from "dayjs";
import "./bootstrap";
import Chart from "chart.js/auto";
import utc from "dayjs/plugin/utc";
// import Alpine from 'alpinejs'

window.Chart = Chart;
dayjs.extend(utc)
window.dayjs = dayjs
window.dayjs.extend(utc)

// window.Alpine = Alpine;
// Alpine.start();

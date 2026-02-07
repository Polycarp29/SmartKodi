<script setup>
import { ref } from 'vue'


const series = ref([
    {
        name: 'Total Rent Collected',
        data: [400000, 5349000, 6200000, 4700000, 5600000, 6100000, 6800000, 5900000, 7100000, 6950000, 7200000, 7500000],
    },
])

const chartOptions = ref({
    chart: {
        type: 'area',
        toolbar: { show: false },
        zoom: { enabled: false },
        fontFamily: 'Inter, sans-serif',
    },
    dataLabels: { enabled: false },
    stroke: {
        curve: 'smooth',
        width: 3,
        colors: ['#D97706'], // amber-600 line
    },
    fill: {
        type: 'gradient',
        gradient: {
            shadeIntensity: 1,
            opacityFrom: 0.4,
            opacityTo: 0.05,
            stops: [0, 90, 100]
        },
        colors: ['#D97706'],
    },
    grid: {
        borderColor: '#f1f5f9',
        strokeDashArray: 3,
        yaxis: { lines: { show: true } },
    },
    colors: ['#D97706'], // consistent amber-600 palette
    xaxis: {
        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        labels: {
            style: { colors: '#9CA3AF' },
        },
        axisTicks: { show: false },
        axisBorder: { show: false },
    },
    yaxis: {
        labels: {
            formatter: val => `Ksh ${(val / 1000000).toFixed(1)}M`,
            style: { colors: '#9CA3AF' },
        },
    },
    tooltip: {
        theme: 'light',
        y: {
            formatter: val => `Ksh ${val.toLocaleString()}`,
        },
    },
    legend: { show: false },
})

</script>
<template>
    <ApexChart type="area" height="350" :options="chartOptions" :series="series" />
    <!---AI Insights-->
    <div class="w-full bg-amber-50 rounded-xl border border-amber-100 p-4 mt-4 flex items-start gap-3">
         <i class="fa-solid fa-chart-line text-amber-600 mt-1"></i>
         <div>
            <h4 class="text-sm font-bold text-amber-800">Revenue Insight</h4>
            <p class="text-xs text-amber-700 mt-0.5">You are currently <span class="font-bold text-green-600">ahead of target</span> by 12%. Outstanding arrears have decreased by 5% this week.</p>
         </div>
    </div>
</template>
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
        type: 'solid',
        opacity: 0.1, // subtle transparency under the line (optional)
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
    <ApexChart type="area" height="500" :options="chartOptions" :series="series" />
    <!---AI Insights-->
    <div class="w-full bg-amber-100 rounded-xl border-l border-amber-600 p-4">
        <p class="font-light text-amber-600">Your are at a <span class="text-red-600 font-bold">Loss Ksh 35000</span>has not been paid</p>
    </div>
</template>
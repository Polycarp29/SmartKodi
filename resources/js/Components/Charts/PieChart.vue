<script setup>
import { ref } from 'vue'

const series = ref([40, 25, 20, 15]) //  Maintenance, Utilities, Staff, Misc

const chartOptions = ref({
  chart: {
    type: 'donut',
    toolbar: { show: false },
  },
  colors: ['#D97706', '#FBBF24', '#FDBA74', '#FEF3C7'], // amber palette shades
  labels: ['Maintenance', 'Utilities', 'Staff', 'Miscellaneous'],
  dataLabels: {
    enabled: true,
    style: {
      fontSize: '13px',
      colors: ['#374151'],
    },
    dropShadow: { enabled: false },
  },
  legend: { show: false },
  stroke: { show: false },
  tooltip: {
    y: {
      formatter: val => `Ksh ${val.toLocaleString()}`,
    },
  },
  plotOptions: {
    pie: {
      donut: {
        size: '60%',
        labels: {
          show: true,
          total: {
            show: true,
            label: 'Total',
            color: '#6B7280',
            formatter: () => 'Ksh 1.2M', // Example total, you can make this dynamic
          },
          value: {
            fontSize: '18px',
            color: '#111827',
            formatter: val => `${val}%`,
          },
        },
      },
    },
  },
})

</script>
<template>
    <ApexChart type="donut" height="280" :options="chartOptions" :series="series" />

    <div class="flex justify-center gap-6 mt-4">
        <div class="flex items-center space-x-2">
            <span class="w-3 h-3 rounded-full bg-amber-600"></span>
            <span class="text-sm text-gray-600">Collected</span>
        </div>
        <div class="flex items-center space-x-2">
            <span class="w-3 h-3 rounded-full bg-amber-400"></span>
            <span class="text-sm text-gray-600">Pending</span>
        </div>
        <div class="flex items-center space-x-2">
            <span class="w-3 h-3 rounded-full bg-amber-200"></span>
            <span class="text-sm text-gray-600">Overdue</span>
        </div>
    </div>
</template>
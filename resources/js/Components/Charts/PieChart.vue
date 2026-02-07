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
            color: '#9CA3AF',
            fontSize: '12px',
            formatter: () => 'Ksh 1.2M', 
          },
          value: {
            fontSize: '24px',
            fontWeight: '900',
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
    <div class="relative">
        <ApexChart type="donut" height="280" :options="chartOptions" :series="series" />
    </div>

    <div class="grid grid-cols-2 gap-3 mt-4">
        <div class="flex items-center space-x-2">
            <span class="w-2.5 h-2.5 rounded-full bg-amber-600"></span>
            <span class="text-xs font-semibold text-gray-600">Maintenance</span>
        </div>
        <div class="flex items-center space-x-2">
            <span class="w-2.5 h-2.5 rounded-full bg-amber-400"></span>
            <span class="text-xs font-semibold text-gray-600">Utilities</span>
        </div>
        <div class="flex items-center space-x-2">
            <span class="w-2.5 h-2.5 rounded-full bg-amber-300"></span>
            <span class="text-xs font-semibold text-gray-600">Staff</span>
        </div>
        <div class="flex items-center space-x-2">
            <span class="w-2.5 h-2.5 rounded-full bg-amber-100"></span>
            <span class="text-xs font-semibold text-gray-600">Misc</span>
        </div>
    </div>
</template>
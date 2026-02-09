import './bootstrap'
import '../css/app.css'
import 'vue-sonner/style.css'

import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import VueApexCharts from 'vue3-apexcharts' //  Import ApexCharts

createInertiaApp({
  resolve: name => {
    const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
    return pages[`./Pages/${name}.vue`]
  },
  setup({ el, App, props, plugin }) {
    const vueApp = createApp({ render: () => h(App, props) })

    vueApp.use(plugin)
    vueApp.use(VueApexCharts) // Apex charts Register globally
    vueApp.component('ApexChart', VueApexCharts) //  Define global component

    vueApp.mount(el)
  },
})

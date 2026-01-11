<script setup>
import { Toaster as Sonner } from 'vue-sonner'

const props = defineProps({
  position: {
    type: String,
    default: 'top-right',
  },
  theme: {
    type: String,
    default: 'light', // allows flexibility for 'light' theme later
  },
})
</script>

<template>
  <Sonner
    class="toaster group"
    :position="props.position"
    :rich-colors="true"
    :close-button="true"
    :theme="props.theme"
    v-bind="props"
    :toast-options="{
      duration: 4000,
      classes: {
        toast:
          'group toast group-[.toaster]:bg-gray-900/95 group-[.toaster]:text-gray-100 ' +
          'group-[.toaster]:border border-gray-800/60 group-[.toaster]:backdrop-blur-md ' +
          'group-[.toaster]:shadow-lg group-[.toaster]:rounded-2xl transition-all duration-200 ' +
          'hover:scale-[1.02] hover:shadow-xl',
        
        description:
          'group-[.toast]:text-gray-400 group-[.toast]:text-sm mt-1 leading-relaxed',

        actionButton:
          'group-[.toast]:bg-indigo-600 hover:bg-indigo-500 group-[.toast]:text-white ' +
          'group-[.toast]:rounded-lg px-3 py-1 text-sm font-medium transition-colors',

        cancelButton:
          'group-[.toast]:bg-gray-800 hover:bg-gray-700 group-[.toast]:text-gray-300 ' +
          'group-[.toast]:rounded-lg px-3 py-1 text-sm font-medium transition-colors',

        // Status-based color themes
        error:
          'group-[.toaster]:bg-red-950/95 group-[.toaster]:border-red-800/70 group-[.toaster]:text-red-100',
        
        success:
          'group-[.toaster]:bg-emerald-950/95 group-[.toaster]:border-emerald-800/70 group-[.toaster]:text-emerald-100',
        
        warning:
          'group-[.toaster]:bg-amber-950/95 group-[.toaster]:border-amber-800/70 group-[.toaster]:text-amber-100',
        
        info:
          'group-[.toaster]:bg-sky-950/95 group-[.toaster]:border-sky-800/70 group-[.toaster]:text-sky-100',
      },
    }"
  />
</template>
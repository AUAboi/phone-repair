<script setup>
import { Link } from '@inertiajs/vue3';


const props = defineProps({

  appointment: {
    required: true
  }
})
</script>

<template>
  <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">Device Details</h2>

  <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
    Complete detail about device</p>


  <div class="mt-8 max-w-xs">
    <div class="flex flex-col sm:flex-row justify-between">
      <span class="text-lg font-medium text-gray-900 dark:text-gray-100">Brand: </span>
      <span class="mt-1  text-gray-600 dark:text-gray-400">
        {{ appointment.device.brand.name }}
      </span>
    </div>
    <div class="flex flex-col sm:flex-row justify-between">
      <span class="text-lg font-medium text-gray-900 dark:text-gray-100">Device: </span>
      <Link :href="route('devices.edit', appointment.device.slug)"
        class="mt-1 text-blue-600 dark:text-blue-400 underline">
      {{ appointment.device.name }}
      </Link>
    </div>
    <div class="flex flex-col sm:flex-row justify-between">
      <span class="text-lg font-medium text-gray-900 dark:text-gray-100">Repair Type: </span>
      <span class="mt-1 text-gray-600 dark:text-gray-400">
        {{ appointment.device_repair.repair.title }}
      </span>
    </div>
    <div class="flex flex-col sm:flex-row justify-between">
      <span class="text-lg font-medium text-gray-900 dark:text-gray-100">Repair : </span>
      <span class="mt-1 text-gray-600 dark:text-gray-400">
        {{ appointment.device_repair.title }}
      </span>
    </div>
    <div class="flex flex-col sm:flex-row justify-between">
      <span class="text-lg font-medium text-gray-900 dark:text-gray-100">Total : </span>
      <span class="mt-1 text-gray-600 dark:text-gray-400">
        {{ appointment.total }}
      </span>
    </div>

  </div>
</template>

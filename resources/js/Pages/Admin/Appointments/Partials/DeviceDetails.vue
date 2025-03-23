<script setup>
import { Link } from "@inertiajs/vue3";

const props = defineProps({
  appointment: {
    required: true,
  },
});
</script>

<template>
  <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
    Booking Details - Payment {{ appointment.payment_status }}
  </h2>

  <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
    Complete detail about booking
  </p>

  <div class="mt-8 max-w-xs">
    <div class="flex flex-col sm:flex-row justify-between">
      <span class="text-lg font-medium text-gray-900 dark:text-gray-100"
        >Date and time:
      </span>
      <span class="mt-1 text-gray-600 dark:text-gray-400">
        {{ appointment.appointment_date }},
        {{ appointment.appointment_time }}
      </span>
    </div>
    <div
      class="flex flex-col sm:flex-row justify-between"
      v-if="appointment.device"
    >
      <span class="text-lg font-medium text-gray-900 dark:text-gray-100"
        >Brand:
      </span>
      <span class="mt-1 text-gray-600 dark:text-gray-400">
        {{ appointment.device.brand.name }}
      </span>
    </div>
    <div
      v-if="appointment.device"
      class="flex flex-col sm:flex-row justify-between"
    >
      <span class="text-lg font-medium text-gray-900 dark:text-gray-100"
        >Device:
      </span>
      <Link
        :href="route('devices.edit', appointment.device.slug)"
        class="mt-1 text-blue-600 dark:text-blue-400 underline"
      >
        {{ appointment.device.name }}
      </Link>
    </div>
    <div v-else class="flex flex-col sm:flex-row justify-between">
      <span class="text-lg font-medium text-gray-900 dark:text-gray-100"
        >Product:
      </span>
      <span class="mt-1 text-gray-600 dark:text-gray-400">
        {{ appointment.device_name }}
      </span>
    </div>
    <div
      class="flex flex-col sm:flex-row justify-between"
      v-if="appointment.device"
    >
      <span class="text-lg font-medium text-gray-900 dark:text-gray-100"
        >Repair Type:
      </span>
      <span class="mt-1 text-gray-600 dark:text-gray-400">
        {{ appointment.device_repair.repair.title }}
      </span>
    </div>
    <div
      v-if="appointment.device"
      class="flex flex-col sm:flex-row justify-between"
    >
      <span class="text-lg font-medium text-gray-900 dark:text-gray-100"
        >Repair :
      </span>
      <span class="mt-1 text-gray-600 dark:text-gray-400">
        {{ appointment.device_repair.title }}
      </span>
    </div>

    <div class="flex flex-col sm:flex-row justify-between">
      <span class="text-lg font-medium text-gray-900 dark:text-gray-100"
        >Payment Method :
      </span>
      <span class="mt-1 text-gray-600 dark:text-gray-400">
        {{ appointment.payment_method ?? "No Paid" }}
      </span>
    </div>
    <div class="flex flex-col sm:flex-row justify-between">
      <span class="text-lg font-medium text-gray-900 dark:text-gray-100"
        >Total :
      </span>
      <span class="mt-1 text-gray-600 dark:text-gray-400">
        {{ appointment.total }}
      </span>
    </div>

    <div class="mt-4">
      <span class="text-lg font-medium text-gray-900 dark:text-gray-100"
        >Message :
      </span>
      <span class="mt-1 text-gray-600 dark:text-gray-400">
        {{ appointment.message }}
      </span>
    </div>
  </div>
</template>

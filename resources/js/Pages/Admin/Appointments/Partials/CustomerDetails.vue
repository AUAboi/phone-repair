<script setup>
import { Link } from '@inertiajs/vue3';


const props = defineProps({
  appointment: {
    required: true
  }
})
</script>

<template>
  <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">Customer Details</h2>

  <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
    Complete detail about customer</p>

  <div class="mt-8 max-w-xs">

    <div class="flex flex-col sm:flex-row justify-between">
      <span class="text-lg font-medium text-gray-900 dark:text-gray-100">Name: </span>
      <span class="mt-1  text-gray-600 dark:text-gray-400">
        {{ appointment.full_name }}
      </span>
    </div>

    <div class="flex flex-col sm:flex-row justify-between">
      <span class="text-lg font-medium text-gray-900 dark:text-gray-100">Phone Number: </span>
      <span class="mt-1  text-gray-600 dark:text-gray-400">
        {{ appointment.phone }}
      </span>
    </div>
    <div class="flex flex-col sm:flex-row justify-between">
      <span class="text-lg font-medium text-gray-900 dark:text-gray-100">Email: </span>
      <span class="mt-1  text-gray-600 dark:text-gray-400">
        {{ appointment.email }}
      </span>
    </div>
    <div class="flex flex-col sm:flex-row justify-between">
      <span class="text-lg font-medium text-gray-900 dark:text-gray-100">Address: </span>
      <span class="mt-1  text-gray-600 dark:text-gray-400">
        {{ appointment.address }}
      </span>
    </div>
    <div class="flex flex-col sm:flex-row justify-between">
      <span class="text-lg font-medium text-gray-900 dark:text-gray-100">City: </span>
      <span class="mt-1  text-gray-600 dark:text-gray-400">
        {{ appointment.city }}
      </span>
    </div>
    <div class="flex flex-col sm:flex-row justify-between">
      <span class="text-lg font-medium text-gray-900 dark:text-gray-100">Zip Code: </span>
      <span class="mt-1  text-gray-600 dark:text-gray-400">
        {{ appointment.zip_code }}
      </span>
    </div>
    <div class="flex flex-col sm:flex-row justify-between">
      <span class="text-lg font-medium text-gray-900 dark:text-gray-100">By: </span>
      <Link v-if="appointment.user" :href="route('public.home')" class="mt-1 text-blue-600 dark:text-blue-400 underline">
      {{ appointment.user.name }}
      </Link>
      <span v-else class="mt-1  text-gray-600 dark:text-gray-400">
        Guest
      </span>
    </div>

  </div>
</template>
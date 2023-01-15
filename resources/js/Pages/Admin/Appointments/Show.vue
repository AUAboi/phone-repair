
<script setup>
import PageHeader from '@/Components/PageHeader.vue';
import CustomerDetails from './Partials/CustomerDetails.vue';
import DeviceDetails from './Partials/DeviceDetails.vue';
import { Head, } from '@inertiajs/vue3';

const props = defineProps({
  appointment: {
    required: true
  }
})

</script>

<template>

  <Head title="Appointment" />

  <PageHeader>View Appointment</PageHeader>
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
      <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg mx-2 sm:mx-0">
        <CustomerDetails :appointment="appointment" />
      </div>
      <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg mx-2 sm:mx-0">
        <DeviceDetails :device="appointment.device" />
      </div>
    </div>
  </div>
</template>

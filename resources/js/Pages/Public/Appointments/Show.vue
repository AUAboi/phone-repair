<script setup>
import CustomerDetails from "@/Pages/Admin/Appointments/Partials/CustomerDetails.vue";

import DeviceDetails from "@/Pages/Admin/Appointments/Partials/DeviceDetails.vue";

const props = defineProps({
  appointment: {
    required: true,
  },
});
</script>
<template>
  <div
    class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg mx-2 sm:mx-0"
  >
    <CustomerDetails :appointment="appointment" />
  </div>
  <div
    class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg mx-2 sm:mx-0"
  >
    <DeviceDetails :appointment="appointment" />
  </div>
</template>

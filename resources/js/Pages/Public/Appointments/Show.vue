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
  <section class="pt-28">
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8 space-y-6">
      <div class="px-4 sm:px-8 mx-2 sm:mx-0 pt-9">
        <h5 class="text-3xl font-semibold">
          Appointment #{{ appointment.appointment_number }}
        </h5>
      </div>
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
    </div>
  </section>
</template>

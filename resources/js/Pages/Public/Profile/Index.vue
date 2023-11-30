<script setup>
import DataTable from "@/Components/DataTable.vue";
import UpdatePasswordForm from "@/Pages/Public/Profile/partials/UpdatePasswordForm.vue";
import UpdateProfileInformationForm from "@/Pages/Public/Profile/partials/UpdateProfileInformationForm.vue";
import { Head, Link } from "@inertiajs/vue3";

const props = defineProps(["user", "orders", "appointments"]);

const orderLabels = [
  {
    key: "order_no",
    value: "Order No",
  },
  {
    key: "order_status",
    value: "Order Status",
  },
  {
    key: "total",
    value: "Total Amount",
  },
  {
    key: "formatted_order_date",
    value: "",
  },
];

const appointmentLabels = [
  {
    key: "appointment_number",
    value: "Appointment Number",
  },
  {
    key: "full_name",
    value: "Name",
  },
  {
    key: "device_name",
    value: "Product / Service",
  },
  {
    key: "phone",
    value: "Phone",
  },
  {
    key: "email",
    value: "Email",
  },
  {
    key: "appointment_date",
    value: "Appointment Date",
  },
  {
    key: "appointment_time",
    value: "Appointment Time",
  },
];
</script>

<template>
  <Head :title="`${user.full_name} Profile`" />

  <div class="pb-12 pt-36">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
      <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
        <UpdateProfileInformationForm />
      </div>
      <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
        <UpdatePasswordForm />
      </div>
      <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
        <h6 class="text-4xl font-semibold">Your Orders</h6>

        <DataTable
          resource-route="order.show"
          :table-data="orders"
          :labels="orderLabels"
        />
      </div>
      <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
        <h6 class="text-4xl font-semibold">Your Appointments</h6>

        <DataTable
          resource-route="appointment.show"
          :table-data="appointments"
          :labels="appointmentLabels"
        />
      </div>
      <Link
        as="button"
        method="post"
        class="text-xl hover:text-red-600 text-red-500 underline px-4 py-1"
        :href="route('logout')"
      >
        Logout</Link
      >
    </div>
  </div>
</template>

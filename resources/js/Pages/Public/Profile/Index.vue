<script setup>
import DataTable from "@/Components/DataTable.vue";
import UpdatePasswordForm from "@/Pages/Public/Profile/partials/UpdatePasswordForm.vue";
import UpdateProfileInformationForm from "@/Pages/Public/Profile/partials/UpdateProfileInformationForm.vue";
import { Head, Link } from "@inertiajs/vue3";

const props = defineProps(["user", "orders"]);

const labels = [
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
    key: "created_at",
    value: "",
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
        <DataTable
          resource-route="order.show"
          :table-data="orders.data"
          :labels="labels"
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

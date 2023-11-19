<script setup>
import DataTable from "@/Components/DataTable.vue";
import Paginator from "@/Components/Paginator.vue";
import { Head, Link } from "@inertiajs/vue3";
import PageHeader from "@/Components/PageHeader.vue";

const props = defineProps({
  orders: {
    required: true,
    type: Object,
  },
});

const labels = [
  {
    key: "name",
    value: "Customer Name",
  },
  {
    key: "phone",
    value: "Customer Phone",
  },
  {
    key: "email",
    value: "Customer Email",
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
    key: "user.first_name",
    value: "User",
  },
];
</script>
<template>
  <Head title="Orders" />
  <PageHeader>Orders</PageHeader>
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div
        class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg mx-2 md:mx-0"
      >
        <div class="text-gray-900 dark:text-gray-100 overflow-x-auto">
          <DataTable :table-data="orders.data" :labels="labels" />
        </div>
        <Paginator :links="orders.meta.links" />
      </div>
    </div>
  </div>
</template>

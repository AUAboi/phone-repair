<script setup>
import { Head } from "@inertiajs/vue3";
import OrderShow from "@/Components/OrderShow.vue";

const props = defineProps({
  order: Object,
  previous_orders: {
    required: false,
    type: Number,
  },
});
</script>
<template>
  <Head :title="`Order #${order.order_no}`" />
  <section class="pt-28">
    <OrderShow :order="order" :previous_orders="previous_orders" />
  </section>
</template>

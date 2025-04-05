<script setup>
import { Head, Link } from "@inertiajs/vue3";
import OrderShow from "@/Components/OrderShow.vue";
import { usePoll } from "@inertiajs/vue3";
import useSweetAlert from "@/Composables/useSweetAlert";
import { watch } from "vue";

const props = defineProps({
  order: Object,
  previous_orders: {
    required: false,
    type: Number,
  },
});

const { alertSuccess } = useSweetAlert();

usePoll(2000);

watch(
  () => props.order.payment_status,
  (newStatus) => {
    if (newStatus === "paid") {
      alertSuccess({
        title: "Success",
        text: "Your payment has been successfully processed.",
        timer: 5000,
      });
    }
  }
);
</script>
<template>
  <Head :title="`Order #${order.order_no}`" />
  <section class="pt-28">
    <OrderShow :order="order" :previous_orders="previous_orders" />
    <div class="py-14 px-4 md:px-6 2xl:px-20 2xl:container 2xl:mx-auto">
      <Link
        v-if="order.payment_status !== 'paid'"
        as="button"
        :href="route('order.paymentPage', order.order_no)"
        class="btn--primary"
        >Pay Now</Link
      >
    </div>
  </section>
</template>

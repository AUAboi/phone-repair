<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3";
import PageHeader from "@/Components/PageHeader.vue";
import OrderShow from "@/Components/OrderShow.vue";
import FormSelect from "@/Components/FormSelect.vue";

const props = defineProps({
  order: {
    required: true,
    type: Object,
  },
});

const form = useForm({
  order_status: props.order.order_status,
  send_email: false,
});

const update = () => {
  form.post(route("orders.update", props.order.order_no), {
    preserveScroll: true,
    preserveState: true,
  });
};
</script>
<template>
  <Head :title="`Order #${order.order_no}`" />
  <PageHeader class="capitalize"
    >Order #{{ order.order_no }} - {{ order.order_status }}</PageHeader
  >
  <div class="py-12">
    <OrderShow :order="order" />
    <div class="px-4 md:px-6 2xl:px-20 2xl:container 2xl:mx-auto">
      <div class="flex justify-start item-start space-y-2 flex-col py-4">
        <h1
          class="text-3xl dark:text-white lg:text-4xl font-semibold leading-7 lg:leading-9 text-gray-800"
        >
          Actions
        </h1>
      </div>
      <div
        class="flex flex-col justify-start items-start dark:bg-gray-800 bg-gray-50 px-4 py-4 md:py-6 md:p-6 xl:p-8 w-full"
      >
        <form
          @submit.prevent="update"
          class="text-lg md:text-xl dark:text-white font-semibold leading-6 xl:leading-5 text-gray-800 w-full"
        >
          <p class="text-2xl mb-4 capitalize">
            Payment Status - {{ order.payment_status }}
          </p>
          <p class="text-2xl mt-10 mb-4">Order Status</p>

          <FormSelect
            v-model="form.order_status"
            :error="form.errors.order_status"
          >
            <option value="preparing">Preparing</option>
            <option value="in-transit">In-transit</option>
            <option value="delivered">Delivered</option>
            <option value="cancelled">Cancelled</option>
          </FormSelect>
          <div class="flex items-center mb-4 gap-4 hidden">
            <label for="send-email">Send email?</label>
            <input id="send-email" v-model="form.send_email" type="checkbox" />
          </div>
          <div class="space-x-4">
            <button class="dark:bg-white dark:text-gray-800 px-2 py-2 rounded">
              Update Status
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

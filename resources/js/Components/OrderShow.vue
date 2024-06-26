<script setup>
import { useDateFormat } from "@vueuse/core";

const props = defineProps({
  order: Object,
  previous_orders: {
    required: false,
    type: Number,
  },
});

const formatted = useDateFormat(props.order.created_at, "D MMMM, YYYY");
</script>
<template>
  <div class="py-14 px-4 md:px-6 2xl:px-20 2xl:container 2xl:mx-auto">
    <div class="flex justify-start item-start space-y-2 flex-col">
      <h1
        class="text-3xl dark:text-white lg:text-4xl font-semibold leading-7 lg:leading-9 text-gray-800 capitalize"
      >
        Order #{{ order.order_no }}
      </h1>
      <h1
        class="text-xl dark:text-white lg:text-4xl font-medium leading-7 lg:leading-9 text-gray-800 capitalize"
      >
        Order Status: {{ order.order_status }} - Payment
        {{ order.payment_status }}
      </h1>

      <p
        class="text-base dark:text-gray-300 font-medium leading-6 text-gray-600"
      >
        {{ formatted }}
      </p>
    </div>
    <div
      class="mt-10 flex flex-col xl:flex-row jusitfy-center items-stretch w-full xl:space-x-8 space-y-4 md:space-y-6 xl:space-y-0"
    >
      <div
        class="flex flex-col justify-start items-start w-full space-y-4 md:space-y-6 xl:space-y-8"
      >
        <div
          class="flex flex-col justify-start items-start dark:bg-gray-800 bg-gray-50 px-4 py-4 md:py-6 md:p-6 xl:p-8 w-full"
        >
          <p
            class="text-lg md:text-xl dark:text-white font-semibold leading-6 xl:leading-5 text-gray-800"
          >
            Customer’s Cart
          </p>
          <div
            v-for="product in order.products"
            class="mt-4 md:mt-6 flex flex-col md:flex-row justify-start items-start md:items-center md:space-x-6 xl:space-x-8 w-full"
          >
            <div class="pb-4 md:pb-8 w-full md:w-40">
              <img
                class="w-full object-cover"
                :src="
                  product.product_model
                    ? product.product_model.image
                    : '/images/picture-not-available.jpg'
                "
                alt="dress"
              />
            </div>
            <div
              class="border-b border-gray-200 md:flex-row flex-col flex justify-between items-start w-full pb-8 space-y-4 md:space-y-0"
            >
              <div
                class="w-full flex flex-col justify-start items-start space-y-8"
              >
                <h3
                  class="text-xl dark:text-white xl:text-2xl font-semibold leading-6 text-gray-800"
                >
                  {{ product.name }}
                </h3>
              </div>
              <div class="flex justify-between space-x-8 items-start w-full">
                <p class="text-base dark:text-white xl:text-lg leading-6">
                  {{ product.formatted_price }}
                </p>
                <p
                  class="text-base dark:text-white xl:text-lg leading-6 text-gray-800"
                >
                  {{ product.quantity }}x
                </p>
                <p
                  class="text-base dark:text-white xl:text-lg font-semibold leading-6 text-gray-800"
                >
                  {{ product.formatted_total }}
                </p>
              </div>
            </div>
          </div>
        </div>
        <div
          class="flex justify-center md:flex-row flex-col items-stretch w-full space-y-4 md:space-y-0 md:space-x-6 xl:space-x-8"
        >
          <div
            class="flex flex-col px-4 py-6 md:p-6 xl:p-8 w-full bg-gray-50 dark:bg-gray-800 space-y-6"
          >
            <h3
              class="text-xl dark:text-white font-semibold leading-5 text-gray-800"
            >
              Summary
            </h3>

            <div class="flex justify-between items-center w-full">
              <p
                class="text-base dark:text-white font-semibold leading-4 text-gray-800"
              >
                Total
              </p>
              <p
                class="text-base dark:text-gray-300 font-semibold leading-4 text-gray-600"
              >
                {{ order.total }}
              </p>
            </div>
          </div>
        </div>
      </div>
      <div
        class="bg-gray-50 dark:bg-gray-800 w-full xl:w-96 flex justify-between items-center md:items-start px-4 py-6 md:p-6 xl:p-8 flex-col"
      >
        <h3
          class="text-xl dark:text-white font-semibold leading-5 text-gray-800"
        >
          Customer
        </h3>
        <div
          class="flex flex-col md:flex-row xl:flex-col justify-start items-stretch h-full w-full md:space-x-6 lg:space-x-8 xl:space-x-0"
        >
          <div class="flex flex-col justify-start items-start flex-shrink-0">
            <div
              class="flex justify-center w-full md:justify-start items-center space-x-4 py-8 border-b border-gray-200"
            >
              <div class="flex justify-start items-start flex-col space-y-2">
                <p
                  class="text-base dark:text-white font-semibold leading-4 text-left text-gray-800"
                >
                  {{ order.first_name }} {{ order.last_name }}
                </p>
                <p
                  v-if="previous_orders"
                  class="text-sm dark:text-gray-300 leading-5 text-gray-600"
                >
                  {{ previous_orders }} previous orders
                </p>
              </div>
            </div>

            <div
              class="flex justify-center text-gray-800 dark:text-white md:justify-start items-center space-x-4 py-4 border-b border-gray-200 w-full"
            >
              <img
                class="dark:hidden"
                src="https://tuk-cdn.s3.amazonaws.com/can-uploader/order-summary-3-svg1.svg"
                alt="email"
              />
              <img
                class="hidden dark:block"
                src="https://tuk-cdn.s3.amazonaws.com/can-uploader/order-summary-3-svg1dark.svg"
                alt="email"
              />
              <p class="cursor-pointer text-sm leading-5">
                {{ order.email }}
              </p>
            </div>
          </div>
          <div
            class="flex justify-between xl:h-full items-stretch w-full flex-col mt-6 md:mt-0"
          >
            <div
              class="flex justify-center md:justify-start xl:flex-col flex-col md:space-x-6 lg:space-x-8 xl:space-x-0 space-y-4 xl:space-y-12 md:space-y-0 md:flex-row items-center md:items-start"
            >
              <div
                class="flex justify-center md:justify-start items-center md:items-start flex-col space-y-4 xl:mt-8"
              >
                <p
                  class="text-base dark:text-white font-semibold leading-4 text-center md:text-left text-gray-800"
                >
                  Shipping Address
                </p>
                <p
                  class="w-48 lg:w-full dark:text-gray-300 xl:w-48 text-center md:text-left text-sm leading-5 text-gray-600"
                >
                  {{ order.full_address }}
                </p>
              </div>
              <div>
                <p
                  class="text-base dark:text-white font-semibold leading-4 text-center md:text-left text-gray-800"
                >
                  Payment Method
                </p>
                <p
                  class="w-48 lg:w-full dark:text-gray-300 xl:w-48 text-center md:text-left text-lg uppercase mt-4 leading-5 text-gray-600"
                >
                  {{ order.payment_method }}
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

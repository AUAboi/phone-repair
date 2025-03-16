<script setup>
import { computed } from "@vue/reactivity";
import { Link, Head, useForm } from "@inertiajs/vue3";
import CartItem from "@/Pages/Public/Cart/Partials/CartItem.vue";

const props = defineProps({
  cartContents: Object,
});

const hasCartItems = computed(() => {
  return Object.keys(props.cartContents.content).length;
});

const form = useForm({
  email: "",
  phone: "",
});
</script>

<template>
  <Head title="View Cart"></Head>
  <section class="pt-28">
    <div class="container mx-auto" v-if="hasCartItems">
      <div class="flex justify-evenly flex-wrap my-10">
        <div class="bg-white px-10 py-10 flex-grow">
          <div class="flex justify-between border-b pb-8">
            <h1 class="font-semibold text-2xl">Cart</h1>
            <h2 class="font-semibold text-2xl">
              {{ cartContents.quantity }} Items
            </h2>
          </div>
          <div class="flex mt-10 bg-red-500 py-2 px-2">
            <h3 class="font-semibold text-gray-200 text-xs uppercase w-2/5">
              Package
            </h3>
            <h3
              class="font-semibold text-gray-200 text-xs uppercase w-1/5 text-center"
            >
              Quantity
            </h3>
            <h3
              class="font-semibold text-gray-200 text-xs uppercase w-1/5 text-center"
            >
              Price
            </h3>
            <h3
              class="font-semibold text-gray-200 text-xs uppercase w-1/5 text-center"
            >
              Total
            </h3>
          </div>
          <CartItem
            v-for="item in cartContents.content"
            :cartProduct="item"
            :key="item.id"
          />
          <Link
            :href="route('public.home')"
            class="flex font-semibold text-yellow-600 text-sm mt-10"
          >
            <svg
              class="fill-current mr-2 text-yellow-600 w-4"
              viewBox="0 0 448 512"
            >
              <path
                d="M134.059 296H436c6.627 0 12-5.373 12-12v-56c0-6.627-5.373-12-12-12H134.059v-46.059c0-21.382-25.851-32.09-40.971-16.971L7.029 239.029c-9.373 9.373-9.373 24.569 0 33.941l86.059 86.059c15.119 15.119 40.971 4.411 40.971-16.971V296z"
              />
            </svg>
            Continue Shopping
          </Link>
        </div>

        <div id="summary" class="px-8 py-10 flex-grow md:flex-grow-0">
          <h1 class="font-semibold text-2xl border-b pb-8">Order Summary</h1>
          <div class="flex justify-between mt-10 mb-5">
            <span class="font-semibold text-sm uppercase"
              >{{ cartContents.quantity }} Items</span
            >
            <span class="font-semibold text-sm">{{ cartContents.total }}</span>
          </div>

          <div class="border-t mt-8">
            <div
              class="flex font-semibold justify-between py-6 text-sm uppercase"
            >
              <span>Total cost</span>
              <span>{{ cartContents.total }}</span>
            </div>
            <Link
              as="button"
              :href="route('checkout.index')"
              class="bg-red-500 font-semibold hover:bg-red-600 py-3 px-2 rounded-sm text-sm text-white uppercase w-full"
            >
              Continue to checkout
            </Link>
          </div>
        </div>
      </div>
    </div>
    <div v-else class="text-4xl py-16 text-center">
      <h1>Oops, it seems your cart is empty</h1>
    </div>
  </section>
</template>

<style scoped>
#summary {
  background-color: #f6f6f6;
}
</style>

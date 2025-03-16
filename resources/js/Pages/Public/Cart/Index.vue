<script setup>
import { computed } from "@vue/reactivity";
import { Link, Head, useForm } from "@inertiajs/vue3";
import CartItem from "@/Pages/Public/Cart/Partials/CartItem.vue";
import Aos from "aos";
import { onMounted } from "vue";
import IncDec from "../Product/partials/inc-dec.vue";
import bg from "@/assets/img/shortcode/breadcumb.jpg";

const props = defineProps({
  cartContents: Object,
});

const hasCartItems = computed(() => {
  return Object.keys(props.cartContents.content).length;
});

onMounted(() => {
  Aos.init();
});
</script>

<template>
  <Head title="View Cart"></Head>
  <div
    class="flex items-center gap-4 flex-wrap bg-overlay p-14 sm:p-16 before:bg-title before:bg-opacity-70"
    :style="{ backgroundImage: 'url(' + bg + ')' }"
  >
    <div class="text-center w-full">
      <h2
        class="text-white text-8 md:text-[40px] font-normal leading-none text-center"
      >
        Cart
      </h2>
      <ul
        class="flex items-center justify-center gap-[10px] text-base md:text-lg leading-none font-normal text-white mt-3 md:mt-4"
      >
        <li><Link :href="route('public.home')">Home</Link></li>
        <li>/</li>
        <li class="text-primary">Cart</li>
      </ul>
    </div>
  </div>

  <div class="s-py-100" data-aos="fade-up">
    <div class="container">
      <div
        v-if="hasCartItems"
        class="flex xl:flex-row flex-col gap-[30px] lg:gap-[30px] xl:gap-[70px]"
      >
        <div class="flex-1 overflow-auto">
          <table
            id="cart-table"
            class="responsive nowrap table-wrapper"
            style="width: 100%"
          >
            <thead class="table-header">
              <tr>
                <th
                  class="text-lg md:text-xl font-semibold leading-none text-title dark:text-white"
                >
                  Product Info
                </th>
                <th
                  class="text-lg md:text-xl font-semibold leading-none text-title dark:text-white"
                >
                  Price
                </th>
                <th
                  class="text-lg md:text-xl font-semibold leading-none text-title dark:text-white"
                >
                  Quantity
                </th>
                <th
                  class="text-lg md:text-xl font-semibold leading-none text-title dark:text-white"
                >
                  Total
                </th>
                <th
                  class="text-lg md:text-xl font-semibold leading-none text-title dark:text-white"
                >
                  Remove
                </th>
              </tr>
            </thead>
            <tbody class="table-body">
              <tr v-for="item in cartContents.content">
                <td class="w-[42%]">
                  <div
                    class="flex items-center gap-3 md:gap-4 lg:gap-6 cart-product"
                  >
                    <div class="w-14 sm:w-20 flex-none py-3">
                      <img :src="item.associatedModel.image" alt="product" />
                    </div>
                    <div class="flex-1">
                      <h6 class="leading-none font-medium">
                        {{ item.associatedModel.category }}
                      </h6>
                      <h5 class="font-semibold leading-none mt-2">
                        <Link :href="route('public.product.show', item.id)">{{
                          item.name
                        }}</Link>
                      </h5>
                    </div>
                  </div>
                </td>
                <td>
                  <h6
                    class="text-base md:text-lg leading-none text-title dark:text-white font-semibold"
                  >
                    {{ item.formatted_price }}
                  </h6>
                </td>
                <td>
                  <IncDec :item="item" />
                </td>
                <td>
                  <h6
                    class="text-base md:text-lg leading-none text-title dark:text-white font-semibold"
                  >
                    {{ item.total_price }}
                  </h6>
                </td>
                <td>
                  <Link
                    as="button"
                    :href="route('cart.removeitem', { id: item.id })"
                    method="post"
                    class="w-8 h-8 bg-[#E8E9EA] dark:bg-dark-secondary flex items-center justify-center ml-auto duration-300 text-title dark:text-white"
                  >
                    <svg
                      class="fill-current"
                      width="12"
                      height="12"
                      viewBox="0 0 12 12"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        d="M0.546875 1.70822L1.70481 0.550293L5.98646 4.83195L10.2681 0.550293L11.3991 1.6813L7.11746 5.96295L11.453 10.2985L10.295 11.4564L5.95953 7.12088L1.67788 11.4025L0.546875 10.2715L4.82853 5.98988L0.546875 1.70822Z"
                      />
                    </svg>
                  </Link>
                </td>
              </tr>
            </tbody>
          </table>
        </div>

        <div>
          <div class="mb-[30px]">
            <h4
              class="text-lg md:text-xl font-semibold leading-none text-title dark:text-white mb-[15px]"
            >
              Promo Code
            </h4>
            <div class="flex xs:flex-row flex-col gap-3">
              <input
                class="h-12 md:h-14 bg-snow dark:bg-dark-secondary border border-[#E3E5E6] text-title dark:text-white focus:border-primary p-4 outline-none duration-300 placeholder:text-title dark:placeholder:text-white flex-1"
                type="text"
                placeholder="Coupon Code"
              />
              <button class="btn btn-solid" data-text="Apply">
                <span>Apply</span>
              </button>
            </div>
          </div>
          <div
            class="bg-[#FAFAFA] dark:bg-dark-secondary pt-[30px] md:pt-[40px] px-[30px] md:px-[40px] pb-[30px] border border-[#17243026] border-opacity-15 rounded-xl"
          >
            <div
              class="text-right flex justify-end flex-col w-full ml-auto mr-0"
            >
              <div
                class="flex justify-between flex-wrap text-base sm:text-lg text-title dark:text-white font-medium"
              >
                <span>Sub Total:</span>
                <span>{{ cartContents.total }}</span>
              </div>
              <div
                class="flex justify-between flex-wrap text-base sm:text-lg text-title dark:text-white font-medium mt-3"
              >
                <span>Coupon Discount:</span>
                <span>0</span>
              </div>
              <div
                class="flex justify-between flex-wrap text-base sm:text-lg text-title dark:text-white font-medium mt-3"
              >
                <span>VAT:</span>
                <span> 0</span>
              </div>
            </div>
            <div
              class="mt-6 pt-6 border-t border-bdr-clr dark:border-bdr-clr-drk"
            >
              <div
                class="flex justify-between flex-wrap font-semibold leading-none text-2xl"
              >
                <span>Total:</span>
                <span>&nbsp;{{ cartContents.total }}</span>
              </div>
            </div>
          </div>
          <div
            class="sm:mt-[10px] py-5 flex items-end gap-3 flex-wrap justify-end"
          >
            <Link
              :href="route('public.shop')"
              class="btn btn-sm btn-outline !text-title hover:!text-white before:!z-[-1] dark:!text-white dark:hover:!text-title"
            >
              Continue Shopping
            </Link>
            <Link
              :href="route('checkout.index')"
              class="btn btn-sm btn-theme-solid !text-white hover:!text-primary before:!z-[-1]"
            >
              Checkout
            </Link>
          </div>
        </div>
      </div>
      <div v-else class="text-4xl py-16 text-center">
        <h1>Oops, it seems your cart is empty</h1>
      </div>
    </div>
  </div>
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
  </section>
</template>

<style scoped>
#summary {
  background-color: #f6f6f6;
}
</style>

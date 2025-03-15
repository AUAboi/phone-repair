<script setup>
import { Link } from "@inertiajs/vue3";

const props = defineProps(["cart", "cartList"]);
</script>
<template>
  <div
    v-if="cartList"
    class="hdr_cart_popup w-80 md:w-96 absolute z-50 top-full right-0 sm:right-10 xl:right-0 bg-white dark:bg-title p-5 md:p-[30px] border border-primary"
  >
    <h4 class="font-medium leading-none mb-4 text-xl md:text-2xl">Cart</h4>
    <div>
      <div class="hdr-cart-item">
        <div
          v-for="item in cart.content"
          class="flex gap-[15px] relative pb-[15px] mb-[15px] border-b border-bdr-clr dark:border-bdr-clr-drk group"
        >
          <Link :href="route('public.product.show', item.id)" class="block">
            <img
              class="w-[70px] md:w-auto h-full"
              :src="item.associatedModel.image"
              alt="cart"
            />
          </Link>
          <div>
            <div class="flex items-center gap-2">
              <span class="w-[6px] h-[6px] rounded-full bg-primary"></span>
              <span class="text-[14px] md:text-[15px] leading-none block">{{
                item.associatedModel.formatted_price
              }}</span>
            </div>
            <h6
              class="text-base md:text-lg font-semibold !leading-none mt-[10px]"
            >
              <Link :href="route('public.product.show', item.id)">{{
                item.associatedModel.name
              }}</Link>
            </h6>
            <div class="inc-dec flex items-center gap-2 mt-4">
              <Link
                as="div"
                method="post"
                :href="route('cart.remove', { id: item.id })"
                class="dec w-6 h-6 bg-[#E8E9EA] dark:bg-dark-secondary flex items-center justify-center cursor-pointer"
              >
                <svg
                  class="fill-current text-title dark:text-white"
                  width="12"
                  height="2"
                  viewBox="0 0 14 2"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    d="M10.4361 0.203613H12.0736L7.81774 0.203615H13.8729V1.80309H7.81774L3.50809 1.80309H1.87053L6.18017 1.80309H0.125V0.203615H6.18017L10.4361 0.203613Z"
                  />
                </svg>
              </Link>
              <input
                class="w-6 h-auto outline-none bg-transparent text-base mg:text-lg leading-none text-title dark:text-white text-center"
                type="text"
                :value="item.quantity"
              />
              <Link
                as="div"
                method="post"
                :href="route('cart.add', { id: item.id })"
                class="inc w-6 h-6 bg-[#E8E9EA] dark:bg-dark-secondary flex items-center justify-center cursor-pointer"
              >
                <svg
                  class="fill-current text-title dark:text-white"
                  width="12"
                  height="12"
                  viewBox="0 0 14 14"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    d="M6.18017 0.110352H7.81774V6.16553H13.8729V7.76501H7.81774V13.8963H6.18017V7.76501H0.125V6.16553H6.18017V0.110352Z"
                  />
                </svg>
              </Link>
            </div>
          </div>
          <Link
            as="div"
            method="post"
            :href="route('cart.removeitem', { id: item.id })"
            class="wishList_item_close cursor-pointer absolute top-0 right-0 w-6 h-6 flex items-center justify-center bg-title dark:bg-white bg-opacity-10 dark:bg-opacity-10 group hover:bg-primary dark:hover:bg-primary opacity-0 group-hover:opacity-100 text-title dark:text-white duration-300 hover:text-white"
          >
            <svg
              class="fill-current"
              width="10"
              height="10"
              viewBox="0 0 10 10"
              fill="none"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                d="M0.636719 1.56306L1.56306 0.636719L4.98839 4.06204L8.41371 0.636719L9.31851 1.54152L5.89319 4.96685L9.3616 8.43526L8.43526 9.3616L4.96685 5.89319L1.54152 9.31851L0.636719 8.41371L4.06204 4.98839L0.636719 1.56306Z"
              />
            </svg>
          </Link>
        </div>
      </div>
      <div
        class="pt-5 md:pt-[30px] mt-5 md:mt-[30px] border-t border-bdr-clr dark:border-bdr-clr-drk"
      >
        <h4
          class="mb-5 md:mb-[30px] font-medium !leading-none text-lg md:text-xl text-right"
        >
          Subtotal : {{ cart.total }}
        </h4>
        <div class="grid grid-cols-2 gap-4">
          <Link
            :href="route('cart.index')"
            class="btn btn-outline btn-sm"
            data-text="View Cart"
          >
            <span>View Cart</span>
          </Link>
          <Link
            :href="route('checkout.index')"
            class="btn btn-theme-solid btn-sm"
            data-text="Checkout"
          >
            <span>Checkout</span>
          </Link>
        </div>
      </div>
    </div>
  </div>
</template>

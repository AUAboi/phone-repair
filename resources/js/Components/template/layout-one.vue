<template>
  <div :class="classList">
    <div v-for="(item, index) in productList" :key="index" class="group">
      <div class="relative overflow-hidden">
        <Link :href="route('public.product.show', item.id)">
          <img
            class="w-full transform group-hover:scale-110 duration-300"
            :src="item.image"
            alt="shop"
          />
        </Link>

        <div
          class="absolute z-10 top-[50%] right-3 transform -translate-y-[40%] opacity-0 duration-300 transition-all group-hover:-translate-y-1/2 group-hover:opacity-100 flex flex-col items-end gap-3"
        >
          <router-link
            to="#"
            class="bg-white dark:bg-title dark:text-white bg-opacity-80 flex items-center justify-center gap-2 px-4 py-[10px] text-base leading-none text-title rounded-[40px] h-14 overflow-hidden new-product-icon"
          >
            <MdiCartOutline class="dark:text-white text-[24px]" /><span
              class="mt-1"
              >Add to Cart</span
            >
          </router-link>
          <Link
            as="button"
            :href="route('public.product.show', item.id)"
            class="bg-white dark:bg-title dark:text-white bg-opacity-80 flex items-center justify-center gap-2 px-4 py-[10px] text-base leading-none text-title rounded-[40px] h-14 overflow-hidden new-product-icon quick-view"
          >
            <MdiEyeOutline class="dark:text-white text-[24px]" />
            <span class="mt-1">Quick View</span>
          </Link>
        </div>
      </div>
      <div
        class="md:px-2 lg:px-4 xl:px-6 lg:pt-6 pt-5 flex gap-4 md:gap-5 flex-col"
      >
        <h4 class="font-medium leading-none dark:text-white text-lg">
          {{ item.formatted_price }}
        </h4>
        <div>
          <h5 class="font-normal dark:text-white text-xl leading-[1.5]">
            <Link
              :href="route('public.product.show', item.id)"
              class="text-underline"
            >
              {{ item.name }}
            </Link>
          </h5>
          <ul class="flex items-center gap-2 mt-1">
            <li>
              <MdiStar class="text-[#EE9818] text-[14px]" />
            </li>
            <li>
              <MdiStar class="text-[#EE9818] text-[14px]" />
            </li>
            <li>
              <MdiStar class="text-[#EE9818] text-[14px]" />
            </li>
            <li>
              <MdiStar class="text-[#EE9818] text-[14px]" />
            </li>

            <li>
              <MdiStar class="text-slate-300 text-[14px]" />
            </li>
            <li class="dark:text-gray-100">( 1,230 )</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { defineProps } from "vue";
import MdiStar from "~icons/mdi/star";
import MdiEyeOutline from "~icons/mdi/eye-outline";
import MdiCartOutline from "~icons/mdi/cart-outline";
import { Link } from "@inertiajs/vue3";

defineProps({
  productList: Array,
  classList: String,
});
</script>

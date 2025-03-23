<script setup>
import { onMounted } from "vue";

import bg from "@/assets/img/shortcode/breadcumb.jpg";
import Aos from "aos";
import LayoutOne from "@/Components/template/layout-one.vue";
import { Head, Link } from "@inertiajs/vue3";

const props = defineProps({
  category: {
    required: true,
  },
});

onMounted(() => {
  Aos.init();
});
</script>

<template>
  <Head :title="`${category.name} Products`" />
  <div>
    <div
      class="flex items-center gap-4 flex-wrap bg-overlay p-14 sm:p-16 before:bg-title before:bg-opacity-70"
      :style="{ backgroundImage: 'url(' + bg + ')' }"
    >
      <div class="text-center w-full">
        <h2
          class="text-white text-8 md:text-[40px] font-normal leading-none text-center"
        >
          Room Interior
        </h2>
        <ul
          class="flex items-center justify-center gap-[10px] text-base md:text-lg leading-none font-normal text-white mt-3 md:mt-4"
        >
          <li><Link :href="route('public.home')">Home</Link></li>
          <li>/</li>
          <li><Link :href="route('public.shop')">Shop</Link></li>
          <li>/</li>
          <li class="text-primary">{{ category.name }}</li>
        </ul>
      </div>
    </div>

    <div class="s-py-100">
      <div class="container-fluid">
        <div data-aos="fade-up" data-aos-delay="200">
          <LayoutOne
            v-if="category.products.length"
            :classList="'max-w-[1720px] mx-auto grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5 sm:gap-8 aos-init aos-animate'"
            :productList="category.products"
          />
          <div v-else class="text-center">
            <h2
              class="text-title dark:text-white text-3xl sm:text-4xl font-semibold"
            >
              No Products Found
            </h2>
          </div>

          <!-- <div
            class="mt-10 md:mt-12 flex items-center justify-center gap-[10px]"
          >
            <router-link to="#" class="text-title dark:text-white text-xl"
              ><span class="lnr lnr-arrow-left"></span
            ></router-link>
            <router-link
              to="#"
              class="w-8 sm:w-10 h-8 sm:h-10 bg-title bg-opacity-5 flex items-center justify-center leading-none text-base sm:text-lg font-medium text-title transition-all duration-300 hover:bg-opacity-100 hover:text-white dark:bg-white dark:bg-opacity-5 dark:text-white dark:hover:bg-opacity-100 dark:hover:text-title"
              >01</router-link
            >
            <router-link
              to="#"
              class="w-8 sm:w-10 h-8 sm:h-10 bg-title bg-opacity-5 flex items-center justify-center leading-none text-base sm:text-lg font-medium text-title transition-all duration-300 hover:bg-opacity-100 hover:text-white dark:bg-white dark:bg-opacity-5 dark:text-white dark:hover:bg-opacity-100 dark:hover:text-title"
              >02</router-link
            >
            <router-link
              to="#"
              class="text-title dark:text-white text-3xl sm:text-4xl transform"
              >...</router-link
            >
            <router-link
              to="#"
              class="w-8 sm:w-10 h-8 sm:h-10 bg-title bg-opacity-5 flex items-center justify-center leading-none text-base sm:text-lg font-medium text-title transition-all duration-300 hover:bg-opacity-100 hover:text-white dark:bg-white dark:bg-opacity-5 dark:text-white dark:hover:bg-opacity-100 dark:hover:text-title"
              >09</router-link
            >
            <router-link
              to="#"
              class="w-8 sm:w-10 h-8 sm:h-10 bg-title bg-opacity-5 flex items-center justify-center leading-none text-base sm:text-lg font-medium text-title transition-all duration-300 hover:bg-opacity-100 hover:text-white dark:bg-white dark:bg-opacity-5 dark:text-white dark:hover:bg-opacity-100 dark:hover:text-title"
              >10</router-link
            >

            <router-link to="#" class="text-title dark:text-white text-xl"
              ><span class="lnr lnr-arrow-right"></span
            ></router-link>
          </div> -->
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { onMounted, ref } from "vue";

import PartnersSections from "./partials/PartnersSections.vue";

import bg from "@/assets/img/banner/header 4.jpg";
import bg2 from "@/assets/img/sddefault.jpg";
import like from "@/assets/img/svg/like.svg";
import hand from "@/assets/img/svg/hand.svg";
import banner1 from "@/assets/img/about/about.jpg";
import banner2 from "@/assets/img/about/about-banner-02.jpg";
import banner3 from "@/assets/img/about/about-banner-03.jpg";
import { features } from "@/data/data";
import repair from "@/assets/img/svg/repair.svg";
import Aos from "aos";
import { Head, Link } from "@inertiajs/vue3";
import CloseCircleOutline from "~icons/mdi/close";

const activeTab = ref(1);
const open = ref(false);

onMounted(() => {
  Aos.init();
});
</script>

<template>
  <Head title="About Us" />
  <div
    class="flex items-center gap-4 flex-wrap bg-overlay p-14 sm:p-16 before:bg-title before:bg-opacity-70"
    :style="{ backgroundImage: 'url(' + bg + ')' }"
  >
    <div class="text-center w-full">
      <h2
        class="text-white text-8 md:text-[40px] font-normal leading-none text-center"
      >
        About Us
      </h2>
    </div>
  </div>
  <div class="s-pb-100 pt-12 md:pt-16" data-aos="fade-up">
    <div class="container-fluid">
      <div
        class="max-w-[1720px] mx-auto flex flex-col-reverse xl:grid xl:grid-cols-2"
      >
        <div
          class="lg:bg-[#F8F8F9] lg:dark:bg-dark-secondary lg:pr-10 2xl:pr-0 relative"
        >
          <div class="h-full block">
            <div v-if="activeTab === 1">
              <img class="object-cover w-full" :src="banner1" alt="about" />
            </div>
          </div>
        </div>
        <div
          class="flex items-center py-8 sm:py-12 px-5 sm:px-12 md:px-8 lg:pr-12 lg:pl-16 2xl:pl-[160px] bg-[#F8F8F9] dark:bg-dark-secondary"
        >
          <div class="lg:max-w-[600px]">
            <div class="max-w-48 mb-4">
              <img src="/images/logo-min.png" alt="" />
            </div>
            <h3
              class="font-medium leading-none mt-4 md:mt-6 text-2xl md:text-3xl"
            >
              About Us
            </h3>
            <p class="mt-3 text-base sm:text-lg">
              Since our establishment in 2015, we have been the trusted mobile
              phone shop in town, offering a wide range of repair services for
              mobile phones, tablets, iPads, and laptops. Our team excels in
              data recovery and specializes in mobile phone back glass
              replacements using the latest laser technology—an exclusive
              service in our area.
            </p>
            <p class="mt-3 text-base sm:text-lg">
              We also offer expert laptop and computer repairs, restorations,
              and installations to ensure your devices function seamlessly. In
              addition to repairs, we sell both new and pre-owned mobile phones,
              tablets, iPads, and laptops—all backed with a guarantee for your
              peace of mind.
            </p>
            <p class="mt-3 text-base sm:text-lg">
              Looking to sell your device? We buy mobile phones and laptops as
              well, providing reliable and hassle-free transactions. Visit us
              for unparalleled service and expertise.
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="s-pb-100 pt-14 md:pt-40 lg:pt-0">
    <div class="container-fluid">
      <div
        class="max-w-xl mx-auto mb-8 md:mb-12 text-center"
        data-aos="fade-up"
      >
        <div>
          <img :src="like" class="mx-auto size-16" alt="" />
        </div>
        <h3 class="font-medium leading-none mt-4 md:mt-6 text-2xl md:text-3xl">
          Why Choose Us
        </h3>
        <p class="mt-3">
          Choose us for exceptional quality, We prioritize your satisfaction by
          offering premium products and a seamless shopping experience.
        </p>
      </div>
      <div
        class="max-w-sm sm:max-w-[1720px] mx-auto grid sm:grid-cols-2 md:grid-cols-3 xl:flex lg:justify-between gap-7 flex-wrap lg:flex-nowrap"
        data-aos="fade-up"
        data-aos-delay="100"
      >
        <div
          v-for="(item, index) in features"
          :key="index"
          class="p-6 pb-0 rounded-[10px] relative"
        >
          <div
            class="w-[1px] h-[120px] absolute right-0 top-[30%]"
            :class="
              item.id === 5
                ? ''
                : 'hidden 2xl:block border-l border-dashed border-primary'
            "
          ></div>
          <img :src="item.image" alt="" class="size-12" />
          <h5 class="font-semibold text-xl md:text-2xl mt-3 md:mt-7">
            {{ item.title }}
          </h5>
          <p class="mt-2 sm:mt-3">{{ item.desc }}</p>
        </div>
      </div>
    </div>
  </div>

  <div class="container-fluid" data-aos="fade-up">
    <div
      class="bg-overlay before:bg-title before:bg-opacity-20 h-64 sm:h-96 lg:h-[650px] flex items-center justify-center max-w-[1720px] mx-auto"
      :style="{ backgroundImage: 'url(' + bg2 + ')' }"
    >
      <span
        @click="open = !open"
        class="popup-video w-12 sm:w-[70px] h-12 sm:h-[70px] rounded-full bg-white dark:bg-title flex items-center justify-center cursor-pointer"
      >
        <svg
          class="fill-current text-title dark:text-white"
          width="15"
          height="17"
          viewBox="0 0 15 17"
          fill="none"
          xmlns="http://www.w3.org/2000/svg"
        >
          <path
            d="M2.58357 0.369445C1.15676 -0.497057 0 0.212792 0 1.95367V14.8006C0 16.5432 1.15676 17.2521 2.58357 16.3864L13.1895 9.94678C14.6168 9.07997 14.6168 7.67561 13.1895 6.80901L2.58357 0.369445Z"
          />
        </svg>
      </span>
    </div>
  </div>

  <div
    v-if="open"
    class="fixed top-0 left-0 bg-black bg-opacity-50 w-full h-full z-[99999]"
  >
    <div class="flex items-center justify-center h-full">
      <div
        class="relative w-[300px] h-[200px] sm:w-[600px] sm:h-[450px] md:w-[750px] md:h-[500px]"
      >
        <iframe
          width="100%"
          height="100%"
          src="https://www.youtube.com/embed/m5JWSi51_Lw?si=H3CTtELuXNS0ri4g"
        >
        </iframe>
        <div
          @click="open = !open"
          class="absolute top-[-10px] right-[-10px] cursor-pointer w-8 h-8 bg-primary bg-opacity-70 text-center flex justify-center"
        >
          <CloseCircleOutline class="text-white text-[20px] mt-1" />
        </div>
      </div>
    </div>
  </div>
  <div class="s-py-100">
    <PartnersSections />
  </div>
</template>

<script setup>
import { onMounted, ref } from "vue";

import PartnersSections from "./partials/PartnersSections.vue";

import bg from "@/assets/img/shortcode/breadcumb.jpg";
import bg2 from "@/assets/img/about/video-bg.jpg";
import like from "@/assets/img/svg/like.svg";
import hand from "@/assets/img/svg/hand.svg";
import banner1 from "@/assets/img/about/about-banner-01.jpg";
import banner2 from "@/assets/img/about/about-banner-02.jpg";
import banner3 from "@/assets/img/about/about-banner-03.jpg";
import { features } from "@/data/data";
import repair from "@/assets/img/svg/repair.svg";
import Aos from "aos";
import { Head, Link } from "@inertiajs/vue3";

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
      <ul
        class="flex items-center justify-center gap-[10px] text-base md:text-lg leading-none font-normal text-white mt-3 md:mt-4"
      >
        <li><Link :href="route('public.home')">Home</Link></li>
        <li>/</li>
        <li class="text-primary">About</li>
      </ul>
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
            <div v-if="activeTab === 2">
              <img class="object-cover w-full" :src="banner2" alt="about" />
            </div>
            <div v-if="activeTab === 3">
              <img class="object-cover w-full" :src="banner3" alt="about" />
            </div>
          </div>
          <div
            class="absolute xl:bottom-[50%] bottom-0 left-[50%] xl:right-0 translate-x-[-50%] 2xl:translate-x-[83%] xl:translate-x-[73%] translate-y-[115%] xl:translate-y-[50%] z-[9999] xl:inline-block flex gap-1"
          >
            <div @click="activeTab = 1">
              <img
                class="object-cover h-[70px] w-[70px] md:h-[140px] md:w-[140px] lg:h-[140px] lg:w-[140px]"
                :class="activeTab === 1 ? 'border-[#bb976d] border-4' : ''"
                :src="banner1"
                alt="about"
              />
            </div>
            <div @click="activeTab = 2">
              <img
                class="object-cover h-[70px] w-[70px] md:h-[140px] md:w-[140px] lg:h-[140px] lg:w-[140px] xl:my-2 my-0"
                :class="activeTab === 2 ? 'border-[#bb976d] border-4' : ''"
                :src="banner2"
                alt="about"
              />
            </div>
            <div @click="activeTab = 3">
              <img
                class="object-cover h-[70px] w-[70px] md:h-[140px] md:w-[140px] lg:h-[140px] lg:w-[140px]"
                :class="activeTab === 3 ? 'border-[#bb976d] border-4' : ''"
                :src="banner3"
                alt="about"
              />
            </div>
          </div>
        </div>
        <div
          class="flex items-center py-8 sm:py-12 px-5 sm:px-12 md:px-8 lg:pr-12 lg:pl-16 2xl:pl-[160px] bg-[#F8F8F9] dark:bg-dark-secondary"
        >
          <div class="lg:max-w-[600px]">
            <div class="max-w-72">
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

  <div class="s-py-100">
    <PartnersSections />
  </div>
</template>

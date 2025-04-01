<script setup>
import { Swiper, SwiperSlide } from "swiper/vue";
import { Autoplay, Pagination, Navigation } from "swiper/modules";
import "swiper/swiper-bundle.css";
import "aos/dist/aos.css";
import banner1 from "@/assets/img/banner/fonemart.jpg";
import banner2 from "@/assets/img/banner/data-recovery.jpg";
</script>
<template>
  <swiper
    :modules="[Autoplay, Pagination]"
    :slides-per-view="1"
    :loop="true"
    :pagination="{ clickable: true }"
    :autoplay="{ delay: 30000 }"
    class="carousel-slider-four owl-carousel block"
  >
    <swiper-slide class="relative bg-[#F5F5F5] dark:bg-title">
      <div class="max-w-[1720px] mx-auto">
        <img class="w-full h-full object-cover" :src="banner1" alt="" />
      </div>
    </swiper-slide>
    <swiper-slide class="relative bg-[#F5F5F5] dark:bg-title">
      <div class="max-w-[1720px] mx-auto">
        <img class="w-full h-full object-cover" :src="banner2" alt="" />
      </div>
    </swiper-slide>
  </swiper>
</template>

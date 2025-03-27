<script setup>
import hand from "@/assets/img/svg/hand.svg";
import { Swiper, SwiperSlide } from "swiper/vue";
import { Autoplay } from "swiper/modules";
import "swiper/swiper-bundle.css";
import partner1 from "@/assets/img/brands/Apple-Logo.png";
import partner2 from "@/assets/img/brands/Samsung_logo.png";
import partner3 from "@/assets/img/brands/Motorola-Symbol.png";
import partner4 from "@/assets/img/brands/LG_symbol.svg.png";
import partner5 from "@/assets/img/brands/Asus-Logo-1995.png";
import partner6 from "@/assets/img/brands/Dell_Logo.svg.png";
import partner8 from "@/assets/img/brands/Xiaomi_logo_(2021-).svg.png";
import partner9 from "@/assets/img/brands/nokia-refreshed-logo-1_1.jpg";
import partner10 from "@/assets/img/brands/Huawei-logo.png";

const partnerData = [
  {
    image: partner1,
  },
  {
    image: partner2,
  },
  {
    image: partner3,
  },
  {
    image: partner4,
  },
  {
    image: partner5,
  },
  {
    image: partner6,
  },
  {
    image: partner8,
  },
  {
    image: partner9,
  },
  {
    image: partner10,
  },
];
</script>
<template>
  <div class="s-py-50-100">
    <div class="container-fluid">
      <div
        class="max-w-xl mx-auto mb-8 md:mb-12 text-center"
        data-aos="fade-up"
      ></div>
      <div data-aos="fade-up" data-aos-delay="100">
        <Swiper
          :modules="[Autoplay]"
          :slides-per-view="6"
          :autoplay="{ delay: 3000 }"
          :loop="true"
          :breakpoints="{
            320: { slidesPerView: 1, spaceBetween: 10 },
            576: { slidesPerView: 3, spaceBetween: 15 },
            1024: { slidesPerView: 4, spaceBetween: 20 },
            1140: { slidesPerView: 6, spaceBetween: 20 },
          }"
          class="max-w-[1720px] mx-auto owl-carousel home-v1-partner-slider flex items-center"
        >
          <swiper-slide
            v-for="(item, index) in partnerData"
            :key="index"
            class="flex items-center justify-center w-full"
            aria-label="partner logo"
          >
            <img :src="item.image" class="block" alt="" />
          </swiper-slide>
        </Swiper>
      </div>
    </div>
  </div>
</template>

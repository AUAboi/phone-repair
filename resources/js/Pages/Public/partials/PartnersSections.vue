<script setup>
import hand from "@/assets/img/svg/hand.svg";
import { Swiper, SwiperSlide } from "swiper/vue";
import { Autoplay } from "swiper/modules";
import "swiper/swiper-bundle.css";
import partner1 from "@/assets/img/partner/partner-1.svg";
import partner2 from "@/assets/img/partner/partner-2.svg";
import partner3 from "@/assets/img/partner/partner-3.svg";
import partner4 from "@/assets/img/partner/partner-4.svg";
import partner5 from "@/assets/img/partner/partner-5.svg";
import partner6 from "@/assets/img/partner/partner-6.svg";
import partner8 from "@/assets/img/partner/partner-8.svg";
import partner01 from "@/assets/img/partner/partner-light-1.svg";
import partner02 from "@/assets/img/partner/partner-light-2.svg";
import partner03 from "@/assets/img/partner/partner-light-3.svg";
import partner04 from "@/assets/img/partner/partner-light-4.svg";
import partner05 from "@/assets/img/partner/partner-light-5.svg";
import partner06 from "@/assets/img/partner/partner-light-6.svg";
import partner08 from "@/assets/img/partner/partner-light-8.svg";

const partnerData = [
  {
    image: partner1,
    image2: partner01,
  },
  {
    image: partner2,
    image2: partner02,
  },
  {
    image: partner3,
    image2: partner03,
  },
  {
    image: partner4,
    image2: partner04,
  },
  {
    image: partner5,
    image2: partner05,
  },
  {
    image: partner6,
    image2: partner06,
  },
  {
    image: partner8,
    image2: partner08,
  },
];
</script>
<template>
  <div class="s-py-50-100">
    <div class="container-fluid">
      <div
        class="max-w-xl mx-auto mb-8 md:mb-12 text-center"
        data-aos="fade-up"
      >
        <div>
          <img :src="hand" class="size-16 mx-auto" alt="" />
        </div>
        <h3 class="leading-none mt-4 md:mt-6 text-2xl md:text-3xl">
          Trusted Partner
        </h3>
        <p class="mt-3">
          Count on our trusted partnerships to deliver excellence. Collaborating
          with industry leaders ensures top-quality products and services for
          your satisfaction.
        </p>
      </div>
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
            <img :src="item.image" class="block dark:hidden" alt="" />
            <img :src="item.image2" class="hidden dark:block" alt="" />
          </swiper-slide>
        </Swiper>
      </div>
    </div>
  </div>
</template>

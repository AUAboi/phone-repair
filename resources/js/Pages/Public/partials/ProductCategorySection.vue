<script setup>
import chair from "@/assets/img/svg/chair.svg";
import { Swiper, SwiperSlide } from "swiper/vue";
import { Autoplay, Pagination, Navigation } from "swiper/modules";
import "swiper/swiper-bundle.css";
import product1 from "@/assets/img/home-v1/pdct-cgry-01.jpg";
import { Link } from "@inertiajs/vue3";

const props = defineProps(["categories"]);
</script>
<template>
  <div class="s-py-100-50 overflow-hidden">
    <div class="container-fluid">
      <div
        class="max-w-xl mx-auto mb-8 md:mb-12 text-center"
        data-aos="fade-up"
      >
        <div>
          <img :src="chair" alt="" class="mx-auto w-14 sm:w-24" />
        </div>
        <h3 class="leading-none mt-4 md:mt-6 text-2xl md:text-3xl">
          Product Category
        </h3>
        <p class="mt-3">
          Explore our curated selection of premium products, tailored to suit
          every need and taste. From essentials to indulgences, find your
          perfect fit.
        </p>
      </div>
      <div
        class="max-w-[1720px] mx-auto relative group"
        data-aos="fade-up"
        data-aos-delay="100"
      >
        <swiper
          :modules="[Autoplay, Navigation]"
          :slides-per-view="3"
          :space-between="20"
          :loop="true"
          :navigation="true"
          :autoplay="{ delay: 3000 }"
          :breakpoints="{
            320: { slidesPerView: 1, spaceBetween: 10 },
            576: { slidesPerView: 2, spaceBetween: 15 },
            1024: { slidesPerView: 3, spaceBetween: 20 },
          }"
          class="owl-carousel hv1-pdct-ctgry-slider block"
        >
          <swiper-slide
            v-for="(item, index) in categories"
            :key="index"
            class="relative block"
          >
            <Link
              :href="route('public.categoryProducts', { category: item.slug })"
            >
              <img
                class="w-full object-cover"
                :src="item.image ?? product1"
                alt="product"
              />
              <div
                class="absolute bottom-7 left-0 px-5 transform w-full flex justify-start"
              >
                <div class="p-[15px] bg-white dark:bg-title w-auto">
                  <span
                    class="md:text-xl text-primary font-medium leading-none"
                    >{{ item.products.length }}</span
                  >
                  <h4
                    class="text-xl md:text-2xl mt-[10px] font-semibold leading-[1.5]"
                  >
                    {{ item.name }}
                  </h4>
                </div>
              </div>
            </Link>
          </swiper-slide>
        </swiper>
      </div>
    </div>
  </div>
</template>

<script setup>
import { onMounted } from "vue";
import { Swiper, SwiperSlide } from "swiper/vue";
import { Autoplay } from "swiper/modules";
import "swiper/swiper-bundle.css";

import bg from "@/assets/img/shortcode/breadcumb.jpg";

import Aos from "aos";
import { Head, Link } from "@inertiajs/vue3";

onMounted(() => {
  Aos.init();
});

const props = defineProps(["posts"]);
</script>

<template>
  <Head title="Blogs" />
  <div>
    <div
      class="flex items-center gap-4 flex-wrap bg-overlay p-14 sm:p-16 before:bg-title before:bg-opacity-70"
      :style="{ backgroundImage: 'url(' + bg + ')' }"
    >
      <div class="text-center w-full">
        <h2
          class="text-white text-8 md:text-[40px] font-normal leading-none text-center"
        >
          Blog Post
        </h2>
        <ul
          class="flex items-center justify-center gap-[10px] text-base md:text-lg leading-none font-normal text-white mt-3 md:mt-4"
        >
          <li><Link :href="route('public.home')">Home</Link></li>
          <li>/</li>
          <li class="text-primary">Blog</li>
        </ul>
      </div>
    </div>

    <div class="s-py-100 overflow-hidden">
      <div class="container-fluid">
        <div class="max-w-[1720px] mx-auto mb-5 md:mb-6" data-aos="fade-up">
          <h3 class="font-medium leading-none text-2xl md:text-3xl">
            Featured Posts
          </h3>
        </div>
      </div>
      <div data-aos="fade-up" data-aos-delay="100">
        <Swiper
          :modules="[Autoplay]"
          :slides-per-view="1"
          :space-between="25"
          :loop="true"
          :autoplay="{ delay: 3000 }"
          :breakpoints="{
            320: { slidesPerView: 1, spaceBetween: 10 },
            576: { slidesPerView: 2, spaceBetween: 15 },
            1024: { slidesPerView: 3, spaceBetween: 25 },
          }"
          class="owl-carousel home-v2-blog block"
        >
          <SwiperSlide
            v-for="(item, index) in posts.slice(0, 6)"
            :key="index"
            class="relative group"
          >
            <Link
              :href="route('post.show', item.slug)"
              class="overflow-hidden block"
            >
              <img
                class="duration-300 transform scale-100 group-hover:scale-110 w-full"
                :src="item.image"
                alt="blog-card"
              />
            </Link>
            <div
              class="sm:bg-white sm:bg-opacity-90 sm:dark:bg-title sm:dark:bg-opacity-90 mt-4 sm:p-5 md:p-6 sm:absolute z-10 bottom-0 left-0 sm:w-11/12 max-w-md px-5 sm:px-0"
            >
              <ul class="flex items-center gap-[10px] flex-wrap">
                <li class="text-[15px] leading-none dark:text-white">
                  {{ item.formatted_date }}
                </li>
              </ul>
              <h5
                class="mt-3 font-medium dark:text-white leading-[1.5] text-xl"
              >
                <Link
                  :href="route('post.show', item.slug)"
                  class="text-underline"
                  >{{ item.title }}</Link
                >
              </h5>
            </div>
          </SwiperSlide>
        </Swiper>
      </div>
    </div>

    <div class="s-pb-100">
      <div class="container-fluid">
        <div class="max-w-[1720px] mx-auto">
          <h3
            class="font-medium leading-none text-2xl md:text-3xl mb-5 md:mb-6"
            data-aos="fade-up"
          >
            Latest Posts
          </h3>
          <div
            class="grid sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-5 gap-5 md:gap-[30px]"
            data-aos="fade-up"
            data-aos-delay="100"
          >
            <div v-for="(item, index) in posts" :key="index" class="group">
              <Link
                :href="route('post.show', item.slug)"
                class="overflow-hidden block"
              >
                <img
                  class="duration-300 transform scale-100 group-hover:scale-110 w-full"
                  :src="item.image"
                  alt="blog"
                />
              </Link>
              <div class="text-center mt-4 px-3">
                <ul
                  class="flex items-center justify-center gap-[10px] flex-wrap"
                >
                  <li class="text-[15px] leading-none dark:text-white">
                    {{ item.formatted_date }}
                  </li>
                </ul>
                <h5 class="mt-3 font-medium dark:text-white leading-[1.5]">
                  <Link
                    :href="route('post.show', item.slug)"
                    :to="`/blog-details-v1/${item.id}`"
                    class="text-underline"
                    >{{ item.title }}
                  </Link>
                </h5>
              </div>
            </div>
          </div>
          <!-- <div class="text-center mt-7 md:mt-12">
            <router-link to="#" class="btn btn-outline" data-text="Load More">
              <span>Load More</span>
            </router-link>
          </div> -->
        </div>
      </div>
    </div>
  </div>
</template>

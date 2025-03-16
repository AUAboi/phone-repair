<script setup>
import { Link } from "@inertiajs/vue3";

const props = defineProps(["brands"]);
</script>
<template>
  <div class="s-py-50-100">
    <div class="container-fluid">
      <div
        class="max-w-xl mx-auto mb-8 md:mb-12 text-center"
        data-aos="fade-up"
        data-aos-delay="100"
      >
        <div>
          <img :src="sofa" alt="" class="mx-auto w-14 sm:w-24" />
        </div>
        <h3 class="leading-none mt-4 md:mt-6 text-2xl md:text-3xl">Brands</h3>
        <p class="mt-3">
          Be the first to experience innovation with our latest arrivals. Stay
          ahead of the curve and discover what's new in style, technology, and
          more.
        </p>
      </div>
      <div data-aos="fade-up" data-aos-delay="100">
        <div
          class="max-w-[1720px] mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 sm:gap-8"
        >
          <div
            v-for="(item, index) in brands"
            :key="index"
            class="group flex flex-col justify-between"
          >
            <div class="relative overflow-hidden">
              <Link :href="route('public.repairs.brand', item.slug)">
                <img
                  class="w-full transform group-hover:scale-110 duration-300"
                  :src="item.image"
                  alt="shop"
                />
              </Link>
            </div>
            <div
              class="md:px-2 lg:px-4 xl:px-6 lg:pt-6 pt-5 flex gap-4 md:gap-5 flex-col"
            >
              <div>
                <h5 class="font-normal dark:text-white text-xl leading-[1.5]">
                  <Link
                    :href="route('public.repairs.brand', item.slug)"
                    class="text-underline"
                  >
                    {{ item.name }}
                  </Link>
                </h5>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="text-center mt-7 md:mt-12">
        <Link
          :href="route('public.repairs')"
          class="btn btn-outline"
          data-text="All Brands"
        >
          <span>All Brands</span>
        </Link>
      </div>
    </div>
  </div>
</template>

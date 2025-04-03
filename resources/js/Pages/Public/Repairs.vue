<script setup>
import { Head, Link } from "@inertiajs/vue3";
import DeviceSection from "./partials/DeviceSection.vue";
import bg from "@/assets/img/banner/header 2.jpg";

const props = defineProps(["brands", "devices"]);
</script>

<template>
  <Head title="Repairs" />
  <div
    class="flex items-center gap-4 flex-wrap bg-overlay p-14 sm:p-16 before:bg-title before:bg-opacity-70"
    :style="{ backgroundImage: 'url(' + bg + ')' }"
  >
    <div class="text-center w-full">
      <h2
        class="text-white text-8 md:text-[40px] font-normal leading-none text-center"
      >
        Book a repair
      </h2>
      <ul
        class="flex items-center justify-center gap-[10px] text-base md:text-lg leading-none font-normal text-white mt-3 md:mt-4"
      >
        <li><Link :href="route('public.home')">Home</Link></li>
        <li>/</li>
        <li class="text-primary">Repairs</li>
      </ul>
    </div>
  </div>

  <DeviceSection :brands="brands" />

  <section v-if="brands.length" class="my-14">
    <div class="container mx-auto px-5 py-12">
      <h4 class="text-6xl text-center font-bold pb-6">Devices available</h4>
    </div>
    <div
      :classList="'max-w-[1720px] mx-auto grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5 sm:gap-8 pt-8 md:pt-[50px]'"
    >
      <div v-for="(item, index) in devices" :key="index" class="group">
        <div class="relative">
          <Link
            :href="route('public.appointments.create', { device: item.slug })"
          >
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
                :href="
                  route('public.appointments.create', { device: item.slug })
                "
                class="text-underline"
              >
                {{ item.name }}
              </Link>
            </h5>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

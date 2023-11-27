<script setup>
import ActionButton from "@/Components/ActionButton.vue";
import { Head, Link } from "@inertiajs/vue3";
import "vue3-carousel/dist/carousel.css";
import { Carousel, Navigation, Pagination, Slide } from "vue3-carousel";
import BannerSlideshow from "./partials/BannerSlideshow.vue";

const props = defineProps(["brands"]);

const settings = {
  itemsToShow: 1,
  snapAlign: "center",
};

const breakpoints = {
  700: {
    itemsToShow: 2,
    snapAlign: "center",
  },
  1024: {
    itemsToShow: 3,
    snapAlign: "start",
  },
};
</script>

<template>
  <Head title="Repairs" />
  <BannerSlideshow />
  <section v-if="brands.length" class="my-14">
    <div class="container mx-auto px-5 py-12">
      <h4 class="text-6xl text-center font-bold pb-6">Brands We Offer</h4>
      <p class="text-center">We offer a variety of brands</p>
      <div>
        <Carousel :breakpoints="breakpoints" :settings="settings">
          <Slide v-for="brand in brands" :key="brand.id">
            <div class="cursor-pointer text-center flex flex-col h-full">
              <div>
                <img
                  class="w-52 rounded-2xl mx-auto"
                  :src="brand.image"
                  :alt="brand.name"
                />
              </div>
              <h4 class="text-lg mt-auto font-semibold pt-4">
                {{ brand.name }}
              </h4>
              <ActionButton :href="route('public.repairs.brand', brand.slug)">
                Book Now
              </ActionButton>
            </div>
          </Slide>

          <template #addons>
            <Navigation />
            <Pagination />
          </template>
        </Carousel>
      </div>
    </div>
  </section>
  <section v-if="brands.length" class="my-14">
    <div class="container mx-auto px-5 py-12">
      <h4 class="text-6xl text-center font-bold pb-6">Devices available</h4>
      <div v-for="(brand, i) in brands" :key="brand.id" class="mt-16">
        <div v-if="brand.devices.length">
          <h3 class="text-xl text-red-600 font-semibold text-center pb-8">
            {{ brand.name }}
          </h3>
          <div>
            <Carousel :breakpoints="breakpoints" :settings="settings">
              <Slide v-for="(device, j) in brand.devices" :key="device.id">
                <div class="cursor-pointer text-center flex flex-col h-full">
                  <div>
                    <img
                      class="w-52 rounded-2xl mx-auto"
                      :src="device.image"
                      :alt="device.name"
                    />
                  </div>
                  <h4 class="text-lg mt-auto font-semibold pt-4">
                    {{ device.name }}
                  </h4>
                  <ActionButton
                    :href="route('public.appointments.create', device.slug)"
                  >
                    Book Now
                  </ActionButton>
                </div>
              </Slide>

              <template #addons>
                <Navigation />
                <Pagination />
              </template>
            </Carousel>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

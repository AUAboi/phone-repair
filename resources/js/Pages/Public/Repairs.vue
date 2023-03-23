<script setup>
import ActionButton from "@/Components/ActionButton.vue";
import { Head, Link } from "@inertiajs/vue3";
import "vue3-carousel/dist/carousel.css";
import { Carousel, Navigation, Pagination, Slide } from "vue3-carousel";

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
  <section class="bg-red-100 py-8">
    <div
      class="flex flex-col-reverse sm:grid sm:grid-cols-2 items-center px-4 max-w-4xl mx-auto gap-6"
    >
      <div>
        <h3
          class="text-red-600 font-semibold text-4xl text-center sm:text-left"
        >
          Repairs
        </h3>
        <p>
          Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente rem
          reiciendis, tempore magnam cupiditate possimus at, esse ea
          exercitationem voluptates ad iste architecto distinctio laborum,
          aliquam sit voluptas accusamus reprehenderit!
        </p>
      </div>
      <div class="mx-auto">
        <img src="/images/phones.webp" />
      </div>
    </div>
  </section>
  <section class="my-14">
    <div class="container mx-auto px-5 py-12">
      <h4 class="text-6xl text-center font-bold pb-6">Brands We Offer</h4>
      <p class="text-center">We offer a variety of brands</p>
      <div
        class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 max-w-3xl mx-auto"
      >
        <div
          class="flex flex-col gap-4 items-center"
          v-for="brand in brands"
          :key="brand.id"
        >
          <img
            width="300"
            height="400"
            class="w-64 h-56"
            :src="brand.image"
            :alt="brand.name"
          />
          <h4 class="text-4xl text-fuchsia-900">{{ brand.name }}</h4>
          <ActionButton :href="route('public.repairs.brand', brand.slug)">
            Book Now
          </ActionButton>
        </div>
      </div>
    </div>
  </section>
  <section class="my-14">
    <div class="container mx-auto px-5 py-12">
      <h4 class="text-6xl text-center font-bold pb-6">Devices available</h4>
      <div class="mb-12" v-for="brand in brands" :key="brand.id">
        <div v-if="brand.devices.length">
          <h3 class="text-4xl text-center md:text-start font-bold pb-6">
            {{ brand.name }}
          </h3>

          <Carousel autoplay :breakpoints="breakpoints" :settings="settings">
            <Slide
              class="w-80"
              v-for="device in brand.devices"
              :key="device.id"
            >
              <div class="flex flex-col gap-4 items-center">
                <img
                  width="300"
                  height="400"
                  class="w-64 h-56"
                  :src="device.image"
                  :alt="device.name"
                />
                <h4 class="text-4xl text-fuchsia-900">{{ device.name }}</h4>
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
  </section>
</template>

<style>
.carousel__prev,
.carousel__next {
  display: none;
}

.carousel__pagination-button--active::after {
  @apply bg-red-500;
}
</style>

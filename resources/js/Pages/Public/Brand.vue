<script setup>
import ActionButton from "@/Components/ActionButton.vue";
import { Head } from "@inertiajs/vue3";
import { Carousel, Navigation, Pagination, Slide } from "vue3-carousel";
import "vue3-carousel/dist/carousel.css";

const props = defineProps({
  brand: {
    required: true,
    type: Object,
  },
});

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
  <Head :title="`${brand.name} Repairs`" />
  <section class="bg-blue-50 pb-9 pt-36">
    <div
      class="flex flex-col-reverse sm:grid sm:grid-cols-2 items-center px-4 max-w-4xl mx-auto"
    >
      <div>
        <h3
          class="text-red-600 font-semibold text-4xl sm:text-5xl text-center sm:text-left"
        >
          {{ brand.name }} Repairs
        </h3>
      </div>
      <div class="mx-auto">
        <img :src="brand.image" :alt="brand.name" />
      </div>
    </div>
  </section>

  <section v-if="brand.devices.length" class="px-2 py-4 container mx-auto">
    <h4
      class="text-red-600 font-semibold text-4xl sm:text-6xl text-center my-8"
    >
      Choose your device
    </h4>
    <Carousel
      :wrap-around="true"
      :breakpoints="breakpoints"
      :settings="settings"
    >
      <Slide v-for="device in brand.devices" :key="device.id">
        <div class="cursor-pointer text-center flex flex-col h-full">
          <div>
            <img
              class="w-60 rounded-2xl mx-auto"
              :src="device.image"
              :alt="device.name"
            />
          </div>
          <h4 class="text-lg font-semibold pt-4 mt-auto">{{ device.name }}</h4>
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
  </section>
  <section v-else>
    <h4 class="text-red-600 font-semibold text-lg sm:text-xl text-center my-8">
      No device available
    </h4>
  </section>
</template>

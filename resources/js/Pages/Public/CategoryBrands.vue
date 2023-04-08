<script setup>
import ActionButton from "@/Components/ActionButton.vue";
import { Head } from "@inertiajs/vue3";

const props = defineProps({
  brands: {
    required: true,
    type: Array,
  },
  deviceCategory: {
    required: true,
    type: String,
  },
});
</script>

<template>
  <Head
    :title="`${
      deviceCategory[0].toUpperCase() + deviceCategory.slice(1).toLowerCase()
    } Repairs`"
  />
  <section class="bg-blue-50 pb-9 pt-36">
    <div
      class="flex flex-col-reverse sm:grid sm:grid-cols-2 items-center px-4 max-w-4xl mx-auto"
    >
      <div>
        <h3
          class="text-red-600 font-semibold text-4xl sm:text-5xl text-center sm:text-left capitalize"
        >
          {{ deviceCategory }} Repairs
        </h3>
      </div>
      <div class="mx-auto">
        <img :src="`/images/${deviceCategory}.webp`" :alt="deviceCategory" />
      </div>
    </div>
  </section>

  <section v-if="brands.length" class="px-2 py-4 container mx-auto">
    <h4
      class="text-red-600 font-semibold text-4xl sm:text-6xl text-center my-8"
    >
      Choose your device
    </h4>
    <div
      class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 max-w-6xl mx-auto"
    >
      <div
        class="cursor-pointer text-center"
        v-for="(brand, index) in brands"
        :key="index"
      >
        <div>
          <img
            class="h-64 w-52 rounded-2xl mx-auto"
            :src="brand.image"
            :alt="brand.name"
          />
        </div>
        <h4 class="text-lg font-semibold py-4">{{ brand.name }}</h4>
        <ActionButton :href="route('public.repairs.brand', brand.slug)">
          Book Now
        </ActionButton>
      </div>
    </div>
  </section>
  <section v-else>
    <h4 class="text-red-600 font-semibold text-lg sm:text-xl text-center my-8">
      No device available
    </h4>
  </section>
</template>

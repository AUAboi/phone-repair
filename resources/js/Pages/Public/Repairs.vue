<script setup>
import ActionButton from "@/Components/ActionButton.vue";
import { Head, Link } from "@inertiajs/vue3";
import BannerSlideshow from "./partials/BannerSlideshow.vue";

const props = defineProps(["brands"]);
</script>

<template>
  <Head title="Repairs" />
  <BannerSlideshow />
  <section v-if="brands.length" class="my-14">
    <div class="container mx-auto px-5 py-12">
      <h4 class="text-6xl text-center font-bold pb-6">Brands We Offer</h4>
      <p class="text-center">We offer a variety of brands</p>
    </div>
  </section>
  <section v-if="brands.length" class="my-14">
    <div class="container mx-auto px-5 py-12">
      <h4 class="text-6xl text-center font-bold pb-6">Devices available</h4>
    </div>
  </section>
</template>

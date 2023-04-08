<script setup>
import ActionButton from "@/Components/ActionButton.vue";
import { Head, Link } from "@inertiajs/vue3";
import BannerSlideshow from "./partials/BannerSlideshow.vue";
import ProductsSection from "./partials/ProductsSection.vue";

const props = defineProps(["brands", "categories"]);
</script>

<template>
  <Head title="Welcome" />
  <BannerSlideshow />
  <ProductsSection :categories="categories" />
  <section
    style="background-image: url('images/bg_06.jpg')"
    class="bg-cover bg-fixed bg-no-repeat bg-center relative"
  >
    <div class="bg-[#f2f2f2] bg-opacity-50 absolute w-full h-full top-0"></div>
    <div class="container mx-auto py-28 relative z-50">
      <div class="grid grid-cols-1 md:grid-cols-2 items-center">
        <div class="p-4">
          <img src="images/featured.webp" width="700" height="400" />
        </div>
        <div class="text-center md:text-start md:pl-8">
          <h2 class="font-semibold text-4xl sm:text-6xl">Why us?</h2>
          <p class="text-lg">
            Fonemart is where you can find telephones experts. With our long
            periods of involvement with fixing telephones, you can rely upon us.
            We never let our clients down since telephone, tablet and fix is our
            specialty. When the client comprehends what we bring to the table in
            the entirety of our maintenance administrations, you can relax
            realizing that you settled on the ideal decision.
          </p>
          <Link
            class="btn-action text-white text-xl bg-red-600 px-8 py-4 mt-6"
            :href="route('public.products')"
          >
            Book Repair
          </Link>
        </div>
      </div>
    </div>
  </section>

  <section class="my-14">
    <h2 class="text-red-600 text-center text-4xl font-bold">Brands we offer</h2>
    <div
      class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 max-w-3xl mx-auto my-8"
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
        <h4 class="text-4xl text-fuchsia-900 text-center">{{ brand.name }}</h4>
        <ActionButton :href="route('public.repairs.brand', brand.slug)">
          Book Now
        </ActionButton>
      </div>
    </div>
  </section>
</template>

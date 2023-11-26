<script setup>
import ActionButton from "@/Components/ActionButton.vue";
import { Head, Link } from "@inertiajs/vue3";
import BannerSlideshow from "./partials/BannerSlideshow.vue";
import ProductsSection from "./partials/ProductsSection.vue";
import PostSection from "@/Components/PostSection.vue";

const props = defineProps(["brands", "categories", "posts"]);
</script>

<template>
  <Head title="Welcome" />
  <BannerSlideshow />
  <section class="my-12">
    <h2 class="text-red-600 text-center text-4xl font-bold">
      Devices and brands we repair
    </h2>
    <div
      class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 max-w-3xl mx-auto my-8"
    >
      <div class="flex flex-col gap-4 items-center">
        <img
          width="300"
          height="250"
          class="w-64 h-52"
          src="images/mobile.webp"
        />
        <h4 class="text-4xl text-fuchsia-900 text-center">
          Smartphone Repairs
        </h4>
        <ActionButton :href="route('public.categoryBrands', 'mobile')">
          Book Now
        </ActionButton>
      </div>
      <div class="flex flex-col gap-4 items-center">
        <img
          width="300"
          height="250"
          class="w-64 h-52"
          src="images/tablet.webp"
        />
        <h4 class="text-4xl text-fuchsia-900 text-center">
          iPad-Tablets Repairs
        </h4>
        <ActionButton :href="route('public.categoryBrands', 'tablet')">
          Book Now
        </ActionButton>
      </div>
      <div class="flex flex-col gap-4 items-center">
        <img
          width="300"
          height="250"
          class="w-64 h-52"
          src="images/laptop.webp"
        />
        <h4 class="text-4xl text-fuchsia-900 text-center">
          MacBook-Laptop Repairs
        </h4>
        <ActionButton :href="route('public.categoryBrands', 'laptop')">
          Book Now
        </ActionButton>
      </div>
    </div>
  </section>
  <section
    style="background-image: url('images/bg_06.jpg')"
    class="bg-cover bg-fixed bg-no-repeat bg-center relative"
  >
    <div class="bg-[#f2f2f2] bg-opacity-50 absolute w-full h-full top-0"></div>
    <div class="container mx-auto py-28 relative">
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
  <ProductsSection :categories="categories" />
  <h4 class="text-6xl text-center font-bold">Check out our blogs</h4>
  <PostSection :posts="posts" />
</template>

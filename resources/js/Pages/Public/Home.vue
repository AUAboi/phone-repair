<script setup >
import ActionButton from '@/Components/ActionButton.vue';
import { Head, Link } from '@inertiajs/vue3';
import DeviceSection from './partials/DeviceSection.vue';

const props = defineProps(['brands'])
</script>

<template>
  <Head title="Welcome" />
  <section>
    <Link :href="route('public.repairs')" class="banner block">
    </Link>
  </section>
  <DeviceSection :brands="brands" />
  <section class="bg-blue-200 py-12 px-2">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 md:gap-4 justify-items-center max-w-7xl mx-auto">
      <div class=" ">
        <div class="bg-white text-center h-64 w-64 pt-12 text-5xl rounded-md shadow-2xl mx-auto">
          <img class="w-24 mx-auto" src="images/CROSS.avif" alt="">
          <p class="font-bold">
            Repair
          </p>
          <div class="mt-7">
            <ActionButton :href="route('public.repairs')">
              Learn More
            </ActionButton>
          </div>
        </div>
      </div>
      <div class="">
        <div class="bg-fuchsia-200 text-center h-64 w-64 pt-12 text-5xl rounded-md shadow-2xl mx-auto">
          <img class="w-24 mx-auto" src="images/multi_cross.avif" alt="">
          <p class="font-bold">
            Replace
          </p>
          <div class="mt-7">
            <ActionButton>
              Learn More
            </ActionButton>
          </div>
        </div>
      </div>
      <div class="">
        <div style="background-color: #290A38;"
          class="text-center h-64 w-64 pt-12 text-5xl rounded-md shadow-2xl mx-auto">
          <img class="w-24 mx-auto" src="images/cross_bg.avif" alt="">
          <p class="text-white font-bold">
            Protect
          </p>
          <div class="mt-7">
            <ActionButton>
              Learn More
            </ActionButton>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="my-14">
    <h2 class="text-pink-500 text-center text-4xl font-bold">Brands we offer</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 max-w-3xl mx-auto my-8">
      <div class="flex flex-col gap-4 items-center" v-for="brand in brands" :key="brand.id">
        <img width="300" height="400" class="w-64 h-56" :src="brand.image" :alt="brand.name">
        <h4 class="text-4xl text-fuchsia-900">{{ brand.name }}</h4>
        <ActionButton :href="route('public.repairs.brand', brand.slug)">
          Book Now
        </ActionButton>

      </div>
    </div>

  </section>
</template>

<style scoped>
.banner {
  background-image: url("/images/slide_1.webp");
  background-size: cover;
  background-repeat: no-repeat;
  padding: 16rem 2rem;
}



@media screen and (max-width: 1380px) {
  .banner {
    padding: 10rem 2rem;
  }

}

@media screen and (max-width: 860px) {
  .banner {
    background-image: url("/images/slide_mobile_1.webp");
    height: 400px;
    background-position: 50% 50%;
    padding: 0;
    background-size: cover;

  }
}
</style>
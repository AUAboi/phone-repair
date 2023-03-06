<script setup >
import ActionButton from '@/Components/ActionButton.vue';
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps(['brands'])
</script>

<template>
  <Head title="Welcome" />
  <section>
    <Link :href="route('public.repairs')" class="banner block">
    </Link>
  </section>
  <section class="text-gray-600 body-font">
    <div class="container mx-auto flex px-5 py-24 md:flex-row flex-col items-center">
      <div
        class="lg:flex-grow md:w-1/2 lg:pr-24 md:pr-16 flex flex-col md:items-start md:text-left mb-16 md:mb-0 items-center text-center">
        <h1 class="title-font sm:text-4xl text-3xl mb-4 font-medium text-gray-900">Before they sold out
          <br class="hidden lg:inline-block">readymade gluten
        </h1>
        <p class="mb-8 leading-relaxed">Copper mug try-hard pitchfork pour-over freegan heirloom neutra air plant
          cold-pressed tacos poke beard tote bag. Heirloom echo park mlkshk tote bag selvage hot chicken authentic
          tumeric truffaut hexagon try-hard chambray.</p>
        <div class="flex justify-center">
          <button
            class="inline-flex text-white bg-pink-500 border-0 py-2 px-6 focus:outline-none hover:bg-pink-600 rounded text-lg">Button</button>
          <button
            class="ml-4 inline-flex text-gray-700 bg-gray-100 border-0 py-2 px-6 focus:outline-none hover:bg-gray-200 rounded text-lg">Button</button>
        </div>
      </div>
      <div class="lg:max-w-lg lg:w-full md:w-1/2 w-5/6">
        <img class="object-cover object-center rounded mx-auto" alt="hero" src="/images/hero.avif">
      </div>
    </div>
  </section>
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
        <img width="300" height="400" class="w-64 h-54" :src="brand.image" :alt="brand.name">
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
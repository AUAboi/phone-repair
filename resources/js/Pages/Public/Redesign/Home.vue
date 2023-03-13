<script setup >
import ActionButton from '@/Components/ActionButton.vue';
import SectionHeading from '@/Components/SectionHeading.vue';
import { Head, Link } from '@inertiajs/vue3';
import IconEmail from "~icons/mdi/email"
import 'vue3-carousel/dist/carousel.css'
import { Carousel, Slide, Pagination, Navigation } from 'vue3-carousel'


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
  <section class="max-w-7xl mx-auto mt-16">
    <SectionHeading>
      <template #heading>
        Brands
      </template>
      <template #subheading>
        List of the brands
      </template>
    </SectionHeading>
    <Carousel :items-to-show="3">
      <Slide class="w-80" v-for="brand in brands" :key="brand.id">
        <div class="flex flex-col bg-gray-200 card">
          <div class="h-80">
            <img class="h-full w-full" :src="brand.image" :alt="brand.name">
          </div>
          <div class="px-2 py-1 text-start">
            <h4 class="text-3xl uppercase font-semibold">{{ brand.name }}</h4>
            <Link as="button" :href="route('public.repairs.brand', brand.slug)">
            Book Now
            </Link>
          </div>

        </div>
      </Slide>
      <template #addons>
        <Navigation />
        <Pagination />
      </template>
    </Carousel>
  </section>
  <section class="bg-gray-300 py-28">
    <div class="container mx-auto">
      <div class="flex justify-between items-center">
        <div class="text-6xl font-semibold flex flex-shrink-0 flex-grow-0 basis-5/12">
          <IconEmail />
          <h2 class="">Join Our Newsletter Now
          </h2>
        </div>
        <div class="h-full">
          <input class="border-none w-64 h-14" type="text">
          <ActionButton class="px-10 text-2xl ">SUBSCRIBE</ActionButton>
        </div>
      </div>
    </div>

  </section>
</template>


<style scoped>
.card:hover {
  @apply cursor-pointer;
}

.card h4 {
  @apply transition-colors duration-500;
}

.card:hover h4 {
  @apply text-red-500;
}
</style>
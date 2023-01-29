<script setup >
import { Head, Link } from '@inertiajs/vue3';

</script>

<template>

  <Head title="Welcome" />
  <section>
    <Link href="/cat" class="banner block">
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
  <section class="bg-blue-200 py-4 px-2">
    <div class="grid grid-cols-3 justify-items-center gap-4">
      <div class="w-2/3 ">
        <div class="bg-white text-5xl flex flex-col justify-center items-center px-4 py-6 rounded-md shadow-xl">
          <img class="w-24" src="images/CROSS.avif" alt="">
          <p class="font-bold">
            Repair
          </p>
        </div>

      </div>
      <div class="w-2/3">
        <div class="bg-fuchsia-200 text-5xl flex flex-col justify-center items-center px-4 py-6 rounded-md shadow-xl">
          <img class="w-24" src="images/multi_cross.avif" alt="">
          <p class="font-bold">
            Replace
          </p>
        </div>

      </div>
      <div class="w-2/3">
        <div style="background-color: #290A38;"
          class="text-5xl flex flex-col justify-center items-center px-4 py-6 rounded-md shadow-xl">
          <img class="w-24" src="images/cross_bg.avif" alt="">
          <p class="text-white font-bold">
            Protect
          </p>
        </div>
      </div>
    </div>
  </section>
</template>

<style scoped>
.banner {
  background-image: url("/images/slide_1.webp");
  background-size: cover;
  background-repeat: no-repeat;
  padding: 10rem 2rem;
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
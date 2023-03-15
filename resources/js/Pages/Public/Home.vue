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
  <section class="bg-cover bg-no-repeat bg-center py-28" style="background-image: url('images/bg_06.jpg');">
    <div class="container mx-auto">
      <div class="grid grid-cols-1 md:grid-cols-2 items-center">
        <div class="p-4">
          <img target="_blank" style="height:400px;width:700px;border:solid 1px #000; background: #faaeae;" src=" #"
            width="700" height="400" />

        </div>
        <div class="text-center md:text-start pl-8">
          <h2 class="font-semibold text-4xl sm:text-6xl">Some featured text can come here</h2>
          <p class="text-lg">
            The main thing about dad jeans is that they come in a trendy wider straight leg, have a total slouchier fit
            and
            a high rise. Whereas the mom jean is a more fitted style with baggier and tapered legs.
          </p>
          <Link class="btn-action text-white text-xl bg-red-600 px-8 py-4 mt-6" href="/somelink">
          Some button
          text
          </Link>
        </div>
      </div>

    </div>
  </section>

  <section class="my-14">
    <h2 class="text-red-600 text-center text-4xl font-bold">Brands we offer</h2>
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
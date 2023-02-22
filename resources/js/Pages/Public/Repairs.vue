<script setup>
import ActionButton from '@/Components/ActionButton.vue';
import { Head } from '@inertiajs/vue3';

const props = defineProps(['brands', 'devices'])
</script>

<template>
  <Head title="Repairs" />
  <section class="bg-pink-100 py-8">
    <div class="flex flex-col-reverse sm:grid sm:grid-cols-2 items-center px-4 max-w-4xl mx-auto gap-6">
      <div>
        <h3 class="text-pink-600 font-semibold text-4xl text-center sm:text-left"> Repairs</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente rem reiciendis, tempore magnam cupiditate
          possimus at, esse ea exercitationem voluptates ad iste architecto distinctio laborum, aliquam sit voluptas
          accusamus reprehenderit!</p>
      </div>
      <div class="mx-auto">
        <img src="/images/phones.webp">
      </div>
    </div>
  </section>
  <section class="my-14">
    <h2 class="text-pink-500 text-center text-4xl font-bold">Brands we offer</h2>
    <p class="text-center">We offer a variety of brands</p>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3  gap-6 max-w-3xl mx-auto">
      <div class="flex flex-col gap-4 items-center" v-for="brand in brands" :key="brand.id">
        <img width="300" height="400" class="w-64" :src="brand.image" :alt="brand.name">
        <h4 class="text-4xl text-fuchsia-900">{{ brand.name }}</h4>
        <ActionButton :href="route('public.repairs.brand', brand.slug)">
          Book Now
        </ActionButton>

      </div>
    </div>

  </section>
  <section class="my-14">
    <h2 class="text-pink-500 text-center text-4xl font-bold">Choose device</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3  gap-6 max-w-3xl mx-auto">
      <div class="flex flex-col gap-4 items-center" v-for="device in devices" :key="device.id">
        <img width="300" height="400" class="w-64" :src="device.image" :alt="device.name">
        <h4 class="text-4xl text-fuchsia-900">{{ device.name }}</h4>
        <ActionButton :href="route('public.appointments.create', device.slug)">
          Book Now
        </ActionButton>

      </div>
    </div>

  </section>
</template>
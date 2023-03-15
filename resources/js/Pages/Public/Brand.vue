<script setup>
import ActionButton from '@/Components/ActionButton.vue';
import { Head } from '@inertiajs/vue3';


const props = defineProps({
  brand: {
    required: true,
    type: Object
  }
})
</script>

<template>
  <Head :title="`${brand.name} Repairs`" />
  <section class="bg-blue-50 py-8">
    <div class="flex flex-col-reverse sm:grid sm:grid-cols-2 items-center px-4 max-w-4xl mx-auto">
      <div>
        <h3 class="text-red-600 font-semibold text-4xl text-center sm:text-left">{{ brand.name }} Repairs</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente rem reiciendis, tempore magnam cupiditate
          possimus at, esse ea exercitationem voluptates ad iste architecto distinctio laborum, aliquam sit voluptas
          accusamus reprehenderit!</p>
      </div>
      <div class="mx-auto">
        <img :src="brand.image" :alt="brand.name">
      </div>
    </div>
  </section>
  <section class="px-2 py-4">
    <h4 class="text-red-600 font-semibold text-2xl text-center">Choose your device</h4>
    <div class="flex flex-wrap justify-center items-center">
      <div class="flex flex-col gap-4 items-center" v-for="device in brand.devices" :key="device.id">
        <img width="300" height="400" class="w-64" :src="device.image" :alt="device.name">
        <h4 class="text-4xl text-fuchsia-900">{{ device.name }}</h4>
        <ActionButton :href="route('public.appointments.create', device.slug)">
          Book Now
        </ActionButton>
      </div>
    </div>
  </section>
</template>


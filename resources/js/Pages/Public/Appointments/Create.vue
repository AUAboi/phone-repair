<script setup>
import { Head } from '@inertiajs/vue3';


const props = defineProps(["device", "repairs"])
</script>

<template>

  <Head :title="`Book ${props.device.name} repair`" />
  {{ device }}

  <div class="my-6 flex gap-8 flex-wrap justify-center max-w-2xl mx-auto">
    <div
      class="bg-blue-50 border-2 border-blue-300 rounded-md transition-colors duration-300 hover:border-fuchsia-700 w-32 drop-shadow-md shadow-gray-400 cursor-pointer"
      v-for="repair in device.device_repairs" :key="repair.id">
      <img class="w-5/6 mx-auto" :src="repair.image" :alt="repair.title">
      <p class="text-center">
        {{ repair.repair_type }}
      </p>
    </div>
    <div
      class="bg-blue-50 border-2 border-blue-300 rounded-md transition-colors duration-300 hover:border-fuchsia-700 w-32 drop-shadow-md shadow-gray-400 cursor-pointer">
      <img class="w-5/6 mx-auto" src="/images/question.webp" alt="repair.title">
      <p class="text-center">
        I dont know
      </p>
    </div>
  </div>
</template>
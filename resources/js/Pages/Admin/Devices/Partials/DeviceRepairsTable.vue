<script setup>
import DataTable from '@/Components/DataTable.vue';
import { Link } from '@inertiajs/inertia-vue3';

const props = defineProps({
  repairs: {
    required: true,
    type: Object

  }
})

const labels = [
  {
    key: 'title',
    value: 'Title'
  },
  {
    key: 'price',
    value: 'Price'
  }
]


</script>

<template>
  <header>
    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">Phone Repairs</h2>
    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400"> Available Repairs for phone</p>
  </header>

  <div class="flex items-center gap-4 md:gap-0 justify-between mt-4">
    <Link :href="route('devices.create')" as="button" class="btn--primary ml-auto">Add <span class="hidden md:inline">
      Device</span></Link>
  </div>

  <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
    <div class=" text-gray-900 dark:text-gray-100">
      <DataTable :table-data="repairs" :labels="labels" />
    </div>
  </div>
</template>
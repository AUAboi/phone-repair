<script setup>
import DataTable from '@/Components/DataTable.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';


const data = [
  {
    name: "test",

  }
]

const labels = [
  {
    key: "name",
    value: "Name"
  }
]
</script>
<template>

  <Head title="Brands" />
  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Brands</h2>
    </template>
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
          <div class=" text-gray-900 dark:text-gray-100">
            <DataTable :table-data="data" :labels="labels" />
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
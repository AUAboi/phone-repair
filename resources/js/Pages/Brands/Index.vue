<script setup>
import DataTable from '@/Components/DataTable.vue';
import SearchBox from '@/Components/SearchBox.vue';
import Paginator from '@/Components/Paginator.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';
import { reactive } from '@vue/reactivity';

const props = defineProps({
  brands: {
    required: true,
    type: Object

  },
  filters: {
    required: true,
    type: Object
  }
})
const labels = [
  {
    key: 'name',
    value: 'Name'
  }
]
const form = reactive({
  search: props.filters.search,
})

const reset = () => {
  form.search = null;
}
</script>
<template>

  <Head title="Brands" />
  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Brands</h2>
    </template>
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row items-center">
          <SearchBox class="w-full max-w-md my-4" v-model="form.search" @reset="reset" />

        </div>

        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
          <div class=" text-gray-900 dark:text-gray-100">
            <DataTable :table-data="brands.data" :labels="labels" />
          </div>
          <Paginator :links="brands.links" />
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
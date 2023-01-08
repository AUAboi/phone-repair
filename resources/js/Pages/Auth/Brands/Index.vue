<script setup>
import DataTable from '@/Components/DataTable.vue';
import SearchBox from '@/Components/SearchBox.vue';
import Paginator from '@/Components/Paginator.vue';
import PageHeader from '@/Components/PageHeader.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import { reactive } from '@vue/reactivity';
import PrimaryButton from '@/Components/PrimaryButton.vue';

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

  <PageHeader>Brands</PageHeader>
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="flex items-center gap-4 md:gap-0 justify-between">
        <SearchBox class="w-full max-w-md my-4" v-model="form.search" @reset="reset" />
        <Link :href="route('brands.create')" as="button" class="btn--primary">Create <span class="hidden md:inline">
          Brand</span></Link>
      </div>

      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class=" text-gray-900 dark:text-gray-100">
          <DataTable :table-data="brands.data" :labels="labels" />
        </div>
        <Paginator :links="brands.links" />
      </div>
    </div>
  </div>
</template>
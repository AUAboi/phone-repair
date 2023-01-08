<script setup>
import DataTable from '@/Components/DataTable.vue';
import SearchBox from '@/Components/SearchBox.vue';
import Paginator from '@/Components/Paginator.vue';
import PageHeader from '@/Components/PageHeader.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import { reactive } from '@vue/reactivity';
import throttle from "lodash/throttle";
import pickBy from "lodash/pickBy";
import { watch } from 'vue';
import { Inertia } from '@inertiajs/inertia';

const props = defineProps({
  devices: {
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
  },
  {
    key: 'brand.name',
    value: 'Brand'
  }
]


const form = reactive({
  search: props.filters.search,
})

const reset = () => {
  form.search = null;
}

watch(
  form,
  throttle(() => {
    Inertia.get(route("devices"), pickBy(form), {
      preserveState: true,
      preserveScroll: true,
    });
  }, 200),
  { deep: true }
);

</script>
<template>

  <Head title="Devices" />
  <PageHeader>Devices</PageHeader>
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="flex items-center gap-4 md:gap-0 justify-between">
        <SearchBox class="w-full max-w-md my-4" v-model="form.search" @reset="reset" />
        <Link :href="route('devices.create')" as="button" class="btn--primary">Create <span class="hidden md:inline">
          Device</span></Link>
      </div>

      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class=" text-gray-900 dark:text-gray-100">
          <DataTable :table-data="devices.data" :labels="labels" resource-route="devices.edit" />
        </div>
        <Paginator :links="devices.meta.links" />
      </div>
    </div>
  </div>
</template>
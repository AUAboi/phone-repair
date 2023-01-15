<script setup>
import DataTable from '@/Components/DataTable.vue';
import SearchBox from '@/Components/SearchBox.vue';
import Paginator from '@/Components/Paginator.vue';
import PageHeader from '@/Components/PageHeader.vue';
import { Head, Link } from '@inertiajs/vue3';
import { reactive } from '@vue/reactivity';
import throttle from "lodash/throttle";
import pickBy from "lodash/pickBy";
import { watch } from 'vue';
import { router } from '@inertiajs/vue3';

const props = defineProps({
  appointments: {
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
    key: 'id',
    value: 'ID'
  },
  {
    key: 'full_name',
    value: 'Name'
  },
  {
    key: 'device.name',
    value: 'Device'
  },
  {
    key: 'phone',
    value: 'Phone'
  },
  {
    key: 'email',
    value: 'Email'
  },
  {
    key: 'appointment_date',
    value: "Appointment Date"
  },
  {
    key: 'appointment_time',
    value: "Appointment Time"
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
    Inertia.get(route("appointments.index"), pickBy(form), {
      preserveState: true,
      preserveScroll: true,
    });
  }, 200),
  { deep: true }
);

</script>
<template>

  <Head title="Appointments" />

  <PageHeader>Appointments</PageHeader>
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="flex items-center gap-4 md:gap-0 justify-between">
        <SearchBox class="w-full max-w-md my-4 mx-2 md:mx-0" v-model="form.search" @reset="reset" />
      </div>

      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg mx-2 md:mx-0">
        <div class=" text-gray-900 dark:text-gray-100">
          <DataTable :table-data="appointments.data" :labels="labels" resource-route="appointments.show" />
        </div>
        <Paginator :links="appointments.meta.links" />
      </div>
    </div>
  </div>
</template>
<style>

</style>
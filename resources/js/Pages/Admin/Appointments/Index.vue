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
  statuses: {
    required: true
  },
  filters: {
    required: true,
    type: Object
  }
})

const labels = [
  {
    key: 'appointment_number',
    value: 'Appointment Number'
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
  status: props.filters.status
})

const reset = () => {
  form.search = null;
  form.status = null;
}

watch(
  form,
  throttle(() => {
    router.get(route("appointments.index"), pickBy(form), {
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
        <SearchBox class="w-full max-w-md my-4 mx-2 md:mx-0" v-model="form.search" @reset="reset">
          <div class="flex flex-col gap-4 text-center dark:text-white">
            <p v-for="(status, index) in statuses" :key="index" class="cursor-pointer capitalize"
              @click.prevent="form.status = status">{{ status }}</p>
          </div>
        </SearchBox>
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
<style></style>
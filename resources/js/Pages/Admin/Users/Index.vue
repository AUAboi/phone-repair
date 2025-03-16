<script setup>
import DataTable from "@/Components/DataTable.vue";
import SearchBox from "@/Components/SearchBox.vue";
import Paginator from "@/Components/Paginator.vue";
import PageHeader from "@/Components/PageHeader.vue";
import { Head, Link } from "@inertiajs/vue3";
import { reactive } from "@vue/reactivity";
import { router } from "@inertiajs/vue3";
import { reactivePick, watchThrottled } from "@vueuse/core";

const props = defineProps({
  users: {
    required: true,
    type: Object,
  },
  filters: {
    required: true,
    type: Object,
  },
});

const labels = [
  {
    key: "name",
    value: "Name",
  },
];

const form = reactive({
  search: props.filters.search,
});

const reset = () => {
  form.search = null;
};

watchThrottled(
  form,
  () => {
    router.get(
      route("users.index"),
      reactivePick(form, (val) => val != null),
      {
        preserveState: true,
        preserveScroll: true,
      }
    );
  },
  { throttle: 500, deep: true }
);
</script>
<template>
  <Head title="users" />

  <PageHeader>Users</PageHeader>
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="flex items-center gap-4 md:gap-0 justify-between">
        <SearchBox
          class="w-full max-w-md my-4 mx-2 md:mx-0"
          v-model="form.search"
          @reset="reset"
        />
      </div>

      <div
        class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg mx-2 md:mx-0"
      >
        <div class="text-gray-900 dark:text-gray-100">
          <DataTable :table-data="users.data" :labels="labels" />
        </div>
        <Paginator :links="users.meta.links" />
      </div>
    </div>
  </div>
</template>

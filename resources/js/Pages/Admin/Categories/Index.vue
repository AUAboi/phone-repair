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
  categories: {
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
      route("categories.index"),
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
  <Head title="Categories" />

  <PageHeader>Categories</PageHeader>
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="flex items-center gap-4 md:gap-0 justify-between">
        <SearchBox
          class="w-full max-w-md my-4 mx-2 md:mx-0"
          v-model="form.search"
          @reset="reset"
        />
        <Link
          :href="route('categories.create')"
          as="button"
          class="btn--primary"
          >Create <span class="hidden md:inline"> Category</span></Link
        >
      </div>

      <div
        class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg mx-2 md:mx-0"
      >
        <div class="text-gray-900 dark:text-gray-100">
          <DataTable
            :table-data="categories.data"
            :labels="labels"
            resource-route="categories.edit"
          />
        </div>
        <Paginator :links="categories.meta.links" />
      </div>
    </div>
  </div>
</template>

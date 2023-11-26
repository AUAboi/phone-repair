<script setup>
import DataTable from "@/Components/DataTable.vue";
import SearchBox from "@/Components/SearchBox.vue";
import Paginator from "@/Components/Paginator.vue";
import PageHeader from "@/Components/PageHeader.vue";
import { Head, Link } from "@inertiajs/vue3";
import { reactive } from "@vue/reactivity";
import throttle from "lodash/throttle";
import pickBy from "lodash/pickBy";
import { watch } from "vue";
import { router } from "@inertiajs/vue3";

const props = defineProps({
  posts: {
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
    key: "title",
    value: "Title",
  },
  {
    key: "author",
    value: "Author",
  },
  {
    key: "status",
    value: "Status",
  },
];

const form = reactive({
  search: props.filters.search,
});

const reset = () => {
  form.search = null;
};

watch(
  form,
  throttle(() => {
    router.get(route("posts.index"), pickBy(form), {
      preserveState: true,
      preserveScroll: true,
    });
  }, 200),
  { deep: true }
);
</script>
<template>
  <Head title="users" />

  <PageHeader>Blog Posts</PageHeader>
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="flex items-center gap-4 md:gap-0 justify-between">
        <SearchBox
          class="w-full max-w-md my-4 mx-2 md:mx-0"
          v-model="form.search"
          @reset="reset"
        />
        <Link :href="route('posts.create')" as="button" class="btn--primary"
          >Publish <span class="hidden md:inline"> Blog</span></Link
        >
      </div>

      <div
        class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg mx-2 md:mx-0"
      >
        <div class="text-gray-900 dark:text-gray-100">
          <DataTable
            resource-route="posts.edit"
            :table-data="posts.data"
            :labels="labels"
          />
        </div>
        <Paginator :links="posts.meta.links" />
      </div>
    </div>
  </div>
</template>

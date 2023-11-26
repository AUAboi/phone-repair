<script setup>
import { router } from "@inertiajs/vue3";
import pickBy from "lodash/pickBy";
import { reactive } from "vue";
import SearchIcon from "~icons/mdi/magnify";

const form = reactive({
  search: "",
});

const search = () => {
  router.get(route("post.search"), pickBy(form));
};
</script>
<template>
  <div class="flex items-center gap-4">
    <label for="">Search</label>
    <input v-model="form.search" class="border-gray-300 rounded" type="text" />
    <button
      @click.prevent="search"
      class="bg-red-500 text-white p-3 hover:bg-red-600"
    >
      <SearchIcon />
    </button>
  </div>
</template>

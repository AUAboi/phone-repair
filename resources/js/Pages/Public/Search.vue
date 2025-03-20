<script setup>
import { Link, router } from "@inertiajs/vue3";
import { reactive } from "vue";
import PostSection from "@/Components/PostSection.vue";
import { reactivePick, watchThrottled } from "@vueuse/core";

const props = defineProps(["filters", "posts"]);

const form = reactive({
  search: props.filters.search,
});

watchThrottled(
  form,
  () => {
    router.get(route("post.search"), form, {
      preserveState: true,
      preserveScroll: true,
    });
  },
  { throttle: 500, deep: true }
);
</script>
<template>
  <section class="py-24">
    <div class="mt-20">
      <h3 class="text-6xl text-center">Search</h3>
      <h5 class="text-3xl text-center" v-if="form.search">{{ form.search }}</h5>
    </div>
    <div class="flex justify-center mt-12">
      <div class="flex items-center gap-4">
        <input
          v-model="form.search"
          class="border-gray-300 rounded border"
          type="text"
        />
      </div>
    </div>
    <div v-if="form.search" class="container px-5 text-xl mx-auto">
      {{ posts.data.length }} Results found
    </div>
    <PostSection :posts="posts.data" />
  </section>
</template>

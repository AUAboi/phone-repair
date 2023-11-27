<script setup>
import { Link, router } from "@inertiajs/vue3";
import pickBy from "lodash/pickBy";
import throttle from "lodash/throttle";
import { reactive, watch } from "vue";
import PostSection from "@/Components/PostSection.vue";

const props = defineProps(["filters", "posts"]);

const form = reactive({
  search: props.filters.search,
});

watch(
  form,
  throttle(() => {
    router.get(route("post.search"), pickBy(form), {
      preserveState: true,
      preserveScroll: true,
    });
  }, 200),
  { deep: true }
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
          class="border-gray-300 rounded"
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

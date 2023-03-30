<script setup>
import { Link } from "@inertiajs/vue3";
import { onClickOutside } from "@vueuse/core";
import { ref } from "vue";
import IconPlus from "~icons/mdi/plus";

const props = defineProps({
  href: String,
});

const toggle = ref(false);
const dropdown = ref(null);
const toggleButton = ref(null);

onClickOutside(dropdown, () => (toggle.value = false), {
  ignore: [toggleButton],
});
</script>

<template>
  <div ref="dropdown" class="flex justify-between flex-wrap">
    <Link class="flex-grow w-3/4" :href="href">
      <slot name="link" />
    </Link>
    <button
      class="flex-grow text-2xl cursor-pointer"
      ref="toggleButton"
      @click="toggle = !toggle"
    >
      <IconPlus />
    </button>
    <div
      class="flex-shrink transition-all duration-300 ease-linear max-h-0 overflow-hidden text-lg text-gray-400 pl-2"
      :class="toggle ? 'max-h-80' : ''"
    >
      <slot name="dropdown" />
    </div>
  </div>
</template>

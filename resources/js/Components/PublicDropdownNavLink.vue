<script setup>
import { ref } from 'vue';
import IconPlus from '~icons/mdi/plus';

const props = defineProps({
  show: {
    default: false
  },
  href: String
})

const toggle = ref(false)

</script>

<template>
  <div class="flex justify-between flex-wrap">
    <a class="flex-grow w-3/4" :href="href">
      <slot name="link" />
    </a>
    <IconPlus @click="toggle = !toggle" class="flex-grow text-2xl cursor-pointer" />
    <div
      class="flex-shrink transition-all duration-500 ease-linear max-h-0 overflow-hidden text-base text-gray-200 pl-2"
      :class="toggle ? 'max-h-80' : ''">
      <slot name="dropdown" />
    </div>
  </div>
</template>
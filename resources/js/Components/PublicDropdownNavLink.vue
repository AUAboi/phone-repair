<script setup>
import { onClickOutside } from '@vueuse/core';
import { ref } from 'vue';
import IconPlus from '~icons/mdi/plus';

const props = defineProps({

  href: String
})

const toggle = ref(false)
const dropdown = ref(null)
const toggleButton = ref(null)

onClickOutside(dropdown, () => toggle.value = false, {
  ignore: [toggleButton]
})

</script>

<template>
  <div ref="dropdown" class="flex justify-between flex-wrap">
    <a class="flex-grow w-3/4" :href="href">
      <slot name="link" />
    </a>
    <button class="flex-grow text-2xl cursor-pointer" ref="toggleButton" @click="toggle = !toggle">
      <IconPlus />

    </button>
    <div class="flex-shrink transition-all duration-500 ease-linear max-h-0 overflow-hidden text-base text-gray-200 pl-2"
      :class="toggle ? 'max-h-80' : ''">
      <slot name="dropdown" />
    </div>
  </div>
</template>
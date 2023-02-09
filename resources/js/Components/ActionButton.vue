<script setup>
import { Link } from '@inertiajs/vue3';
defineProps({
  href: {
    type: String,
    default: '#',
  },
});

</script>

<template>
  <Link as="button" :href="href"
    class="bg-pink-500 hover:bg-pink-600 text-xl text-white px-6 py-1 rounded-md transition ease-in-out duration-150">
  <slot />
  </Link>
</template>

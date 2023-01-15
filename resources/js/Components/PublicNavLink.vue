<script setup>
import { Link } from '@inertiajs/vue3';

const props = defineProps(['href',]);

</script>

<template>
  <div>
    <Link :href="href">
    <slot />
    </Link>
  </div>
</template>

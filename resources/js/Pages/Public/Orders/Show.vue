<script setup>
const props = defineProps({
  order: Object,
});
</script>
<template>
  <section class="pt-28">
    <div class="bg-white border-gray-300 shadow-lg">
      <div class="flex">
        {{ order.products }}
      </div>
    </div>
  </section>
</template>

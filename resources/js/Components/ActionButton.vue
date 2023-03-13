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
  <!-- <Link as="button" class="btn-action uppercase" :href="href">
          <slot />
          </Link> -->
</template>

<style scoped>
.btn-action {
  background-color: #e52929;
  z-index: 1;
  height: 60px;
  line-height: 1;
  color: #ffffff;
  font-size: 14px;
  font-weight: 700;
  padding: 10px 35px;
  position: relative;
  align-items: center;
  display: inline-flex;
  letter-spacing: 0.5px;
  justify-content: center;
}

.btn-action:before {
  background: #2e2e2e;
}

.btn-action:hover:before {
  left: 0px;
  width: 100%;
  right: auto;
}

.btn-action:hover {
  color: #ffffff;
}

.btn-action:before {
  top: 0px;
  width: 0px;
  left: auto;
  right: 0px;
  z-index: -1;
  bottom: 0px;
  content: "";
  position: absolute;
  transition: all 0.3s ease-in-out;
}
</style>

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
  <Link as="button" :href="href" class="btn-action">
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
  height: 45px;
  line-height: 1;
  color: #ffffff;
  font-size: 14px;
  font-weight: 700;
  padding: 10px 20px;
  position: relative;
  align-items: center;
  display: inline-flex;
  letter-spacing: 0.5px;
  justify-content: center;
  font-size: 1.3rem;
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

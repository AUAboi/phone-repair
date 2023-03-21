<script setup>
import BaseMenu from './BaseMenu.vue';
import ResponsiveMenu from './ResponsiveMenu.vue';
import { ref } from 'vue';
import { onClickOutside } from '@vueuse/core'
import { router } from '@inertiajs/vue3'

const props = defineProps({
  menuItems: {
    required: true
  }
})

const showNav = ref(false);
const responsiveMenu = ref(null);
const navButton = ref(null);
onClickOutside(responsiveMenu, () => showNav.value = false, {
  ignore: [navButton]
})


router.on('success', (event) => {
  showNav.value = false
})


</script>
<template>
  <BaseMenu :menu-items="menuItems" />
  <ResponsiveMenu :menu-items="menuItems" ref="responsiveMenu" :show="showNav" />
  <div ref="navButton" @click="showNav = !showNav" :class="{ show: showNav }"
    class="nav-button fixed sm:hidden rounded-md right-3 top-10 md:right-10 md:top-6 cursor-pointer transition-all ease-in-out duration-500 ">
    <div id="line1" class="bg-red-500 btn-line transition-all ease-out"></div>
    <div id="line2" class="bg-red-500 btn-line transition-all ease-out"></div>
    <div id="line3" class="bg-red-500 btn-line transition-all ease-out"></div>
  </div>
</template>

<style scoped>
.btn-line {
  margin: 0.25rem;
  height: 0.25rem;
  width: 1.5rem;
}

.nav-button.show .btn-line:nth-child(1) {
  transform: translateY(0.125rem) translateX(0.125rem) rotate(40deg);
}

.nav-button.show .btn-line:nth-child(2) {
  display: none;
}

.nav-button.show .btn-line:nth-child(3) {

  transform: translateY(-0.375rem) translateX(0.125rem) rotate(-40deg);
}

.nav-button {
  z-index: 1000;
}
</style>
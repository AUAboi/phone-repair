<script setup>
import BaseMenu from './BaseMenu.vue';
import ResponsiveMenu from './ResponsiveMenu.vue';
import { ref } from 'vue';
import { onClickOutside } from '@vueuse/core'

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

</script>
<template>
  <BaseMenu :menu-items="menuItems" />
  <ResponsiveMenu :menu-items="menuItems" ref="responsiveMenu" :show="showNav" />
  <div ref="navButton" @click="showNav = !showNav"
    class="nav-button fixed sm:hidden rounded-md right-4 top-8 md:right-10 md:top-6 z-50 cursor-pointer transition-all ease-in-out duration-500 ">
    <div id="line1" class="bg-pink-500 btn-line transition-all ease-out"></div>
    <div id="line2" class="bg-pink-500 btn-line transition-all ease-out"></div>
    <div id="line3" class="bg-pink-500 btn-line transition-all ease-out"></div>
  </div>
</template>

<style scoped>
.btn-line {
  margin: 0.25rem;
  height: 0.25rem;
  width: 1.5rem;
}
</style>
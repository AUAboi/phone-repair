<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import ResponsiveMenu from '@/Components/ResponsiveMenu.vue';
import { ref } from 'vue';
import { onClickOutside } from '@vueuse/core'

const showNav = ref(false);
const responsiveMenu = ref(null);
const navButton = ref(null);

onClickOutside(responsiveMenu, () => showNav.value = false, {
  ignore: [navButton]
})


</script>
<template>
  <header class="text-gray-600 body-font">
    <div
      class="container mx-auto flex sm:p-5 flex-col sm:flex-row sm:justify-between md:items-center bg-white bg-opacity-70 z-50">
      <div class="flex sm:block justify-center mt-8 sm:mt-0">
        <ApplicationLogo class="max-h-7" />
      </div>
      <nav
        class="hidden sm:flex md:flex-wrap md:items-center text-base md:justify-center z-40 md:p-5 lg:px-1 font-semibold gap-4 ">
        <div class="group inline-block relative">
          <a class=" hover:text-gray-900" href="https://google.com">
            <span class="flex items-center">Repairs
              <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
              </svg></span>
          </a>
          <ul class="animated-menu absolute hidden text-gray-700 pt-1 group-hover:block">
            <li>
              <a class="rounded-t bg-white shadow-md hover:bg-gray-400 py-2 px-4 block whitespace-no-wrap"
                href="#">One</a>
            </li>
            <li>
              <a class="bg-white hover:bg-gray-400 py-2 px-4 block whitespace-no-wrap" href="#">Two</a>
            </li>
            <li>
              <a class="rounded-b bg-white hover:bg-gray-400 py-2 px-4 block whitespace-no-wrap" href="#">Three
                is the magic number</a>
            </li>
          </ul>
        </div>
        <a href="#karriere" class="hover:text-gray-900">About</a>
        <a href="#produkte" class="hover:text-gray-900">Contact</a>
      </nav>
      <ResponsiveMenu ref="responsiveMenu" :show="showNav" />

      <div ref="navButton" @click="showNav = !showNav"
        class="nav-button fixed sm:hidden rounded-md right-4 top-8 md:right-10 md:top-6 z-50 cursor-pointer transition-all ease-in-out duration-500 ">
        <div id="line1" class="bg-pink-500 btn-line transition-all ease-out"></div>
        <div id="line2" class="bg-pink-500 btn-line transition-all ease-out"></div>
        <div id="line3" class="bg-pink-500 btn-line transition-all ease-out"></div>
      </div>
    </div>
  </header>
  <main>
    <slot />
  </main>
</template>

<style scoped>
.animated-menu {
  animation-fill-mode: both;
  animation-name: slideInUp-30;
  animation-duration: .3s;
  -webkit-animation-duration: .3s;
  -webkit-animation-fill-mode: both;
  -webkit-animation-name: slideInUp-30;
}

.btn-line {
  margin: 0.25rem;
  height: 0.25rem;
  width: 1.5rem;
}

@media screen and (max-width: 639px) {
  .navbar {
    transform: translateX(-100%);
    transition: all 500ms ease;
  }

  .navbar.show {
    transform: translateX(0);
  }
}

@keyframes slideInUp-30 {
  0% {
    -webkit-transform: translate3d(0, 30px, 0);
    transform: translate3d(0, 30px, 0);
    opacity: 0;
    visibility: visible;
  }

  100% {
    -webkit-transform: translate3d(0, 0, 0);
    opacity: 1;
    transform: translate3d(0, 0, 0);
  }
}
</style>
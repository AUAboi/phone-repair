<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import PublicNavigation from './partials/PublicNavigation.vue';

const props = defineProps(['navigation'])

const menuItems = [
  {
    text: "Repair",
    href: "https://google.com",
    children: props.navigation.devices.map(d => {
      return {
        text: d.name,
        href: d.image
      }
    })
  },
  {
    text: "About",
    href: "/about"
  },
  {
    text: "Contact",
    href: route('dashboard')
  }
]

</script>
<template>
  <header class="text-gray-600 pb-6 body-font sm:shadow-md ">
    <div
      class="container mx-auto flex sm:p-5 flex-col sm:flex-row sm:justify-between md:items-center bg-white bg-opacity-70 z-50">
      <div class="flex sm:block justify-center mt-8 sm:mt-0">
        <ApplicationLogo class="max-h-7" />
      </div>
      <PublicNavigation :menu-items="menuItems" />
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
</style>
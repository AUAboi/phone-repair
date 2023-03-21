<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import FlashMessage from '@/Components/FlashMessage.vue';
import { Link } from '@inertiajs/vue3';
import PublicFooter from './partials/PublicFooter.vue';
import PublicNavigation from './partials/PublicNavigation.vue';

const props = defineProps(['navigation'])

const menuItems = [
  {
    text: "Repair",
    href: route("public.repairs"),
    children:
      props.navigation.devices.map(d => {
        return {
          text: d.name,
          href: route('public.appointments.create', d.slug)
        }
      })
  },

  {
    text: "Contact",
    href: route('public.contact')
  }
]



</script>
<template>
  <header class="text-black pb-6 md:p-0 sm:shadow-md md:absolute w-full">
    <div
      class="sm:p-5 lg:p-0  bg-transparent h-full w-full md:bg-gray-200 md:rounded-md md:bg-clip-padding md:backdrop-filter md:backdrop-blur-sm md:bg-opacity-10 z-50">
      <div class="container mx-auto flex flex-col sm:flex-row sm:justify-between md:items-center">

        <div class="flex sm:block justify-center mt-8 sm:mt-0">
          <Link :href="route('public.home')">
          <ApplicationLogo class="max-h-14" />
          </Link>
        </div>
        <PublicNavigation :menu-items="menuItems" />
      </div>

    </div>
  </header>
  <main>
    <FlashMessage />
    <slot />
  </main>
  <PublicFooter />
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
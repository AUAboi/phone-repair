<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
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
  <header class="text-gray-600 pb-6 md:p-0 body-font sm:shadow-2xl ">
    <div
      class="container mx-auto flex sm:p-5 lg:p-0 flex-col sm:flex-row sm:justify-between md:items-center bg-white bg-opacity-70 z-50">
      <div class="flex sm:block justify-center mt-8 sm:mt-0">
        <Link :href="route('public.home')">
        <ApplicationLogo class="max-h-7" />
        </Link>
      </div>
      <PublicNavigation :menu-items="menuItems" />
    </div>
  </header>
  <main>
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
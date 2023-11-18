<script setup>
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import FlashMessage from "@/Components/FlashMessage.vue";
import { Link, usePage } from "@inertiajs/vue3";
import PublicFooter from "./partials/PublicFooter.vue";
import PublicNavigation from "./partials/PublicNavigation.vue";

const props = defineProps(["navigation"]);

const menuItems = [
  {
    text: "Repair",
    href: route("public.repairs"),
    children: props.navigation.devices.map((d) => {
      return {
        text: d.name,
        href: route("public.appointments.create", d.slug),
      };
    }),
  },
  {
    text: "Products",
    href: route("public.products"),
  },
  {
    text: "Contact Us",
    href: route("public.contact"),
  },
];
</script>
<template>
  <header
    class="text-black pb-6 md:p-4 md absolute w-full z-50"
    :class="route().current('public.contact') ? 'dark' : ''"
  >
    <div class="sm:p-5 lg:px-0 bg-transparent h-full w-full md:rounded-md z-50">
      <div
        class="container mx-auto flex flex-col sm:flex-row sm:justify-between md:items-center"
      >
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

<style>
.carousel__prev,
.carousel__next {
  display: none !important;
}

button.carousel__pagination-button--active::after {
  @apply bg-red-500;
}
</style>

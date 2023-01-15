<script setup>
import PublicNavLink from './PublicNavLink.vue';
import PublicDropdownNavLink from './PublicDropdownNavLink.vue';

const props = defineProps({
  show: {
    default: false
  }
})

</script>

<template>
  <nav :class="{ show: show }"
    class="navbar sm:hidden px-6 py-16 fixed h-full w-80 text-white text-lg bg-gray-800 flex flex-col gap-4">
    <PublicDropdownNavLink :href="route('repairs.index')">
      <template #link>
        Repairs
      </template>
      <template #dropdown>
        <PublicNavLink>iPhone X</PublicNavLink>
        <PublicNavLink>Smasung Glaxy</PublicNavLink>
        <PublicNavLink>Google Pixel</PublicNavLink>
      </template>
    </PublicDropdownNavLink>
    <PublicNavLink :href="route('dashboard')">About</PublicNavLink>
    <PublicNavLink :href="route('dashboard')">Contact</PublicNavLink>

  </nav>

</template>
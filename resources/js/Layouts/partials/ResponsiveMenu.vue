<script setup>
import PublicNavLink from '@/Components/PublicNavLink.vue';
import PublicDropdownNavLink from '@/Components/PublicDropdownNavLink.vue';

const props = defineProps({
  menuItems: {
    required: true
  },
  show: {
    default: false
  },
  devices: {
    required: false
  }
})

</script>

<template>
  <nav :class="{ show: show }"
    class="navbar sm:hidden px-6 py-16 fixed h-full w-80 text-white text-lg bg-gray-800 flex flex-col gap-4">
    <div v-for="(item, index) in menuItems" :key="index">
      <PublicDropdownNavLink v-if="item.children">
        <template #link>
          {{ item.text }}
        </template>
        <template #dropdown>
          <PublicNavLink v-for="(child, index) in item.children" :key="index" :href="child.href">
            {{ child.text }}
          </PublicNavLink>
        </template>
      </PublicDropdownNavLink>
      <PublicNavLink v-else :href="item.href">{{ item.text }}</PublicNavLink>
    </div>
  </nav>

</template>
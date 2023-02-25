<script setup>
import PublicNavLink from '@/Components/PublicNavLink.vue';
import PublicDropdownNavLink from '@/Components/PublicDropdownNavLink.vue';
import { Link } from '@inertiajs/vue3';

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
  <Transition enter-from-class="-translate-x-96" enter-to-class="translate-x-0" leave-to-class="-translate-x-96">
    <nav v-if="show"
      class="sm:hidden px-6 py-16 fixed h-full w-80 text-white text-lg bg-gray-800 flex flex-col gap-4 transition-all duration-500">
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
      <div v-if="$page.props.auth.user" class="space-x-2 mt-auto">
        <Link as="button" method="post" class="btn--cta px-4 py-1" :href="route('logout')">Logout</Link>
      </div>
      <div v-else class="space-x-2 mt-auto">
        <Link class="btn--cta px-4 py-1" :href="route('register')">Register</Link>
        <Link
          class="bg-transparent border-pink-500 border px-4 py-1  hover:bg-pink-600 text-xl text-white rounded-md transition ease-in-out duration-150"
          :href="route('login')">Login</Link>
      </div>
    </nav>
  </Transition>
</template>

<style scoped>
nav {
  z-index: 999;
}
</style>
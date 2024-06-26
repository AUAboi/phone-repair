<script setup>
import { Link } from "@inertiajs/vue3";
import AccountIcon from "~icons/mdi/account";

const props = defineProps({
  menuItems: {
    required: true,
  },
});
</script>
<template>
  <nav class="hidden sm:flex items-center gap-10 flex-grow">
    <div
      class="sm:flex md:flex-wrap md:items-center text-lg md:justify-end z-40 md:p-5 lg:px-1 flex-grow gap-12 font-medium dark:text-white text-neutral-700"
    >
      <div v-for="(item, index) in menuItems" :key="index">
        <div
          v-if="item.children && item.children.length"
          class="group inline-block relative"
        >
          <Link
            class="hover:text-gray-900 dark:hover:text-gray-200"
            :href="item.href"
          >
            <span class="flex items-center"
              >{{ item.text }}
              <svg
                class="fill-current h-4 w-4"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 20 20"
              >
                <path
                  d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"
                />
              </svg>
            </span>
          </Link>
          <ul
            :style="`grid-template-rows: repeat(${
              item.children.length > 3 ? 3 : item.children.length
            }, 1fr)`"
            class="animated-menu absolute hidden text-neutral-700 bg-white shadow-md group-hover:grid text-base"
          >
            <li v-for="(child, index) in item.children" :key="index">
              <Link
                class="hover:text-red-500 py-2 px-4 block whitespace-nowrap transition-colors duration-300"
                :href="child.href"
                >{{ child.text }}</Link
              >
            </li>
          </ul>
        </div>
        <Link
          v-else
          class="hover:text-gray-900 dark:hover:text-gray-200"
          :href="item.href"
          >{{ item.text }}</Link
        >
      </div>
    </div>

    <div class="space-x-2 flex-grow text-end">
      <Link
        as="button"
        class="text-3xl text-white bg-red-500 p-1 rounded-full"
        :href="route('user.profile')"
        ><AccountIcon />
      </Link>
    </div>
  </nav>
</template>

<style scoped>
.animated-menu {
  animation-fill-mode: both;
  animation-name: slideInUp-30;
  animation-duration: 0.3s;
  -webkit-animation-duration: 0.3s;
  -webkit-animation-fill-mode: both;
  -webkit-animation-name: slideInUp-30;

  grid-auto-flow: column;
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

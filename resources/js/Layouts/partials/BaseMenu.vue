<script setup>

const props = defineProps({
  menuItems: {
    required: true
  }
})
</script>
<template>
  <nav
    class="hidden sm:flex md:flex-wrap md:items-center text-base md:justify-center z-40 md:p-5 lg:px-1 font-semibold gap-4">
    <div v-for="(item, index) in menuItems" :key="index">
      <div v-if="item.children" class="group inline-block relative">
        <a class=" hover:text-gray-900" :href="item.href">
          <span class="flex items-center">{{ item.text }}
            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
              <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
            </svg></span>

        </a>
        <ul class="animated-menu absolute hidden text-gray-700 pt-1 bg-white shadow-md group-hover:block">
          <li v-for="(child, index) in item.children" :key="index">
            <a class="rounded-t  hover:bg-gray-400 hover:text-white py-2 px-4 block whitespace-nowrap"
              :href="child.href">{{
                child.text
              }}</a>
          </li>
        </ul>
      </div>
      <a v-else class="hover:text-gray-900" :href="item.href">{{ item.text }}</a>
    </div>
  </nav>
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
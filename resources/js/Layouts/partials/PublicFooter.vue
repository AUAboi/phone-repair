<script setup>
import { Link } from "@inertiajs/vue3";
import chunk from "lodash/chunk";
</script>
<template>
  <footer class="bg-neutral-900">
    <div class="container px-5 py-24 mx-auto">
      <div class="w-72 flex mx-auto">
        <img src="/images/white.png" alt="Site Logo" />
      </div>
      <div
        class="flex md:justify-evenly md:items-center md:flex-row md:flex-nowrap flex-wrap text-center pt-20 flex-col"
      >
        <div class="text-white flex-grow">
          <h6 class="text-orange-500 font-semibold text-2xl pb-6">
            Fix Devices
          </h6>
          <div
            class="border-white md:border-r-2 overflow-y-auto md:h-36 max-h-[150px] flex flex-col space-y-4"
          >
            <Link
              :href="route('public.appointments.create', device.slug)"
              v-for="(device, index) in $page.props.navigation.devices"
              :key="index"
            >
              {{ device.name }}
            </Link>
          </div>
        </div>
        <div class="text-white flex-grow">
          <h6 class="text-orange-500 font-semibold text-2xl pb-6">
            Fix Products
          </h6>
          <div
            class="border-white md:border-r-2 overflow-y-auto md:h-36 max-h-[150px] flex flex-col space-y-4"
          >
            <Link
              :href="route('public.appointments.product.create', device.id)"
              v-for="(device, index) in $page.props.navigation.products"
              :key="index"
            >
              {{ device.name }}
            </Link>
          </div>
        </div>
        <div class="text-white flex-grow">
          <h6 class="text-orange-500 font-semibold text-2xl pb-6">
            Fix Devices
          </h6>
          <div
            class="border-white md:border-r-2 overflow-y-auto md:h-36 max-h-[150px] flex flex-col space-y-4"
          >
            <Link :href="route('public.repairs')">View all repairs </Link>
            <Link :href="route('public.products')">View all products </Link>
            <Link :href="route('public.contact')">Contact Us </Link>
          </div>
        </div>
      </div>
    </div>

    <div class="bg-black bg-opacity-75">
      <div
        class="container mx-auto py-4 px-5 flex flex-wrap flex-col sm:flex-row"
      >
        <p class="text-gray-400 text-sm text-center sm:text-left">
          © 2023 Fonemart
        </p>
        <span
          class="inline-flex sm:ml-auto sm:mt-0 mt-2 justify-center sm:justify-start"
        >
          <a
            href="https://www.facebook.com/fonemartBR"
            target="_blank"
            class="text-gray-400"
          >
            <svg
              fill="currentColor"
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              class="w-5 h-5"
              viewBox="0 0 24 24"
            >
              <path
                d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"
              ></path>
            </svg>
          </a>
          <a class="ml-3 text-gray-400">
            <svg
              fill="currentColor"
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              class="w-5 h-5"
              viewBox="0 0 24 24"
            >
              <path
                d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"
              ></path>
            </svg>
          </a>
          <a class="ml-3 text-gray-400">
            <svg
              fill="none"
              stroke="currentColor"
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              class="w-5 h-5"
              viewBox="0 0 24 24"
            >
              <rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect>
              <path
                d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37zm1.5-4.87h.01"
              ></path>
            </svg>
          </a>
          <a class="ml-3 text-gray-400">
            <svg
              fill="currentColor"
              stroke="currentColor"
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="0"
              class="w-5 h-5"
              viewBox="0 0 24 24"
            >
              <path
                stroke="none"
                d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6zM2 9h4v12H2z"
              ></path>
              <circle cx="4" cy="4" r="2" stroke="none"></circle>
            </svg>
          </a>
        </span>
      </div>
    </div>
  </footer>
</template>

<style scoped>
footer ::-webkit-scrollbar-corner {
  background: rgba(0, 0, 0, 0.5);
}

* {
  scrollbar-width: thin;
  scrollbar-color: var(--scroll-bar-color) var(--scroll-bar-bg-color);
}

/* Works on Chrome, Edge, and Safari */
*::-webkit-scrollbar {
  width: 12px;
  height: 12px;
}

*::-webkit-scrollbar-track {
  background: var(--scroll-bar-bg-color);
}

*::-webkit-scrollbar-thumb {
  background-color: var(--scroll-bar-color);
  border-radius: 20px;
  border: 3px solid var(--scroll-bar-bg-color);
}
</style>

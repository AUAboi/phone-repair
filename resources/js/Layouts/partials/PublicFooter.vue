<script setup>
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import { Link } from "@inertiajs/vue3";
import chunk from "lodash/chunk";
</script>
<template>
  <footer class="text-gray-400 bg-neutral-900 body-font">
    <div
      class="container px-5 py-24 mx-auto flex md:items-center lg:items-start md:flex-row md:flex-nowrap flex-wrap flex-col"
    >
      <div>
        <div
          class="w-64 flex-shrink-0 md:mx-0 mx-auto text-center md:text-left md:mt-0 mt-10"
        >
          <Link
            :href="route('public.home')"
            class="flex title-font font-medium items-center md:justify-start justify-center text-gray-900"
          >
            <ApplicationLogo />
          </Link>
          <p class="mt-2 text-sm text-center uppercase">
            We buy and sell iphones, ipads, tablets and laptops
          </p>
        </div>
        <div class="mt-4 hidden md:block">
          <ul>
            <li>
              Email:
              <a href="mailto:info@fonemart.com" class="text-white"
                >info@fonemart.com</a
              >
            </li>
            <li>
              Phone:
              <a href="tel:+44 1243 862501" class="text-white"
                >+44 1243 862501</a
              >
            </li>
            <li>
              Address
              <a
                href="https://goo.gl/maps/uEgWVsT7hMQ7Tipq9"
                class="text-white"
                target="_blank"
                rel="noopener noreferrer"
                >16 The Arcade, Bognor Regis</a
              >
            </li>
          </ul>
        </div>
      </div>

      <div
        class="flex-grow flex flex-wrap md:pl-20 -mb-10 md:mt-0 mt-10 md:text-left text-center"
      >
        <div class="lg:w-1/4 md:w-1/2 w-full px-4 flex-grow mb-4 sm:mb-0">
          <h2
            class="title-font text-white font-medium tracking-widest text-lg mb-3 uppercase"
          >
            Quick Links
          </h2>
          <nav>
            <ul>
              <li>
                <Link
                  class="hover:text-red-500 transition-colors duration-300"
                  :href="route('public.home')"
                  >Home</Link
                >
              </li>
              <li>
                <Link
                  class="hover:text-red-500 transition-colors duration-300"
                  :href="route('public.repairs')"
                  >Repairs</Link
                >
              </li>
              <li>
                <Link
                  class="hover:text-red-500 transition-colors duration-300"
                  :href="route('public.products')"
                  >Products</Link
                >
              </li>
              <li>
                <Link
                  class="hover:text-red-500 transition-colors duration-300"
                  :href="route('public.contact')"
                  >Contact Us</Link
                >
              </li>
            </ul>
          </nav>
        </div>

        <div class="lg:w-1/4 md:w-1/2 w-full px-4 flex-grow">
          <h2
            class="title-font font-medium text-white tracking-widest text-sm mb-3"
          >
            SUBSCRIBE TO OUR NEWSLETTER
          </h2>
          <div
            class="flex xl:flex-nowrap md:flex-nowrap lg:flex-wrap flex-wrap justify-center items-end md:justify-start"
          >
            <div class="relative w-40 sm:w-auto xl:mr-4 lg:mr-0 sm:mr-4 mr-2">
              <label for="footer-field" class="leading-7 text-sm text-gray-400"
                >Email</label
              >
              <input
                type="text"
                id="footer-field"
                name="footer-field"
                placeholder="example@mail.com"
                class="w-full bg-gray-800 rounded border bg-opacity-40 border-gray-700 focus:bg-transparent focus:ring-2 focus:ring-red-900 focus:border-red-500 text-base outline-none text-gray-100 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
              />
            </div>
            <button
              class="mt-2 sm:mt-0 lg:mt-2 xl:mt-0 flex-shrink-0 inline-flex text-white bg-red-500 border-0 py-2 px-6 focus:outline-none hover:bg-red-600 rounded"
            >
              Submit
            </button>
          </div>
        </div>
      </div>
    </div>
    <div class="bg-black bg-opacity-75">
      <div
        class="container mx-auto py-4 px-5 flex flex-wrap flex-col sm:flex-row"
      >
        <p class="text-gray-400 text-sm text-center sm:text-left">
          © 2022 Fonemart
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

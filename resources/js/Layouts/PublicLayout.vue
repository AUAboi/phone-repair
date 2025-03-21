<script setup>
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import FlashMessage from "@/Components/FlashMessage.vue";
import { Link, usePage } from "@inertiajs/vue3";
import PublicFooter from "./partials/PublicFooter.vue";
import PublicNavigation from "./partials/PublicNavigation.vue";
import { onMounted, ref } from "vue";
import { useLogoStore } from "@/store/logoStore";
import Aos from "aos";
import "aos/dist/aos.css";
import MdiWhatsapp from "~icons/mdi/whatsapp";

const props = defineProps(["navigation"]);
const toggle = ref(false);

onMounted(() => {
  Aos.init();
});

const page = usePage();

const isUrl = (...urls) => {
  let currentUrl = page.url.substring(1);
  if (urls[0] === "") {
    return currentUrl === "";
  }
  return urls.filter((url) => currentUrl.startsWith(url)).length;
};
</script>
<template>
  <div
    class="header-area default-header relative z-50 bg-white dark:bg-title"
    :class="scroll ? 'sticky-header' : ''"
  >
    <div class="container-fluid">
      <div
        class="flex items-center justify-between gap-x-6 max-w-[1720px] mx-auto relative py-[10px] sm:py-4 lg:py-0"
      >
        <Link :href="route('public.home')" class="cursor-pointer block">
          <img
            src="/images/red-logo.png"
            alt=""
            class="block w-[120px] sm:w-[200px]"
          />
        </Link>

        <div
          class="main-menu absolute z-50 w-full lg:w-auto top-full left-0 lg:static bg-white dark:bg-title lg:bg-transparent lg:dark:bg-transparent px-5 sm:px-[30px] py-[10px] sm:py-5 lg:px-0 lg:py-0"
          :class="toggle ? 'active' : ''"
        >
          <ul
            class="text-lg leading-none text-title dark:text-white lg:flex lg:gap-[30px]"
          >
            <li
              class="relative"
              :class="
                ['public.home'].includes(route().current()) ? 'active' : ''
              "
            >
              <Link :href="route('public.home')">Home</Link>
            </li>

            <li
              class="relative"
              :class="
                ['public.shop'].includes(route().current()) ? 'active' : ''
              "
            >
              <Link :href="route('public.shop')">Shop<span></span></Link>
              <ul
                class="sub-menu lg:absolute z-50 lg:top-full lg:left-0 lg:min-w-[220px] lg:invisible lg:transition-all lg:bg-white lg:dark:bg-title lg:py-[15px] lg:pr-[30px]"
              >
                <li
                  v-for="p in $page.props.navigation.categories"
                  :class="current === '/' ? 'active' : ''"
                >
                  <Link
                    :href="route('public.product.show', p.id)"
                    class="menu-item"
                    >{{ p.name }}</Link
                  >
                </li>
              </ul>
            </li>
            <li
              class="relative"
              :class="
                ['public.repairs'].includes(route().current()) ? 'active' : ''
              "
            >
              <Link :href="route('public.repairs')">Book a Repair</Link>
            </li>
            <li
              class="relative"
              :class="
                ['public.posts'].includes(route().current()) ? 'active' : ''
              "
            >
              <Link :href="route('public.posts')">Blogs</Link>
            </li>
            <li
              class="relative"
              :class="
                ['public.about'].includes(route().current()) ? 'active' : ''
              "
            >
              <Link :href="route('public.about')">About Us</Link>
            </li>
            <li
              :class="
                ['public.contact'].includes(route().current()) ? 'active' : ''
              "
            >
              <Link :href="route('public.contact')">Contact</Link>
            </li>
            <li class="lg:hidden">
              <Link href="/login">Login</Link>
            </li>
          </ul>
        </div>

        <PublicNavigation :toggle="toggle" @toggle-change="toggle = $event" />
      </div>
    </div>
  </div>
  <main>
    <FlashMessage />
    <slot />
  </main>
  <div class="fixed bottom-0 right-0 z-50 p-4">
    <a href="https://wa.link/w2nt7r" target="_blank">
      <MdiWhatsapp class="text-4xl text-green-600" />
    </a>
  </div>
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

<script setup>
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import FlashMessage from "@/Components/FlashMessage.vue";
import { Link } from "@inertiajs/vue3";
import PublicFooter from "./partials/PublicFooter.vue";
import PublicNavigation from "./partials/PublicNavigation.vue";
import { ref } from "vue";
import { useLogoStore } from "@/store/logoStore";

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
    text: "Tracking",
    href: "#",
    children: [
      {
        text: "Track your order",
        href: route("public.order.tracking"),
      },
      {
        text: "Track your appointment",
        href: route("public.appointment.tracking"),
      },
    ],
  },
  {
    text: "Contact Us",
    href: route("public.contact"),
  },
];
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
            src="images/red.png"
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
                [
                  '/',
                  '/index-v2',
                  '/index-v3',
                  '/index-v4',
                  '/index-v5',
                  '/index-v6',
                ].includes(current)
                  ? 'active'
                  : ''
              "
            >
              <Link href="#">Home<span></span></Link>
              <ul
                class="sub-menu lg:absolute z-50 lg:top-full lg:left-0 lg:min-w-[220px] lg:invisible lg:transition-all lg:bg-white lg:dark:bg-title lg:py-[15px] lg:pr-[30px]"
              >
                <li :class="current === '/' ? 'active' : ''">
                  <router-link to="/" class="menu-item"
                    >Home Minimal</router-link
                  >
                </li>
                <li :class="current === '/index-v2' ? 'active' : ''">
                  <router-link to="/index-v2" class="menu-item"
                    >Home Stylish</router-link
                  >
                </li>
                <li :class="current === '/index-v3' ? 'active' : ''">
                  <router-link to="/index-v3" class="menu-item"
                    >Home Accessories</router-link
                  >
                </li>
                <li :class="current === '/index-v4' ? 'active' : ''">
                  <router-link to="/index-v4" class="menu-item"
                    >Home Collection</router-link
                  >
                </li>
                <li :class="current === '/index-v5' ? 'active' : ''">
                  <router-link to="/index-v5" class="menu-item"
                    >Home Luxury</router-link
                  >
                </li>
                <li :class="current === '/index-v6' ? 'active' : ''">
                  <router-link to="/index-v6" class="menu-item"
                    >Home Retro</router-link
                  >
                </li>
              </ul>
            </li>
            <li
              :class="
                [
                  '/about',
                  '/pricing',
                  '/team',
                  '/our-clients',
                  '/faq',
                  '/terms-and-conditions',
                  '/portfolio-v1',
                  '/portfolio-v2',
                  '/portfolio-v3',
                  '/portfolio-details-v1',
                  '/portfolio-details-v2',
                  '/error',
                  '/my-profile',
                  '/login',
                  '/register',
                  '/forger-password',
                  '/coming-soon',
                  '/thank-you',
                  '/shipping-method',
                  '/payment-method',
                  '/invoice',
                  '/payment-confirmation',
                  '/payment-success',
                  '/payment-failure',
                ].includes(current)
                  ? 'active'
                  : ''
              "
            >
              <Link href="#">Pages<span></span></Link>
              <div
                class="mega-menu lg:absolute z-50 lg:top-full lg:left-1/2 lg:transform lg:-translate-x-1/2 lg:max-w-[1100px] lg:w-full lg:bg-white lg:dark:bg-title lg:px-[30px] lg:py-[15px] lg:flex lg:items-start lg:justify-between gap-[30px] lg:invisible lg:transition-all lg:duration-300"
              >
                <div
                  class="lg:grid lg:grid-cols-4 lg:items-start gap-x-5 2xl:gap-x-[25px] lg:flex-1"
                >
                  <div class="megamenu-item">
                    <ul>
                      <li :class="current === '/about' ? 'active' : ''">
                        <router-link to="/about">About Us</router-link>
                      </li>
                      <li :class="current === '/pricing' ? 'active' : ''">
                        <router-link to="/pricing">Price Plan</router-link>
                      </li>
                      <li :class="current === '/team' ? 'active' : ''">
                        <router-link to="/team">Team Member</router-link>
                      </li>
                      <li :class="current === '/our-clients' ? 'active' : ''">
                        <router-link to="/our-clients">Clients</router-link>
                      </li>
                      <li :class="current === '/faq' ? 'active' : ''">
                        <router-link to="/faq">FAQs</router-link>
                      </li>
                      <li
                        :class="
                          current === '/terms-and-conditions' ? 'active' : ''
                        "
                      >
                        <router-link to="/terms-and-conditions"
                          >Terms & conditions</router-link
                        >
                      </li>
                    </ul>
                  </div>
                  <div class="megamenu-item">
                    <ul>
                      <li :class="current === '/portfolio-v1' ? 'active' : ''">
                        <router-link to="/portfolio-v1"
                          >Portolfio 1</router-link
                        >
                      </li>
                      <li :class="current === '/portfolio-v2' ? 'active' : ''">
                        <router-link to="/portfolio-v2"
                          >Portolfio 2</router-link
                        >
                      </li>
                      <li :class="current === '/portfolio-v3' ? 'active' : ''">
                        <router-link to="/portfolio-v3"
                          >Portolfio 3</router-link
                        >
                      </li>
                      <li
                        :class="
                          current === '/portfolio-details-v1' ? 'active' : ''
                        "
                      >
                        <router-link to="/portfolio-details-v1"
                          >Portolfio details 1</router-link
                        >
                      </li>
                      <li
                        :class="
                          current === '/portfolio-details-v2' ? 'active' : ''
                        "
                      >
                        <router-link to="/portfolio-details-v2"
                          >Portolfio details 2</router-link
                        >
                      </li>
                      <li :class="current === '/error' ? 'active' : ''">
                        <router-link to="/error">404 Error</router-link>
                      </li>
                    </ul>
                  </div>
                  <div class="megamenu-item">
                    <ul>
                      <li :class="current === '/my-profile' ? 'active' : ''">
                        <router-link to="/my-profile">My Profile</router-link>
                      </li>
                      <li :class="current === '/login' ? 'active' : ''">
                        <router-link to="/login">Login</router-link>
                      </li>
                      <li :class="current === '/register' ? 'active' : ''">
                        <router-link to="/register">Register</router-link>
                      </li>
                      <li
                        :class="current === '/forger-password' ? 'active' : ''"
                      >
                        <router-link to="/forger-password"
                          >Forget Password</router-link
                        >
                      </li>
                      <li :class="current === '/coming-soon' ? 'active' : ''">
                        <router-link to="/coming-soon">Coming Soon</router-link>
                      </li>
                      <li :class="current === '/thank-you' ? 'active' : ''">
                        <router-link to="/thank-you">Thank you</router-link>
                      </li>
                    </ul>
                  </div>
                  <div class="megamenu-item">
                    <ul>
                      <li
                        :class="current === '/shipping-method' ? 'active' : ''"
                      >
                        <router-link to="/shipping-method"
                          >Shipping Method</router-link
                        >
                      </li>
                      <li
                        :class="current === '/payment-method' ? 'active' : ''"
                      >
                        <router-link to="/payment-method"
                          >Payment Method</router-link
                        >
                      </li>
                      <li :class="current === '/invoice' ? 'active' : ''">
                        <router-link to="/invoice">Invoice</router-link>
                      </li>
                      <li
                        :class="
                          current === '/payment-confirmation' ? 'active' : ''
                        "
                      >
                        <router-link to="/payment-confirmation"
                          >Payment Confirmation</router-link
                        >
                      </li>
                      <li
                        :class="current === '/payment-success' ? 'active' : ''"
                      >
                        <router-link to="/payment-success"
                          >Payment Completed</router-link
                        >
                      </li>
                      <li
                        :class="current === '/payment-failure' ? 'active' : ''"
                      >
                        <router-link to="/payment-failure"
                          >Payment Failure</router-link
                        >
                      </li>
                    </ul>
                  </div>
                </div>
                <div
                  class="lg:py-[15px] lg:max-w-[280px] w-full hidden lg:block"
                >
                  <router-link to="shop-v1.html">
                    <img :src="add" alt="mega-menu-add" />
                  </router-link>
                </div>
              </div>
            </li>
            <li
              class="relative"
              :class="
                [
                  '/shop-v1',
                  '/shop-v2',
                  '/shop-v3',
                  '/shop-v4',
                  '/product-details',
                  '/cart',
                  '/checkout',
                ].includes(current)
                  ? 'active'
                  : ''
              "
            >
              <router-link to="#">Shop<span></span></router-link>
              <ul
                class="sub-menu lg:absolute z-50 lg:top-full lg:left-0 lg:min-w-[220px] lg:invisible lg:transition-all lg:bg-white lg:dark:bg-title lg:py-[15px] lg:pr-[30px]"
              >
                <li :class="current === '/shop-v1' ? 'active' : ''">
                  <router-link to="/shop-v1">Shop Layout 01</router-link>
                </li>
                <li :class="current === '/shop-v2' ? 'active' : ''">
                  <router-link to="/shop-v2">Shop Layout 02</router-link>
                </li>
                <li :class="current === '/shop-v3' ? 'active' : ''">
                  <router-link to="/shop-v3">Shop Layout 03</router-link>
                </li>
                <li :class="current === '/shop-v4' ? 'active' : ''">
                  <router-link to="/shop-v4">Shop Layout 04</router-link>
                </li>
                <li :class="current === '/product-details' ? 'active' : ''">
                  <router-link to="/product-details"
                    >Product Details</router-link
                  >
                </li>
                <li :class="current === '/cart' ? 'active' : ''">
                  <router-link to="/cart">My Cart</router-link>
                </li>
                <li :class="current === '/checkout' ? 'active' : ''">
                  <router-link to="/checkout">Checkout</router-link>
                </li>
              </ul>
            </li>
            <li
              class="relative"
              :class="
                [
                  '/blog-v1',
                  '/blog-v2',
                  '/blog-details-v1',
                  '/blog-details-v2',
                  '/blog-details-v3',
                  '/blog-tag',
                ].includes(current)
                  ? 'active'
                  : ''
              "
            >
              <router-link to="#">Blog<span></span></router-link>
              <ul
                class="sub-menu lg:absolute z-50 lg:top-full lg:left-0 lg:min-w-[220px] lg:invisible lg:transition-all lg:bg-white lg:dark:bg-title lg:py-[15px] lg:pr-[30px]"
              >
                <li :class="current === '/blog-v1' ? 'active' : ''">
                  <router-link to="/blog-v1">Blog Layout 1</router-link>
                </li>
                <li :class="current === '/blog-v2' ? 'active' : ''">
                  <router-link to="/blog-v2">Blog Layout 2</router-link>
                </li>
                <li :class="current === '/blog-details-v1' ? 'active' : ''">
                  <router-link to="/blog-details-v1"
                    >Blog Details 1</router-link
                  >
                </li>
                <li :class="current === '/blog-details-v2' ? 'active' : ''">
                  <router-link to="/blog-details-v2"
                    >Blog Details 2</router-link
                  >
                </li>
                <li :class="current === '/blog-details-v3' ? 'active' : ''">
                  <router-link to="/blog-details-v3"
                    >Blog Details 3</router-link
                  >
                </li>
                <li :class="current === '/blog-tag' ? 'active' : ''">
                  <router-link to="/blog-tag">Blog Tag</router-link>
                </li>
              </ul>
            </li>
            <li :class="current === '/contact' ? 'active' : ''">
              <Link href="/contact">Contact</Link>
            </li>
            <li :class="current === '/login' ? 'active' : ''" class="lg:hidden">
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

<script setup>
import { computed, ref } from "vue";

import CartIcon from "~icons/mdi/cart-outline";
import CartList from "./CartList.vue";
import { Link, usePage } from "@inertiajs/vue3";
import { onClickOutside } from "@vueuse/core";
import MdiAccount from "~icons/mdi/account";

const cartList = ref(false);

const props = defineProps(["toggle"]);

const emit = defineEmits(["toggle-change"]);

const cart = computed(() => usePage().props.cart);

function handleToggle() {
  emit("toggle-change", !props.toggle);
}

const cartRef = ref(null);
const cartButtonRef = ref(null);

onClickOutside(cartRef, () => (cartList.value = false), {
  ignore: [cartButtonRef],
});
</script>
<template>
  <div class="flex items-center gap-4 sm:gap-6">
    <Link
      v-if="!$page.props.auth.user"
      :href="route('login')"
      class="text-lg leading-none text-title dark:text-white transition-all duration-300 hover:text-primary hidden lg:block"
      >Login</Link
    >
    <Link
      v-else
      :href="route('user.profile')"
      class="text-lg leading-none text-title dark:text-white transition-all duration-300 hover:text-primary hidden lg:block"
      ><MdiAccount
        class="text-title dark:text-white text-[24px] sm:text-[28px]"
    /></Link>

    <button
      class="relative hdr_cart_btn"
      @click="cartList = !cartList"
      ref="cartButtonRef"
    >
      <span
        class="absolute w-[22px] h-[22px] bg-secondary top-[0px] -right-[11px] rounded-full flex items-center justify-center text-xs leading-none text-white"
        >{{ cart.length ?? 0 }}</span
      >
      <CartIcon class="text-title dark:text-white text-[24px] sm:text-[28px]" />
    </button>
    <CartList ref="cartRef" :cartList="cartList" :cart="cart" />
    <button
      class="hamburger"
      :class="toggle ? 'opened' : ''"
      @click="handleToggle"
    >
      <svg
        class="stroke-current text-title dark:text-white"
        width="40"
        viewBox="0 0 100 100"
      >
        <path
          class="line line1"
          d="M 20,29.000046 H 80.000231 C 80.000231,29.000046 94.498839,28.817352 94.532987,66.711331 94.543142,77.980673 90.966081,81.670246 85.259173,81.668997 79.552261,81.667751 75.000211,74.999942 75.000211,74.999942 L 25.000021,25.000058"
        />
        <path class="line line2" d="M 20,50 H 80" />
        <path
          class="line line3"
          d="M 20,70.999954 H 80.000231 C 80.000231,70.999954 94.498839,71.182648 94.532987,33.288669 94.543142,22.019327 90.966081,18.329754 85.259173,18.331003 79.552261,18.332249 75.000211,25.000058 75.000211,25.000058 L 25.000021,74.999942"
        />
      </svg>
    </button>
  </div>
</template>

<style scoped>
.btn-line {
  margin: 0.25rem;
  height: 0.25rem;
  width: 1.5rem;
}

.nav-button.show .btn-line:nth-child(1) {
  transform: translateY(0.125rem) translateX(0.125rem) rotate(40deg);
}

.nav-button.show .btn-line:nth-child(2) {
  display: none;
}

.nav-button.show .btn-line:nth-child(3) {
  transform: translateY(-0.375rem) translateX(0.125rem) rotate(-40deg);
}

.nav-button {
  z-index: 1000;
}
</style>

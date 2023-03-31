<script setup>
import { ref } from "vue";
import { useIntervalFn } from "@vueuse/core";
import IconChevronRight from "~icons/mdi/chevron-right";
import IconChevronLeft from "~icons/mdi/chevron-left";
import { Link } from "@inertiajs/vue3";

const currentSlide = ref(1);

const { pause, resume, isActive } = useIntervalFn(() => {
  nextSlide();
}, 8000);

const nextSlide = () => {
  restartInterval();
  if (currentSlide.value >= 3) {
    currentSlide.value = 1;
    return;
  }
  currentSlide.value++;
};

const previousSlide = () => {
  restartInterval();
  if (currentSlide.value <= 1) {
    currentSlide.value = 3;
    return;
  }
  currentSlide.value--;
};

const restartInterval = () => {
  pause();
  resume();
};
</script>
<template>
  <section class="min-h-[700px] md:h-screen">
    <div class="w-full absolute top-1/2 z-40 flex justify-between mt-7 sm:mt-0">
      <button
        @click.prevent="previousSlide"
        class="ml-4 sm:ml-12 bg-zinc-300 rounded-full p-4 hover:bg-red-500 hover:text-white transition-colors duration-300 cursor-pointer"
      >
        <IconChevronLeft />
      </button>
      <button
        @click.prevent="nextSlide"
        class="mr-4 sm:mr-12 bg-zinc-300 rounded-full p-4 hover:bg-red-500 hover:text-white transition-colors duration-300 cursor-pointer"
      >
        <IconChevronRight />
      </button>
    </div>
    <transition name="fade" mode="out-in">
      <div
        v-if="currentSlide === 1"
        class="slide-1 flex items-center h-full bg-cover bg-no-repeat min-h-[700px]"
      >
        <div class="slide mx-auto flex-grow text-center md:text-start">
          <div class="max-w-xs md:max-w-md lg:max-w-3xl mx-auto lg:mx-0">
            <h5 class="text-gray-500 text-2xl md:text-4xl">
              <span class="font-semibold">FONMART</span>
              {{ new Date().getFullYear() }}
            </h5>
            <h3 class="uppercase text-red-500 font-bold text-4xl md:text-8xl">
              Repair it now
            </h3>
            <p class="text-gray-800 md:text-lg">
              Screen replacement is one of the most common repairs for mobile
              phones. If your screen is cracked or broken, it can be replaced by
              a professional technician.
            </p>
            <div class="mt-4">
              <Link
                as="button"
                :href="route('public.products')"
                class="btn-action bg-red-600 font-semibold text-white p-3 before:bg-blue-400"
              >
                SHOP NOW
              </Link>
            </div>
          </div>
        </div>
      </div>
      <div
        v-else-if="currentSlide === 2"
        class="slide-2 flex items-center h-full bg-cover bg-no-repeat min-h-[700px]"
      >
        <div class="slide mx-auto flex-grow text-center md:text-start">
          <div class="max-w-xs md:max-w-md lg:max-w-2xl mx-auto lg:mx-0">
            <h5 class="text-gray-500 text-2xl md:text-4xl">
              <span class="font-semibold">FONMART</span>
              {{ new Date().getFullYear() }}
            </h5>
            <h3 class="uppercase text-red-500 font-bold text-4xl md:text-8xl">
              Accessories
            </h3>
            <p class="text-gray-800 md:text-lg">
              Phone cases, Screen protectors, Power banks, Headphones, Bluetooth
              speakers, Selfie sticks, Charging cables.
            </p>
            <div class="mt-4">
              <Link
                as="button"
                :href="route('public.products')"
                class="btn-action bg-red-600 font-semibold text-white p-3 before:bg-blue-400"
              >
                SHOP NOW
              </Link>
            </div>
          </div>
        </div>
      </div>
      <div
        v-else-if="currentSlide === 3"
        class="slide-3 flex items-center h-full bg-cover bg-no-repeat min-h-[700px]"
      >
        <div class="slide mx-auto flex-grow text-center md:text-start">
          <div class="max-w-xs md:max-w-md lg:max-w-2xl mx-auto lg:mx-0">
            <h5 class="text-gray-500 text-2xl md:text-4xl">
              <span class="font-semibold">FONMART</span>
              {{ new Date().getFullYear() }}
            </h5>
            <h3 class="uppercase text-red-500 font-bold text-4xl md:text-8xl">
              Unlocking
            </h3>
            <p class="text-gray-800 md:text-lg">
              Carrier Unlock, iCloud Activation Lock, Jailbreak, Bootloader
              Unlock, Patter/PIN/Password Unlock, Bootloader Unlock.
            </p>
            <div class="mt-4">
              <Link
                as="button"
                :href="route('public.products')"
                class="btn-action bg-red-600 font-semibold text-white p-3 before:bg-blue-400"
              >
                SHOP NOW
              </Link>
            </div>
          </div>
        </div>
      </div>
    </transition>
  </section>
</template>
<style scoped>
.slide-1 {
  background-image: url("/images/banner_01.webp");
}

.slide-2 {
  background-image: url("/images/banner_02.webp");
}

.slide-3 {
  background-image: url("/images/banner_03.webp");
}

.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.5s ease;
}

.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}

.slide {
  max-width: 1200px;
}

@media screen and (min-width: 576px) {
  .slide {
    max-width: 540px;
  }
}
@media screen and (min-width: 768px) {
  .slide {
    max-width: 720px;
  }
}
@media screen and (min-width: 992px) {
  .slide {
    max-width: 960px;
  }
}
@media screen and (min-width: 1200px) {
  .slide {
    max-width: 1140px;
  }
}

h5,
h3,
p,
.btn-action {
  animation-name: fadeInUp;
  animation-duration: 500ms;
}

@keyframes fadeInUp {
  0% {
    opacity: 0;
    -webkit-transform: translateY(20px);
    -ms-transform: translateY(20px);
    transform: translateY(20px);
  }
  100% {
    opacity: 1;
    -webkit-transform: translateY(0);
    -ms-transform: translateY(0);
    transform: translateY(0);
  }
}
</style>

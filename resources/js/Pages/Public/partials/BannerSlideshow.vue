<script setup>
import { ref, watch } from "vue";
import { useIntervalFn } from "@vueuse/core";
import IconChevronRight from "~icons/mdi/chevron-right";
import IconChevronLeft from "~icons/mdi/chevron-left";
import { router } from "@inertiajs/vue3";
import { useLogoStore } from "@/store/logoStore";
import { usePointerSwipe } from "@vueuse/core";

const currentSlide = ref(1);

const { pause, resume, isActive } = useIntervalFn(() => {
  nextSlide();
}, 88000);

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

const logoStore = useLogoStore();

const slider = ref(null);

const { direction } = usePointerSwipe(slider, {
  onSwipeEnd: (e) => {
    if (direction.value === "LEFT") {
      nextSlide();
    }
    if (direction.value === "RIGHT") {
      previousSlide();
    }
  },
});

watch(
  () => currentSlide.value,
  () => {
    currentSlide.value === 2
      ? logoStore.toggleLogo("white.png")
      : logoStore.toggleLogo("red.png");
  }
);

router.on("start", () => {
  logoStore.$reset();
});
</script>
<template>
  <section ref="slider" class="min-h-[700px] md:h-screen">
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
      ></div>
      <div
        ref="redSlide"
        v-else-if="currentSlide === 2"
        class="slide-2 flex items-center h-full bg-cover bg-no-repeat min-h-[700px]"
      ></div>
      <div
        v-else-if="currentSlide === 3"
        class="slide-3 flex items-center h-full bg-cover bg-no-repeat min-h-[700px]"
      ></div>
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

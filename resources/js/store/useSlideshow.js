import { defineStore } from "pinia";

export const useSlideshowStore = defineStore("slideShow", () => {
  const currentSlide = ref(1);

  const nextSlide = () => {
    if (currentSlide)
      currentSlide.value++;
  };

  function $reset() {
    currentSlide.value = 1;
  }

  return {};
});

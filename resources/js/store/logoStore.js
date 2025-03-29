import { defineStore } from "pinia";
import { ref } from "vue";

export const useLogoStore = defineStore("logoStore", () => {
  const logo = ref("logo-min-resized.png");

  function toggleLogo(logoPic) {
    logo.value = logoPic;
  }

  function $reset() {
    logo.value = "logo-min-resized.png";
  }

  return { logo, toggleLogo, $reset };
});

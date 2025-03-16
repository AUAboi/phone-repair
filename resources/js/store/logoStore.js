import { defineStore } from "pinia";
import { ref } from "vue";

export const useLogoStore = defineStore("logoStore", () => {
  const logo = ref("red-logo.png");

  function toggleLogo(logoPic) {
    logo.value = logoPic;
  }

  function $reset() {
    logo.value = "red-logo.png";
  }

  return { logo, toggleLogo, $reset };
});

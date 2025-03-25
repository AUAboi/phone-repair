import { defineStore } from "pinia";
import { ref } from "vue";

export const useLogoStore = defineStore("logoStore", () => {
  const logo = ref("logo.png");

  function toggleLogo(logoPic) {
    logo.value = logoPic;
  }

  function $reset() {
    logo.value = "logo.png";
  }

  return { logo, toggleLogo, $reset };
});

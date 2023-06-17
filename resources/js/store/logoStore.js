import { defineStore } from "pinia"
import { ref } from "vue"

export const useLogoStore = defineStore('logoStore', () => {

  const logo = ref("red.png")

  function toggleLogo(logoPic) {
    logo.value = logoPic
  }

  function $reset() {
    logo.value = "red.png"
  }

  return { logo, toggleLogo, $reset }
})

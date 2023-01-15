<template>
  <header class="text-gray-600 body-font shadow-md">

  </header>
</template>

<style scoped>
.animated-menu {
  animation-fill-mode: both;
  animation-name: slideInUp-30;
  animation-duration: .3s;
  -webkit-animation-duration: .3s;
  -webkit-animation-fill-mode: both;
  -webkit-animation-name: slideInUp-30;
}

@keyframes slideInUp-30 {
  0% {
    -webkit-transform: translate3d(0, 30px, 0);
    transform: translate3d(0, 30px, 0);
    opacity: 0;
    visibility: visible;
  }

  100% {
    -webkit-transform: translate3d(0, 0, 0);
    opacity: 1;
    transform: translate3d(0, 0, 0);
  }
}
</style>
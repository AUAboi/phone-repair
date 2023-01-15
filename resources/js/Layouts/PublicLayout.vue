<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';

</script>
<template>
  <header class="text-gray-600 body-font">
    <div
      class="container mx-auto flex flex-wrap sm:p-5 flex-col md:flex-row justify-between items-center bg-white bg-opacity-70 z-50">
      <div class="sm:flex justify-center mt-8 sm:mt-2 md:mt-0">
        <ApplicationLogo class="max-h-7" />
      </div>
      <nav
        class="navbar md:mr-auto md:flex md:flex-wrap md:items-center text-base md:justify-center z-40 md:p-5 lg:px-1 font-semibold">
        <a id="link1" href="#unternehmen" class="navb">UNTERNEHMEN</a>
        <a id="link3" href="#karriere" class="navb">KARRIERE</a>
        <a id="link2" href="#produkte" class="navb">PRODUKTE</a>
        <a id="link4" href="#impressum" class="navb">IMPRESSUM</a>
      </nav>

      <div
        class="nav-button fixed sm:hidden rounded-md right-4 top-8 md:right-10 md:top-6 z-50 cursor-pointer transition-all ease-in-out duration-500 ">
        <div id="line1" class="bg-pink-500 btn-line transition-all ease-out"></div>
        <div id="line2" class="bg-pink-500 btn-line transition-all ease-out"></div>
        <div id="line3" class="bg-pink-500 btn-line transition-all ease-out"></div>
      </div>
    </div>
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

.btn-line {
  margin: 0.25rem;
  height: 0.25rem;
  width: 1.5rem;
}

@media screen and (max-width: 639px) {
  .navbar {
    position: fixed;
    top: -100%;
    position: fixed;
    display: flex;
    flex-direction: column;
    width: 100%;
    background-color: #00478a;
    color: #fff;
    height: 100%;
    transition: all 500ms ease;
    justify-content: center;
    align-items: center;
    justify-content: space-around;
  }
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
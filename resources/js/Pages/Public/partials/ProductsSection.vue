<script setup>
import bed from "@/assets/img/svg/bed.svg";
import MdiStar from "~icons/mdi/star";
import MdiEyeOutline from "~icons/mdi/eye-outline";
import product1 from "@/assets/img/home-v1/ftur-pdct-01.jpg";
import product2 from "@/assets/img/home-v1/ftur-pdct-02.jpg";
import MdiCartOutline from "~icons/mdi/cart-outline";

const props = defineProps(["products"]);
</script>
<template>
  <div class="s-py-100-50">
    <div class="container-fluid">
      <div
        class="max-w-xl mx-auto mb-8 md:mb-12 text-center"
        data-aos="fade-up"
      >
        <div>
          <img :src="bed" class="mx-auto w-14 sm:w-24" alt="" />
        </div>
        <h3 class="leading-none mt-4 md:mt-6 text-2xl md:text-3xl">
          Featured Products
        </h3>
        <p class="mt-3">
          Discover our handpicked selection of standout products. Elevate your
          lifestyle with our top picks that combine quality, style, and
          innovation.
        </p>
      </div>
      <div
        class="max-w-[1720px] mx-auto flex gap-5 sm:gap-8 flex-col lg:flex-row"
        data-aos="fade-up"
        data-aos-delay="100"
      >
        <div class="grid sm:grid-cols-2 gap-5 sm:gap-8 lg:max-w-[766px] w-full">
          <div v-for="(item, index) in products" :key="index" class="group">
            <div class="relative overflow-hidden">
              <router-link :to="`/product-details/${item.id}`">
                <img
                  class="w-full transform group-hover:scale-110 duration-300"
                  :src="item.image"
                  alt="shop"
                />
              </router-link>

              <div
                class="absolute z-10 top-[50%] right-3 transform -translate-y-[40%] opacity-0 duration-300 transition-all group-hover:-translate-y-1/2 group-hover:opacity-100 flex flex-col items-end gap-3"
              >
                <router-link
                  to="#"
                  class="bg-white dark:bg-title dark:text-white bg-opacity-80 flex items-center justify-center gap-2 px-4 py-[10px] text-base leading-none text-title rounded-[40px] h-14 overflow-hidden new-product-icon"
                >
                  <MdiCartOutline class="dark:text-white text-[24px]" /><span
                    class="mt-1"
                    >Add to Cart</span
                  >
                </router-link>
                <button
                  class="bg-white dark:bg-title dark:text-white bg-opacity-80 flex items-center justify-center gap-2 px-4 py-[10px] text-base leading-none text-title rounded-[40px] h-14 overflow-hidden new-product-icon quick-view"
                >
                  <MdiEyeOutline class="dark:text-white text-[24px]" />
                  <span class="mt-1">Quick View</span>
                </button>
              </div>
            </div>
            <div
              class="md:px-2 lg:px-4 xl:px-6 lg:pt-6 pt-5 flex gap-4 md:gap-5 flex-col"
            >
              <h4 class="font-medium leading-none dark:text-white text-lg">
                {{ item.formatted_price }}
              </h4>
              <div>
                <h5 class="font-normal dark:text-white text-xl leading-[1.5]">
                  <router-link
                    :to="`/product-details/${item.id}`"
                    class="text-underline"
                  >
                    {{ item.name }}
                  </router-link>
                </h5>
                <ul class="flex items-center gap-2 mt-1">
                  <li>
                    <MdiStar class="text-[#EE9818] text-[14px]" />
                  </li>
                  <li>
                    <MdiStar class="text-[#EE9818] text-[14px]" />
                  </li>
                  <li>
                    <MdiStar class="text-[#EE9818] text-[14px]" />
                  </li>
                  <li>
                    <MdiStar class="text-[#EE9818] text-[14px]" />
                  </li>

                  <li>
                    <MdiStar class="text-slate-300 text-[14px]" />
                  </li>
                  <li class="dark:text-gray-100">( 1,230 )</li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="grid sm:grid-cols-2 gap-5 sm:gap-8 lg:max-w-[925px] w-full">
          <div class="group flex flex-col">
            <div class="relative overflow-hidden flex-1">
              <router-link to="/product-details">
                <img
                  class="w-full transform group-hover:scale-110 duration-300 h-full object-cover"
                  :src="product1"
                  alt="product-card"
                />
              </router-link>

              <div
                class="absolute z-10 top-[50%] right-3 transform -translate-y-[40%] opacity-0 duration-300 transition-all group-hover:-translate-y-1/2 group-hover:opacity-100 flex flex-col items-end gap-3"
              >
                <router-link
                  to="#"
                  class="bg-white dark:bg-title dark:text-white bg-opacity-80 flex items-center justify-center gap-2 px-4 py-[10px] text-base leading-none text-title rounded-[40px] h-14 overflow-hidden new-product-icon"
                >
                  <MdiCartOutline class="dark:text-white text-[24px]" /><span
                    class="mt-1"
                    >Add to Cart</span
                  >
                </router-link>
                <button
                  class="bg-white dark:bg-title dark:text-white bg-opacity-80 flex items-center justify-center gap-2 px-4 py-[10px] text-base leading-none text-title rounded-[40px] h-14 overflow-hidden new-product-icon quick-view"
                >
                  <MdiEyeOutline class="dark:text-white text-[24px]" />
                  <span class="mt-1">Quick View</span>
                </button>
              </div>
            </div>
            <div class="lg:pt-6 pt-5 flex gap-3 md:gap-4 flex-col">
              <h4 class="font-medium leading-none dark:text-white text-lg">
                $122.75
                <span class="text-title/50 line-through pl-2 inline-block"
                  >$140.99</span
                >
              </h4>
              <div>
                <h5 class="font-normal dark:text-white text-xl leading-[1.5]">
                  <router-link to="/product-details" class="text-underline">
                    Convertible Sofa
                  </router-link>
                </h5>
                <ul class="flex items-center gap-2 mt-1">
                  <li>
                    <MdiStar class="text-[#EE9818] text-[14px]" />
                  </li>
                  <li>
                    <MdiStar class="text-[#EE9818] text-[14px]" />
                  </li>
                  <li>
                    <MdiStar class="text-[#EE9818] text-[14px]" />
                  </li>
                  <li>
                    <MdiStar class="text-[#EE9818] text-[14px]" />
                  </li>

                  <li>
                    <MdiStar class="text-slate-300 text-[14px]" />
                  </li>
                  <li class="dark:text-gray-100">( 1,230 )</li>
                </ul>
              </div>
            </div>
          </div>
          <div class="group flex flex-col">
            <div class="relative overflow-hidden flex-1">
              <router-link to="/product-details">
                <img
                  class="w-full transform group-hover:scale-110 duration-300 h-full object-cover"
                  :src="product2"
                  alt="product-card"
                />
              </router-link>

              <div
                class="absolute z-10 top-[50%] right-3 transform -translate-y-[40%] opacity-0 duration-300 transition-all group-hover:-translate-y-1/2 group-hover:opacity-100 flex flex-col items-end gap-3"
              >
                <router-link
                  to="#"
                  class="bg-white dark:bg-title dark:text-white bg-opacity-80 flex items-center justify-center gap-2 px-4 py-[10px] text-base leading-none text-title rounded-[40px] h-14 overflow-hidden new-product-icon"
                >
                  <MdiCartOutline class="dark:text-white text-[24px]" /><span
                    class="mt-1"
                    >Add to Cart</span
                  >
                </router-link>
                <button
                  class="bg-white dark:bg-title dark:text-white bg-opacity-80 flex items-center justify-center gap-2 px-4 py-[10px] text-base leading-none text-title rounded-[40px] h-14 overflow-hidden new-product-icon quick-view"
                >
                  <MdiEyeOutline class="dark:text-white text-[24px]" />
                  <span class="mt-1">Quick View</span>
                </button>
              </div>
            </div>
            <div class="lg:pt-6 pt-5 flex gap-3 md:gap-4 flex-col">
              <h4 class="font-medium leading-none dark:text-white text-lg">
                $122.75 - $140.99
              </h4>
              <div>
                <h5 class="font-normal dark:text-white text-xl leading-[1.5]">
                  <router-link to="/product-details" class="text-underline">
                    Flower vase for Table
                  </router-link>
                </h5>
                <ul class="flex items-center gap-2 mt-1">
                  <li>
                    <MdiStar class="text-[#EE9818] text-[14px]" />
                  </li>
                  <li>
                    <MdiStar class="text-[#EE9818] text-[14px]" />
                  </li>
                  <li>
                    <MdiStar class="text-[#EE9818] text-[14px]" />
                  </li>
                  <li>
                    <MdiStar class="text-[#EE9818] text-[14px]" />
                  </li>

                  <li>
                    <MdiStar class="text-slate-300 text-[14px]" />
                  </li>
                  <li class="dark:text-gray-100">( 1,230 )</li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
.list-click:hover:before,
li.list-click.active:before,
.list-click:before {
  left: 0px;
  width: 100%;
  right: auto;
}

.list-click:before {
  width: 0px;
  left: auto;
  right: 0px;
  z-index: -1;
  bottom: 0px;
  height: 2px;
  content: "";
  position: absolute;
  background: #ed1d24;
  transition: width 0.3s linear;
}

li.list-click:hover,
li.list-click.active {
  color: #ed1d24;
}

li.list-click {
  z-index: 1;
  line-height: 1;
  display: block;
  font-size: 18px;
  font-weight: 700;
  position: relative;
  padding-bottom: 2px;
  color: #2e2e2e;
  text-transform: uppercase;
  transition: 300ms;
}
</style>

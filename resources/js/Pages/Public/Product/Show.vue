<script setup>
import { ref, computed, watch, onMounted } from "vue";
import MdiFacebook from "~icons/mdi/facebook";
import MdiTwitter from "~icons/mdi/twitter";
import MdiInstagram from "~icons/mdi/instagram";
import product1 from "@/assets/img/gallery/product-detls/product-01.jpg";
import product2 from "@/assets/img/gallery/product-detls/product-02.jpg";
import product3 from "@/assets/img/gallery/product-detls/product-03.jpg";
import product4 from "@/assets/img/gallery/product-detls/product-04.jpg";

import Aos from "aos";
import LayoutOne from "@/Components/template/layout-one.vue";
import IncDec from "./partials/inc-dec.vue";
import DetailTab from "./partials/detail-tab.vue";
import { Head, Link } from "@inertiajs/vue3";

const props = defineProps(["product", "products"]);

onMounted(() => {
  Aos.init();
});

const activeImage = ref(1);
</script>

<template>
  <Head :title="product.name" />
  <div class="s-py-50" data-aos="fade-up">
    <div class="container-fluid">
      <div
        class="max-w-[1720px] mx-auto flex justify-between gap-10 flex-col lg:flex-row"
      >
        <div class="w-full lg:w-[58%]">
          <div class="relative product-dtls-wrapper h-full">
            <div class="product-dtls-slider">
              <div>
                <img
                  :src="product && product.image ? product.image : product1"
                  alt="product"
                  class="w-full"
                  :class="activeImage === 1 ? '' : 'hidden'"
                />
              </div>
              <div>
                <img
                  :src="product2"
                  alt="product"
                  :class="activeImage === 2 ? '' : 'hidden'"
                />
              </div>
              <div>
                <img
                  :src="product3"
                  alt="product"
                  :class="activeImage === 3 ? '' : 'hidden'"
                />
              </div>
              <div>
                <img
                  :src="product4"
                  alt="product"
                  :class="activeImage === 4 ? '' : 'hidden'"
                />
              </div>
            </div>
            <div class="product-dtls-nav">
              <div class="cursor-pointer">
                <img
                  :src="product && product.image ? product.image : product1"
                  @click="activeImage = 1"
                  alt="product"
                  class="mb-2"
                />
              </div>
              <div class="cursor-pointer">
                <img
                  :src="product2"
                  @click="activeImage = 2"
                  alt="product"
                  class="mb-2"
                />
              </div>
              <div class="cursor-pointer">
                <img
                  :src="product3"
                  @click="activeImage = 3"
                  alt="product"
                  class="mb-2"
                />
              </div>
              <div class="cursor-pointer">
                <img
                  :src="product4"
                  @click="activeImage = 4"
                  alt="product"
                  class="mb-2"
                />
              </div>
            </div>
          </div>
        </div>
        <div class="lg:max-w-[635px] w-full">
          <div
            class="pb-4 sm:pb-6 border-b border-bdr-clr dark:border-bdr-clr-drk"
          >
            <h2 class="font-semibold leading-none">
              {{
                product && product.name
                  ? product.name
                  : "Classic Relaxable Chair"
              }}
            </h2>
            <div class="flex gap-4 items-center mt-[15px]">
              <span
                class="text-2xl sm:text-3xl text-primary leading-none block"
                >{{ product.formatted_price }}</span
              >
            </div>

            <p
              v-html="product.body"
              class="sm:text-lg mt-5 md:mt-7 max-h-[320px] overflow-hidden"
            ></p>
            <div class="mt-5 md:mt-6">
              <a
                class="font-medium text-base text-title md:text-[17px] leading-none py-[15px] px-5 relative z-10 before:absolute before:bottom-0 before:left-0 before:bg-primary-midum before:w-full before:h-2/4 before:-z-10 blog-btn-hover before:transition-all before:duration-300 dark:text-white inline-block"
                href="#details"
                >Read More</a
              >
            </div>
          </div>
          <div
            class="py-4 sm:py-6 border-b border-bdr-clr dark:border-bdr-clr-drk"
            data-aos="fade-up"
            data-aos-delay="200"
          >
            <IncDec />

            <div class="flex gap-4 mt-4 sm:mt-6">
              <router-link
                to="/cart"
                class="btn btn-solid"
                data-text="Add to Cart"
              >
                <span>Add to Cart</span>
              </router-link>
              <router-link
                to="#"
                class="btn btn-outline"
                data-text="Add to Wishlist"
              >
                <span>Add to Wishlist</span>
              </router-link>
            </div>
          </div>
          <div
            class="py-4 sm:py-6 border-b border-bdr-clr dark:border-bdr-clr-drk"
            data-aos="fade-up"
            data-aos-delay="300"
          >
            <div class="flex gap-x-12 gap-y-3 flex-wrap">
              <h6 class="leading-none font-medium">SKU : CH_0015</h6>
              <h6 class="leading-none font-medium">
                Category : {{ product.category.name }}
              </h6>
            </div>
            <div
              class="flex gap-x-12 lg:gap-x-24 gap-y-3 flex-wrap mt-5 sm:mt-10"
            >
              <div class="flex gap-[10px] items-center">
                <h6 class="leading-none font-medium">Size :</h6>
                <div class="flex gap-[10px]">
                  <label class="product-size">
                    <input
                      class="appearance-none hidden"
                      type="radio"
                      name="size"
                      checked
                    />
                    <span
                      class="w-6 h-6 flex items-center justify-center pt-[2px] text-sm leading-none bg-[#E8E9EA] dark:bg-dark-secondary text-title dark:text-white duration-300"
                      >S</span
                    >
                  </label>
                  <label class="product-size">
                    <input
                      class="appearance-none hidden"
                      type="radio"
                      name="size"
                    />
                    <span
                      class="w-6 h-6 flex items-center justify-center pt-[2px] text-sm leading-none bg-[#E8E9EA] dark:bg-dark-secondary text-title dark:text-white duration-300"
                      >M</span
                    >
                  </label>
                  <label class="product-size">
                    <input
                      class="appearance-none hidden"
                      type="radio"
                      name="size"
                    />
                    <span
                      class="w-6 h-6 flex items-center justify-center pt-[2px] text-sm leading-none bg-[#E8E9EA] dark:bg-dark-secondary text-title dark:text-white duration-300"
                      >L</span
                    >
                  </label>
                  <label class="product-size">
                    <input
                      class="appearance-none hidden"
                      type="radio"
                      name="size"
                    />
                    <span
                      class="w-6 h-6 flex items-center justify-center pt-[2px] text-sm leading-none bg-[#E8E9EA] dark:bg-dark-secondary text-title dark:text-white duration-300"
                      >XL</span
                    >
                  </label>
                </div>
              </div>
              <div class="flex gap-[10px] items-center">
                <h6 class="leading-none font-medium">Color :</h6>
                <div class="flex gap-[10px] items-center">
                  <label class="product-color">
                    <input
                      class="appearance-none hidden"
                      type="radio"
                      name="color"
                    />
                    <span
                      class="border border-[#D68553] flex rounded-full border-opacity-0 duration-300 p-1"
                    >
                      <span
                        class="w-4 h-4 rounded-full bg-[#D68553] flex"
                      ></span>
                    </span>
                  </label>
                  <label class="product-color">
                    <input
                      class="appearance-none hidden"
                      type="radio"
                      name="color"
                      checked
                    />
                    <span
                      class="border border-[#61646E] flex rounded-full border-opacity-0 duration-300 p-1"
                    >
                      <span
                        class="w-4 h-4 rounded-full bg-[#61646E] flex"
                      ></span>
                    </span>
                  </label>
                  <label class="product-color">
                    <input
                      class="appearance-none hidden"
                      type="radio"
                      name="color"
                    />
                    <span
                      class="border border-[#E9E3DC] flex rounded-full border-opacity-0 duration-300 p-1"
                    >
                      <span
                        class="w-4 h-4 rounded-full bg-[#E9E3DC] flex"
                      ></span>
                    </span>
                  </label>
                  <label class="product-color">
                    <input
                      class="appearance-none hidden"
                      type="radio"
                      name="color"
                    />
                    <span
                      class="border border-[#9A9088] flex rounded-full border-opacity-0 duration-300 p-1"
                    >
                      <span
                        class="w-4 h-4 rounded-full bg-[#9A9088] flex"
                      ></span>
                    </span>
                  </label>
                </div>
              </div>
            </div>
          </div>
          <div
            class="py-4 sm:py-6 border-b border-bdr-clr dark:border-bdr-clr-drk"
            data-aos="fade-up"
            data-aos-delay="400"
          >
            <h4 class="font-medium leading-none">Tags :</h4>
            <div class="flex flex-wrap gap-[10px] md:gap-[15px] mt-5 md:mt-6">
              <router-link
                class="btn btn-theme-outline btn-xs"
                to="#"
                data-text="Chair"
                ><span>Chair</span></router-link
              >
              <router-link
                class="btn btn-theme-outline btn-xs"
                to="#"
                data-text="Art & Paint"
                ><span>Art & Paint</span></router-link
              >
              <router-link
                class="btn btn-theme-outline btn-xs"
                to="#"
                data-text="Mirror"
                ><span>Mirror</span></router-link
              >
              <router-link
                class="btn btn-theme-outline btn-xs"
                to="#"
                data-text="Table"
                ><span>Table</span></router-link
              >
              <router-link
                class="btn btn-theme-outline btn-xs"
                to="#"
                data-text="Lamp"
                ><span>Lamp</span></router-link
              >
            </div>
          </div>
          <div class="pt-4 sm:pt-6" data-aos="fade-up" data-aos-delay="500">
            <div class="flex items-center gap-6">
              <h6 class="font-normal">Share :</h6>
              <div class="flex gap-6">
                <Link
                  href="#"
                  class="text-paragraph duration-300 dark:text-white hover:text-primary dark:hover:text-primary"
                >
                  <MdiFacebook />
                </Link>
                <Link
                  href="#"
                  class="text-paragraph duration-300 dark:text-white hover:text-primary dark:hover:text-primary"
                >
                  <MdiTwitter />
                </Link>
                <Link
                  href="#"
                  class="text-paragraph duration-300 dark:text-white hover:text-primary dark:hover:text-primary"
                >
                  <MdiInstagram />
                </Link>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div id="details" class="s-py-50">
    <DetailTab :product="product" />
  </div>

  <div class="s-py-50-100">
    <div class="container-fluid">
      <div class="max-w-[547px] mx-auto text-center">
        <h6 class="text-2xl sm:text-3xl md:text-4xl leading-none">
          Related Products
        </h6>
        <p class="mt-3">
          Explore complementary options that enhance your experience. Discover
          related products curated just for you.
        </p>
      </div>
      <LayoutOne
        :classList="'max-w-[1720px] mx-auto grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5 sm:gap-8 pt-8 md:pt-[50px]'"
        :productList="products.slice(0, 4)"
      />
    </div>
  </div>
</template>

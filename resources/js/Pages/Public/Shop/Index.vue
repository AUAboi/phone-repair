<script setup>
import { onMounted, ref } from "vue";
import LayoutOne from "@/Components/template/layout-one.vue";
import bg from "@/assets/img/shortcode/breadcumb.jpg";
import Aos from "aos";
import { Head, Link } from "@inertiajs/vue3";

const props = defineProps(["products", "categories"]);

onMounted(() => {
  Aos.init();
});

const isOpen = ref(false);
const selectedOption = ref("Navana Furniture");

const options = [
  "Navana Furniture",
  "RFL Furniture",
  "Gazi Furniture",
  "Plastic Furniture",
  "Luxury Furniture",
];

const toggleDropdown = () => {
  isOpen.value = !isOpen.value;
};

const handleSelect = (option, event) => {
  event.stopPropagation();
  selectedOption.value = option;
  isOpen.value = false;
};
</script>
<template>
  <Head title="Shop" />
  <div>
    <div
      class="flex items-center gap-4 flex-wrap bg-overlay p-14 sm:p-16 before:bg-title before:bg-opacity-70"
      :style="{ backgroundImage: 'url(' + bg + ')' }"
    >
      <div class="text-center w-full">
        <h2
          class="text-white text-8 md:text-[40px] font-normal leading-none text-center"
        >
          Shop
        </h2>
        <ul
          class="flex items-center justify-center gap-[10px] text-base md:text-lg leading-none font-normal text-white mt-3 md:mt-4"
        >
          <li><router-link to="/">Home</router-link></li>
          <li>/</li>
          <li class="text-primary">Shop</li>
        </ul>
      </div>
    </div>

    <div class="s-py-100">
      <div class="container-fluid">
        <div
          class="flex items-start justify-between gap-8 max-w-[1720px] mx-auto flex-col lg:flex-row border-b border-bdr-clr dark:border-bdr-clr-drk pb-8 md:pb-[50px]"
        >
          <div>
            <h4
              class="font-medium leading-none text-xl sm:text-2xl mb-5 sm:mb-6"
            >
              Choose Category
            </h4>
            <div class="flex flex-wrap gap-[10px] md:gap-[15px]">
              <Link
                v-for="category in categories"
                :key="category.id"
                class="btn btn-theme-outline btn-sm shop1-button"
                :href="`/${category.slug}`"
                :data-text="category.name"
                ><span>{{ category.name }}</span></Link
              >
            </div>
          </div>
          <div class="max-w-[562px] w-full grid sm:grid-cols-2 gap-8 md:gap-12">
            <div>
              <h4
                class="font-medium leading-none text-xl sm:text-2xl mb-5 sm:mb-6"
              >
                Choose Brand
              </h4>
              <div
                class="nice-select bg-white dark:bg-dark outline-select small-select"
                :class="isOpen ? 'open' : ''"
                @click="toggleDropdown"
              >
                <span class="current">{{ selectedOption }}</span>
                <ul class="list">
                  <li
                    v-for="(item, index) in options"
                    :key="index"
                    data-value="1"
                    class="option"
                    @click="handleSelect(item, $event)"
                  >
                    {{ item }}
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>

        <div data-aos="fade-up" data-aos-delay="200">
          <LayoutOne
            :classList="'max-w-[1720px] mx-auto grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5 sm:gap-8 pt-8 md:pt-[50px]'"
            :productList="products"
          />
        </div>
      </div>
    </div>
  </div>
</template>

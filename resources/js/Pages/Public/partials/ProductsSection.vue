<script setup>
import "vue3-carousel/dist/carousel.css";
import ProductModal from "@/Components/ProductModal.vue";
import { ref, computed } from "vue";
import { Carousel, Navigation, Pagination, Slide } from "vue3-carousel";
import { useArrayFind } from "@vueuse/shared";

const props = defineProps(["categories"]);

const currentActive = ref(0);

const currentDevice = ref(0);

const modalToggle = ref(false);

const devices = computed(() => {
  return props.categories[currentActive.value]?.products;
});

const toggledDevice = computed(() => {
  return devices.value[currentDevice.value];
});

const openDevice = (i, j) => {
  currentActive.value = i;
  currentDevice.value = j;
  modalToggle.value = true;
};

const settings = {
  itemsToShow: 1,
  snapAlign: "center",
};

const breakpoints = {
  700: {
    itemsToShow: 2,
    snapAlign: "center",
  },
  1024: {
    itemsToShow: 3,
    snapAlign: "start",
  },
};
</script>
<template>
  <section>
    <div class="container mx-auto px-5 py-24">
      <h4 class="text-6xl text-center font-bold">Products We Offer</h4>
      <div v-for="(category, i) in categories" :key="category.id" class="mt-16">
        <h3 class="text-xl text-red-600 font-semibold text-center pb-8">
          {{ category.name }}
        </h3>
        <div>
          <Carousel
            :autoplay="2000"
            :breakpoints="breakpoints"
            :settings="settings"
          >
            <Slide v-for="(product, j) in category.products" :key="product.id">
              <div class="cursor-pointer" @click="openDevice(i, j)">
                <div>
                  <img
                    class="h-64 w-52 rounded-2xl"
                    :src="product.image"
                    alt=""
                  />
                </div>
                <h4 class="text-lg font-semibold pt-4">{{ product.name }}</h4>
              </div>
            </Slide>

            <template #addons>
              <Navigation />
              <Pagination />
            </template>
          </Carousel>
        </div>
      </div>
    </div>
    <ProductModal
      @close="modalToggle = false"
      :modal-toggle="modalToggle"
      :product="toggledDevice"
    />
  </section>
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

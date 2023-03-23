<script setup>
import Modal from "@/Components/Modal.vue";
import ProductModal from "@/Components/ProductModal.vue";
import { Head, Link } from "@inertiajs/vue3";
import { ref, computed } from "vue";
import CloseCircle from "~icons/mdi/close-circle";

const props = defineProps(["products"]);

const currentDevice = ref(0);

const modalToggle = ref(false);

const toggledDevice = computed(() => {
  return props.products[currentDevice.value];
});

const openDevice = (index) => {
  currentDevice.value = index;
  modalToggle.value = true;
};
</script>

<template>
  <Head title="Products" />
  <section>
    <Link :href="route('public.repairs')" class="banner block"> </Link>
  </section>

  <section class="text-gray-600 body-font pt-9 pb-6">
    <div class="container px-5 py-24 mx-auto">
      <div class="flex flex-wrap -m-4">
        <div
          class="lg:w-1/4 md:w-1/2 p-4 w-full"
          v-for="(product, index) in products"
          @click="openDevice(index)"
        >
          <a class="block relative h-48 rounded overflow-hidden">
            <img
              :alt="product.name"
              class="object-cover object-center w-full h-full block transition-all duration-500 hover:scale-75 hover:object-contain"
              :src="product.image"
            />
          </a>
          <div class="mt-4">
            <h3 class="text-gray-500 text-xs tracking-widest title-font mb-1">
              {{ product.category.name }}
            </h3>
            <h2 class="text-gray-900 title-font text-lg font-medium">
              {{ product.name }}
            </h2>
            <p class="mt-1">$16.00</p>
          </div>
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
.banner {
  background-image: url("/images/cover-web-02.jpg");
  background-size: cover;
  background-repeat: no-repeat;
  padding: 16rem 2rem;
}

@media screen and (max-width: 1380px) {
  .banner {
    padding: 10rem 2rem;
  }
}

@media screen and (max-width: 860px) {
  .banner {
    background-image: url("/images/cover-web-02.jpg");
    height: 400px;
    background-position: 50% 50%;
    padding: 0;
    background-size: cover;
  }
}
</style>

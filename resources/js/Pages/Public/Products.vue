<script setup>
import Modal from "@/Components/Modal.vue";
import { Head, Link } from "@inertiajs/vue3";
import { ref, computed } from "vue";

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
  <section class="pt-9 pb-6">
    <h4 class="text-6xl text-center font-bold mb-6">Products We Offer</h4>
    <div class="max-w-7xl mx-auto">
      <div class="grid gap-8 grid-cols-4">
        <div
          class="group cursor-pointer"
          v-for="(product, index) in products"
          :key="product.id"
          @click="openDevice(index)"
        >
          <img :src="product.image" class="h-56 mx-auto" :alt="product.name" />
          <div style="background-color: rgb(240, 238, 238)" class="px-5 py-4">
            <h4
              class="uppercase group-hover:text-red-500 transition-colors duration-300 text-2xl font-medium"
            >
              {{ product.name }}
            </h4>
            <h5 class="font-bold text-xl">{{ product.formatted_price }}</h5>
          </div>
        </div>
      </div>
    </div>
    <Modal
      class="h-full"
      max-width="2xl"
      :show="modalToggle"
      @close="modalToggle = false"
    >
      <div class="flex flex-col justify-between relative">
        <div
          @click="modalToggle = false"
          class="text-red-400 cursor-pointer hover:text-red-500 text-3xl absolute top-2 right-2"
        >
          <CloseCircle />
        </div>
        <div class="">
          <img
            class="mx-auto max-h-96"
            :src="toggledDevice.image"
            :alt="toggledDevice.name"
          />
        </div>
        <div class="p-6 m-auto w-full">
          <h1 class="font-medium text-4xl">{{ toggledDevice.name }}</h1>

          <p class="text-3xl font-semibold text-red-500 tracking-wider">
            {{ toggledDevice.formatted_price }}
          </p>

          <div class="pt-8">
            <h4 class="text-2xl font-semibold">Description</h4>
            <div v-html="toggledDevice.body"></div>
          </div>
          <div class="py-6">
            <Link
              as="button"
              :href="route('public.appointments.create', toggledDevice.id)"
              class="btn-action px-4 py-1 text-white text-xl bg-red-500 border before:bg-black-500"
            >
              Buy Now
            </Link>
          </div>
        </div>
      </div>
    </Modal>
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

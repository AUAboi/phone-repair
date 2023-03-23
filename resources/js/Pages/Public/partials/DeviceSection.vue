<script setup>
import Modal from "@/Components/Modal.vue";
import ProductModal from "@/Components/ProductModal.vue";
import { Link } from "@inertiajs/vue3";
import { ref, computed } from "vue";
import CloseCircle from "~icons/mdi/close-circle";

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

const openDevice = (index) => {
  currentDevice.value = index;
  modalToggle.value = true;
};
</script>
<template>
  <section>
    <div class="container mx-auto px-5 py-24">
      <h4 class="text-6xl text-center font-bold">Products We Offer</h4>
      <ul class="flex flex-wrap justify-center mt-8 gap-6">
        <li
          class="font-bold relative text-lg list-click cursor-pointer"
          v-for="(category, index) in categories"
          :key="category.id"
          :class="{ active: currentActive === index }"
        >
          <a href="#" @click.prevent="currentActive = index">
            {{ category.name }}
          </a>
        </li>
      </ul>
      <div
        class="flex flex-wrap justify-center md:justify-between mt-9 gap-y-12 max-w-6xl mx-auto"
      >
        <div
          class="flex-shrink-0 flex-grow-0 basis-full sm:basis-1/2 md:basis-1/3"
          v-for="(device, index) in devices"
          :key="index"
        >
          <div
            @click="openDevice(index)"
            class="flex flex-col justify-between h-full text-center"
          >
            <div>
              <img
                class="mx-auto max-w-xs"
                :src="device.image"
                :alt="device.name"
              />
            </div>
            <h4 class="font-semibold text-xl">{{ device.name }}</h4>
            <h5 class="text-2xl font-bold">{{ device.formatted_price }}</h5>
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

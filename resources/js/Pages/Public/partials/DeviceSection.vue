<script setup>
import Modal from '@/Components/Modal.vue';
import { Link } from '@inertiajs/vue3';
import { ref, computed } from 'vue';
import CloseCircle from "~icons/mdi/close-circle";

const props = defineProps(["brands"])

const currentActive = ref(0)

const currentDevice = ref(0)

const modalToggle = ref(false)

const devices = computed(() => {
  return props.brands[currentActive.value].devices
})

const toggledDevice = computed(() => {
  return devices.value[currentDevice.value];
})

const openDevice = (index) => {
  currentDevice.value = index
  modalToggle.value = true;
}

</script>
<template>
  <section>
    <div class="container mx-auto px-5 py-24">
      <h4 class="text-6xl text-center font-bold">Brands We Offer</h4>
      <ul class="flex justify-center mt-8 gap-6">
        <li class="font-bold relative text-lg list-click cursor-pointer" v-for="(brand, index) in brands" :key="brand.id"
          :class="{ active: currentActive === index }">
          <a href="#" @click.prevent="currentActive = index">
            {{ brand.name }}
          </a>
        </li>
      </ul>
      <div class="flex flex-wrap justify-between mt-9 gap-y-12 max-w-6xl mx-auto">
        <div class="flex-shrink-0 flex-grow-0 basis-full sm:basis-1/2 md:basis-1/3 " v-for="(device, index) in devices"
          :key="index">
          <div @click="openDevice(index)" class="flex flex-col justify-between h-full text-center">
            <div>
              <img class="mx-auto" :src="device.image" alt="">

            </div>
            <h4 class="font-semibold text-xl">{{ device.name }}</h4>
          </div>
        </div>
      </div>
    </div>
    <Modal max-width="7xl" :show="modalToggle" @close="modalToggle = false">
      <div class="flex flex-col md:flex-row justify-between relative">
        <div @click="modalToggle = false"
          class="text-red-400 cursor-pointer hover:text-red-500 text-3xl absolute top-2 right-2">
          <CloseCircle />
        </div>
        <div class="basis-4/5 flex-grow w-full h-full">
          <img class="mx-auto md:mx-0 max-h-96" :src="toggledDevice.image" :alt="toggledDevice.name">
        </div>
        <div class="p-6 m-auto">
          <h1 class="font-medium text-2xl">{{ toggledDevice.name }}</h1>
          <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequatur quisquam molestias excepturi, maiores
            quo, suscipit exercitationem consequuntur atque odio, voluptates ut dolore deleniti explicabo rerum hic
            perferendis. Dignissimos, iusto. Animi dolore delectus adipisci suscipit ab dolorem ullam excepturi quidem
            ratione. <br>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequatur quisquam molestias excepturi, maiores
            quo, suscipit exercitationem consequuntur atque odio, voluptates ut dolore deleniti explicabo rerum hic
            perferendis. Dignissimos, iusto. Animi dolore delectus adipisci suscipit ab dolorem ullam excepturi quidem
            ratione.
          </p>
          <div class="py-6">
            <Link as="button" :href="route('public.appointments.create', toggledDevice.slug)"
              class="btn-action px-4 py-1 text-white text-xl bg-red-500 border before:bg-black-500">
            Buy Now
            </Link>
          </div>
        </div>

      </div>
      <div class="absolute">
        X
      </div>
    </Modal>
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
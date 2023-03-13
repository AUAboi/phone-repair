<script setup>
import { ref, computed } from 'vue';

const props = defineProps(["brands"])

const currentActive = ref(0)

const devices = computed(() => {
  return props.brands[currentActive.value].devices
})

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
        <div
          class="text-center flex-shrink-0 flex-grow-0 basis-full sm:basis-1/2 md:basis-1/3 flex flex-col justify-between"
          v-for="(device, index) in devices" :key="index">
          <div>
            <img class="mx-auto" :src="device.image" alt="">

          </div>
          <h4 class="font-semibold text-xl">{{ device.name }}</h4>
        </div>
      </div>
    </div>
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
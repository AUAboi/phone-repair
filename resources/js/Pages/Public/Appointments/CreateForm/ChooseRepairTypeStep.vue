<script setup>
import { computed } from 'vue';


const props = defineProps(["deviceRepairs", "form"])

const selectedRepair = computed(() => {
  if (props.form.repair_type === 'Unknown') {
    return
  }
  return props.deviceRepairs.filter((repair) => {
    return repair.repair_type === props.form.repair_type
  })[0].repairs
});

</script>
<template>
  <div class="my-6 flex gap-8 flex-wrap justify-center max-w-2xl mx-auto">
    <label :for="repair.repair_type"
      class="flex flex-col justify-center items-center py-2 bg-blue-50 border-2 border-blue-300 rounded-md transition-colors duration-300 hover:border-fuchsia-700 w-32 drop-shadow-md shadow-gray-400 cursor-pointer"
      v-for="repair in deviceRepairs" :key="repair.id"
      :class="form.repair_type === repair.repair_type ? 'border-fuchsia-700' : ''">
      <img class="w-5/6 mx-auto" :src="repair.image" :alt="repair.title">
      <p class="text-center">
        {{ repair.repair_type }}
      </p>
      <input class="hidden" type="radio" v-model="form.repair_type" :value="repair.repair_type" name="repair_type"
        :id="repair.repair_type">
    </label>
    <label for="Unknown" class="flex flex-col justify-center items-center bg-blue-50 border-2 border-blue-300 rounded-md transition-colors duration-300 hover:border-fuchsia-700
        w-32 drop-shadow-md shadow-gray-400 cursor-pointer"
      :class="form.repair_type === 'Unknown' ? 'border-fuchsia-700' : ''">
      <img class="w-5/6 mx-auto" src="/images/question.webp" alt="repair.title">
      <p class="text-center">
        I dont know
      </p>
      <input class="hidden" type="radio" v-model="form.repair_type" value="Unknown" name="repair_type" id="Unknown">
    </label>
  </div>
  <div class="border-pink-500 border-2 py-4 px-6 max-w-4xl rounded-md mx-auto">
    <div class="flex text-center">
      <div class="w-full" v-if="!form.repair_type != 'Unknown'" v-for="(repair, index) in selectedRepair" :key="index">
        <h3 class="text-pink-600 font-bold text-4xl">
          {{ repair.title }}
        </h3>
        <h2 class="text-3xl text-gray-800 font-bold">
          {{ repair.price }}
        </h2>
      </div>
    </div>

  </div>
</template>
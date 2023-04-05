<script setup>
import { useStepFormStore } from "@/store/stepForm";
import { computed } from "vue";

const stepForm = useStepFormStore();

const selectedRepair = computed(() => {
  return stepForm.device.device_repairs.filter((repair) => {
    return repair.repair_type === stepForm.form.repair_type;
  })[0].repairs;
});

const selectOption = (repair) => {
  stepForm.form.device_repair_id = repair;
  stepForm.stepForward();
};
</script>
<template>
  <div>
    <div class="text-center">
      <h2 class="text-5xl text-red-600 font-semibold">
        {{ stepForm.device.brand.name }} {{ stepForm.device.name }} Repair
      </h2>
    </div>
    <div class="my-6 flex gap-8 flex-wrap justify-center max-w-2xl mx-auto">
      <label
        :for="repair.repair_type"
        class="flex flex-col justify-center items-center py-2 bg-gray-50 border-2 border-blue-300 rounded-md transition-colors duration-300 hover:border-4 w-32 drop-shadow-md shadow-gray-400 cursor-pointer"
        v-for="repair in stepForm.device.device_repairs"
        :key="repair.id"
        :class="
          stepForm.form.repair_type === repair.repair_type
            ? 'border-red-600'
            : ''
        "
      >
        <img class="w-5/6 mx-auto" :src="repair.image" :alt="repair.title" />
        <p class="text-center">
          {{ repair.repair_type }}
        </p>
        <input
          class="hidden"
          type="radio"
          v-model="stepForm.form.repair_type"
          :value="repair.repair_type"
          name="repair_type"
          :id="repair.repair_type"
        />
      </label>
    </div>
    <div class="border-red-500 border-2 py-8 px-6 max-w-4xl rounded-md mx-auto">
      <div class="flex flex-col sm:flex-row text-center">
        <div
          class="w-full space-y-4 px-2 py-8"
          :class="
            index !== selectedRepair.length - 1
              ? 'border-red-600 border-b-2 sm:border-r-2 sm:border-b-0'
              : ''
          "
          v-for="(repair, index) in selectedRepair"
          :key="index"
        >
          <h3 class="text-red-600 font-bold text-4xl">
            {{ repair.title }}
          </h3>
          <h2 class="text-2xl text-gray-800 font-bold">
            {{ repair.price }}
          </h2>
          <div v-html="repair.body"></div>
          <button
            @click.prevent="selectOption(repair.id)"
            class="btn-action px-9 py-1 bg-red-600 text-white font-bold text-xl before:bg-black"
          >
            Book
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

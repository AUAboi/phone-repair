<script setup>
import { useStepFormStore } from "@/store/stepForm";

import Datepicker from "@vuepic/vue-datepicker";
import "@vuepic/vue-datepicker/dist/main.css";
import { onMounted, ref } from "vue";
const stepForm = useStepFormStore();

let now = new Date();
// const minDate = new Date(Date.now() + (3600 * 1000 * 24))
const minDate = new Date();

const startTime = ref({ hours: now.getHours(), minutes: 0 });

onMounted(() => {
  stepForm.form.appointment_time = startTime.value;
});
</script>
<template>
  <div>
    <div class="text-center my-12">
      <h2 class="text-5xl text-red-600 font-semibold py-4">
        Choose Appointment Time
      </h2>
      <p class="text-xl font-semibold tracking-wide">Visit us in store</p>
    </div>
    <div
      class="grid grid-cols-1 sm:grid-cols-2 gap-8 sm:gap-0 justify-items-center max-w-4xl mx-auto justify-center"
    >
      <Datepicker
        required
        inline
        v-model="stepForm.form.appointment_date"
        auto-apply
        :min-date="minDate"
        :enable-time-picker="false"
        :month-change-on-scroll="false"
      />
      <Datepicker
        required
        inline
        v-model="stepForm.form.appointment_time"
        auto-apply
        :is24="false"
        time-picker
        no-minutes-overlay
        :minutes-increment="30"
        :start-time="startTime"
      >
        <template #am-pm-button="{ toggle, value }">
          <button @click.prevent="toggle">{{ value }}</button>
        </template>
      </Datepicker>
    </div>
    <div class="text-center my-8">
      <button
        class="btn-action bg-red-500 text-white before:bg-black px-9 py-1 text-xl font-bold"
        @click.prevent="stepForm.setStep(3)"
      >
        Lets Go
      </button>
    </div>
  </div>
</template>

<style>
.dp__select {
  @apply text-red-600;
}

.dp__overlay {
  z-index: 40;
}
</style>

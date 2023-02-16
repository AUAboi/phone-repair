<script setup>
import { useStepFormStore } from '@/store/stepForm';

import Datepicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'
const stepForm = useStepFormStore()

const minDate = new Date(Date.now() + (3600 * 1000 * 24))

</script>
<template>
  <div>
    <div class="text-center my-12">
      <h2 class="text-5xl text-pink-600 font-semibold py-4">Choose Appointment Time</h2>
      <p class="text-xl font-semibold tracking-wide">
        Visit us in store
      </p>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-8 sm:gap-0 justify-items-center max-w-4xl mx-auto justify-center">
      <Datepicker inline v-model="stepForm.form.appointment_date" :min-date="minDate" :enable-time-picker="false" />
      <Datepicker inline v-model="stepForm.form.appointment_time" :is24="false" time-picker>
        <template #am-pm-button="{ toggle, value }">
          <button @click="toggle">{{ value }}</button>
        </template>
      </Datepicker>
    </div>
    <div class="text-center my-8">
      <button class="btn--cta px-9 py-1 " @click.prevent="stepForm.stepForward()">Lets Go</button>

    </div>
</div>
</template>

<style>
.dp__select {
  @apply text-pink-500
}
</style>
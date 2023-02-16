<script setup>
import { useStepFormStore } from '@/store/stepForm';
import { Head, useForm } from '@inertiajs/vue3';
import ChooseRepairTypeStep from './CreateForm/ChooseRepairTypeStep.vue'
const props = defineProps(["device", "repairs"])

//FORM
const stepForm = useStepFormStore()
stepForm.form.repair_type = props.device.device_repairs[0].repair_type

</script>

<template>
  <Head :title="`Book ${props.device.name} repair`" />
  <div class="py-8 px-2">
    <transition name="slide" mode="out-in">
      <ChooseRepairTypeStep v-if="stepForm.currentStep === 1" :device="device" />

    </transition>
</div>
</template>
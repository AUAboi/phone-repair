<script setup>
import { useStepFormStore } from '@/store/stepForm';
import { Head } from '@inertiajs/vue3';
import AddPersonalInformation from './CreateForm/AddPersonalInformation.vue';
import ChooseAppointment from './CreateForm/ChooseAppointment.vue';
import ChooseRepairTypeStep from './CreateForm/ChooseRepairTypeStep.vue'
import FormPaginator from './CreateForm/FormPaginator.vue'

const props = defineProps(["device", "repairs"])

const stepForm = useStepFormStore()
stepForm.form.repair_type = props.device.device_repairs[0].repair_type

</script>

<template>
  <Head :title="`Book ${props.device.name} repair`" />
  <FormPaginator :device="device" />
  {{ stepForm.form }}
  <div class="py-8 px-2 min-h-screen flex items-center">
    <transition class="w-full" :name="`slide-${stepForm.transition}`" mode="out-in">
      <ChooseRepairTypeStep v-if="stepForm.currentStep === 1" :device="device" />
      <ChooseAppointment v-else-if="stepForm.currentStep === 2" />
      <AddPersonalInformation v-else-if="stepForm.currentStep === 3" />
    </transition>
  </div>
</template>

<style scoped>
.slide-next-leave-active,
.slide-previous-leave-active {
  transition: all 300ms ease-out;
}

.slide-next-enter-active,
.slide-previous-enter-active {
  transition: all 1000ms ease-out;
}

.slide-next-enter-from,
.slide-previous-leave-to {
  transform: translate(100%, 0);
}

.slide-next-leave-to,
.slide-previous-enter-from {
  transform: translate(-100%, 0);
}
</style>
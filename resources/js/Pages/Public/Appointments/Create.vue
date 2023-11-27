<script setup>
import { useStepFormStore } from "@/store/stepForm";
import { Head } from "@inertiajs/vue3";
import AddPersonalInformation from "./CreateForm/AddPersonalInformation.vue";
import ChooseAppointment from "./CreateForm/ChooseAppointment.vue";
import ChooseRepairTypeStep from "./CreateForm/ChooseRepairTypeStep.vue";
import FormPaginator from "./CreateForm/FormPaginator.vue";
import { onMounted } from "vue";

const props = defineProps(["device", "repairs"]);

const stepForm = useStepFormStore();
stepForm.form.repair_type = props.device.device_repairs[0].repair_type;

stepForm.device = props.device;

onMounted(() => {
  console.log("test");
  stepForm.form.repair_type = props.device.device_repairs[0].repair_type;

  stepForm.device = props.device;
});
</script>

<template>
  <Head :title="`Book ${props.device.name} repair`" />
  <FormPaginator class="pt-40" />
  <div
    v-if="stepForm.form.hasErrors"
    class="ml-6 text-red-600 md:max-w-sm md:mx-auto"
  >
    <h4 class="text-lg">There are some errors:</h4>
    <ul class="list-disc ml-8">
      <li v-for="error in stepForm.form.errors">{{ error }}</li>
    </ul>
  </div>
  <form class="py-8 px-2 min-h-screen flex items-center">
    <transition
      class="w-full"
      :name="`slide-${stepForm.transition}`"
      mode="out-in"
    >
      <ChooseRepairTypeStep v-if="stepForm.currentStep === 1" />
      <ChooseAppointment v-else-if="stepForm.currentStep === 2" />
      <AddPersonalInformation v-else-if="stepForm.currentStep === 3" />
    </transition>
  </form>
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

import { useForm } from "@inertiajs/vue3"
import { defineStore } from "pinia"
import { reactive, ref } from "vue"

export const useStepFormStore = defineStore('stepForm', () => {
  const form = useForm({
    device_id: null,
    repair_type: null,
    device_repair_id: null,
    appointment_date: null,
    appointment_time: null
  })

  const transition = ref("next")

  const device = reactive({})

  const currentStep = ref(1)

  const stepForward = () => {
    transition.value = "next"
    currentStep.value++
  }

  const stepBackward = () => {
    transition.value = "previous"
    currentStep.value--
  }

  const setStep = (step) => {
    if (step < currentStep.value) {
      transition.value = "previous"
      currentStep.value = step
    }
    else if (step > currentStep.value) {
      transition.value = "next"

      currentStep.value = step
    }
  }

  return { form, device, currentStep, transition, stepForward, stepBackward, setStep }
})

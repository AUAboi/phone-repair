import { useForm } from "@inertiajs/vue3"
import { defineStore } from "pinia"
import { reactive, ref } from "vue"

export const useStepFormStore = defineStore('stepForm', () => {
  const form = useForm({
    device_id: null,
    repair_type: null,
    device_repair_id: null
  })

  const device = reactive({})

  const currentStep = ref(1)

  const stepForward = () => {
    currentStep.value++
  }
  const stepBackward = () => {
    currentStep.value--
  }

  return { form, device, currentStep, stepForward, stepBackward }
})

import useSweetAlert from "@/Composables/useSweetAlert"
import { useForm } from "@inertiajs/vue3"
import { defineStore } from "pinia"
import { reactive, ref } from "vue"

export const useStepFormStore = defineStore('stepForm', () => {
  const { alertError } = useSweetAlert()


  const form = useForm({
    device_id: null,
    repair_type: null,
    device_repair_id: null,
    appointment_date: null,
    appointment_time: null,
    first_name: null,
    last_name: null,
    email: null,
    city: null,
    phone: null,
    zip: null,
    address: null,
    message: null
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
    if (!canGoToStep(step)) {
      alertError({
        title: "Missing fields",
        text: "You need to select previous options before moving to next"
      });
      return
    }
    if (step < currentStep.value) {
      transition.value = "previous"
      currentStep.value = step
    }
    else if (step > currentStep.value) {
      transition.value = "next"

      currentStep.value = step
    }
  }

  const canGoToStep = (step) => {
    return true
    if (step >= 2) {
      if (!form.device_repair_id) return false
    }
    if (step >= 3) {
      if (!form.appointment_date || !form.appointment_time) return false
    }

    return true
  }

  return { form, device, currentStep, transition, stepForward, stepBackward, setStep, canGoToStep }
})

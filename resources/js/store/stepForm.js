import useSweetAlert from "@/Composables/useSweetAlert"
import { useForm } from "@inertiajs/vue3"
import { defineStore } from "pinia"
import { computed, ref } from "vue"

export const useStepFormStore = defineStore('stepForm', () => {
  const { alertError } = useSweetAlert()


  const form = useForm({
    repair_type: null,
    device_repair_id: null,
    appointment_date: null,
    appointment_time: null,
    first_name: null,
    last_name: null,
    email: null,
    city: null,
    phone: null,
    zip_code: null,
    address: null,
    message: null
  })

  const transition = ref("next")

  const device = ref()

  const currentStep = ref(1)

  const stepForward = () => {
    if (currentStep.value < 3) {
      transition.value = "next"
      currentStep.value++
    }
  }

  const stepBackward = () => {
    if (currentStep.value >= 1) {
      transition.value = "previous"
      currentStep.value--
    }
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
    if (step >= 2) {
      if (!form.device_repair_id) return false
    }
    if (step >= 3) {
      if (!form.appointment_date || !form.appointment_time) return false
    }

    return true
  }


  const submit = () => {
    form.post(route('public.appointments.store', device.value.slug), {
      preserveState: true
    })
  }

  const errors = computed(() => {
    let err = []
    Object.keys(form.errors).forEach((key) => {
      err.push(form.errors[key])
    })
    return err
  })

  return { form, device, currentStep, transition, errors, stepForward, stepBackward, setStep, canGoToStep, submit }
})

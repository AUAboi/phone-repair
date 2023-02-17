<script setup>
import { useStepFormStore } from "@/store/stepForm";
import { Link } from "@inertiajs/vue3";
import IconChevronRight from "~icons/mdi/chevron-right"


const props = defineProps(["device"])
const store = useStepFormStore()
</script>
<template>
  <div class="flex bg-blue-100 shadow-inner py-4">
    <div class="flex flex-col sm:flex-row gap-2 max-w-3xl mx-auto font-semibold">
      <Link as="button" :href="route('public.repairs.brand', device.brand.slug)"
        class="flex items-center cursor-pointer justify-between">
      <p>
        Select Device
      </p>
      <IconChevronRight />
      </Link>
      <button @click.prevent="store.setStep(1)" class="flex items-center cursor-pointer justify-between"
        :class="{ active: store.currentStep === 1 }">
        <p>
          Choose Repair
        </p>
        <IconChevronRight />
      </button>
      <button @click.prevent="store.setStep(2)" class="flex items-center cursor-pointer justify-between"
        :class="{ active: store.currentStep === 2 }">
        <p>
          Add Appointment Details
        </p>
        <IconChevronRight />
      </button>
      <button @click.prevent="store.setStep(3)" class="flex items-center cursor-pointer justify-between"
        :class="{ active: store.currentStep === 3 }">
        <p>
          Add Personal Information
        </p>
        <IconChevronRight />
      </button>
    </div>

  </div>
</template>

<style scoped>
.active {
  @apply text-pink-500
}
</style>
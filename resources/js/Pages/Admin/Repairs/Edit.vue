
<script setup>
import { Head, useForm } from '@inertiajs/inertia-vue3';
import PageHeader from '@/Components/PageHeader.vue';
import FormInput from "@/Components/FormInput.vue"
import PrimaryButton from '@/Components/PrimaryButton.vue';
import useSweetAlert from '@/Composables/useSweetAlert.js'

const props = defineProps({
  repair: {
    required: true,
    type: Object
  }
})

const form = useForm({
  '_method': 'put',
  title: props.repair.title,
})

const submit = () => {
  form.post(route('repairs.update', props.repair.id))
}

const { alertConfirm } = useSweetAlert()

const destroy = () => {
  alertConfirm(
    result => {
      if (result.isConfirmed) {
        form.delete(route('repairs.destroy', props.repair.id))
      }
    },
    { title: `Deleting ${props.repair.title} will delete all the devices for the brand. Proceed?` }
  )
}

</script>
<template>

  <Head title="Create Repair Type" />
  <PageHeader>Create Repair Type</PageHeader>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mx-2 md:mx-0">
        <form class="max-w-md mx-auto mt-10" id="update-form" @submit.prevent="submit">
          <div class="flex">
            <FormInput label="Name" v-model="form.title" :error="form.errors.title" />
          </div>
          <div class="flex justify-between">
            <PrimaryButton form="update-form" class="mb-4 px-10" type="submit">
              Update
            </PrimaryButton>
            <form @submit.prevent="destroy" id="delete-form" class="m-0">
              <button form="delete-form" :disabled="form.processing" type="submit"
                class="hover:underline text-red-600 ">
                Delete
              </button>
            </form>
          </div>
        </form>

      </div>
    </div>
  </div>
</template>
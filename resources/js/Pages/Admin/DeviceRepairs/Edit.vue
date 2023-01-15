<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import PageHeader from '@/Components/PageHeader.vue';
import FormInput from "@/Components/FormInput.vue"
import FormSelect from "@/Components/FormSelect.vue"
import PrimaryButton from '@/Components/PrimaryButton.vue';
import useSweetAlert from '@/Composables/useSweetAlert';

const props = defineProps({
  device: {
    required: true
  },
  device_repair: {
    required: true
  },
  repairs: {
    required: true
  }
})

const form = useForm({
  '_method': 'put',
  title: props.device_repair.title,
  repair_id: props.device_repair.repair_id,
  price: props.device_repair.price,
  body: props.device_repair.body
})

const submit = () => {
  form.post(route('device.repair.update', props.device_repair.id))
}

const { alertConfirm } = useSweetAlert()

const destroy = () => {
  alertConfirm(
    result => {
      if (result.isConfirmed) {
        form.delete(route('device.repair.destroy', props.device_repair.id))
      }
    },
    { title: `Deleting ${props.device_repair.title}. Proceed?` }
  )
}

</script>
<template>

  <Head title="Update Repair" />
  <PageHeader>Update Repair for {{ device.name }}</PageHeader>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
        <form id="update-form" class="max-w-md mr-auto " @submit.prevent="submit">
          <div class="flex">
            <FormInput label="Title" v-model="form.title" :error="form.errors.title" />
          </div>
          <div class="flex">
            <FormInput step=".01" label="Price" type="number" v-model="form.price" :error="form.errors.price" />
            <FormSelect label="Repair Type" v-model="form.repair_id" :error="form.errors.repair_id">
              <option value="">Select a repair type</option>
              <option v-for="repair in repairs" :value="repair.id">{{ repair.title }}</option>
            </FormSelect>
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
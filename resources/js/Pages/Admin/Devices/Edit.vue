<script setup>
import { Head, useForm } from '@inertiajs/inertia-vue3';
import PageHeader from '@/Components/PageHeader.vue';
import FormInput from "@/Components/FormInput.vue"
import FormSelect from "@/Components/FormSelect.vue"
import PrimaryButton from '@/Components/PrimaryButton.vue';
import useSweetAlert from '@/Composables/useSweetAlert';
import DeviceRepairsTable from './Partials/DeviceRepairsTable.vue';
import ImagePreview from '@/Components/ImagePreview.vue';
import { onMounted } from 'vue';
import { urlToImageFile } from '@/utils';
import FormInputImage from '@/Components/FormInputImage.vue';

const props = defineProps({
  device: {
    required: true
  },
  brands: {
    required: true
  }
})

const form = useForm({
  '_method': 'put',
  name: props.device.name,
  brand_id: props.device.brand.id,
  image: props.device.image
})

const handleSelectedMedia = (files) => {
  form.image = files
}

const setFormValues = async () => {
  form.image = await urlToImageFile(props.device.image)
}

onMounted(setFormValues)

const submit = () => {
  form.post(route('devices.update', props.device.slug))
}

const { alertConfirm } = useSweetAlert()

const destroy = () => {
  alertConfirm(
    result => {
      if (result.isConfirmed) {
        form.delete(route('devices.destroy', props.device.slug))
      }
    },
    { title: `Deleting ${props.device.name} will delete all the fix types. Proceed?` }
  )
}

</script>
<template>

  <Head title="Update Device" />
  <PageHeader>Update Device</PageHeader>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
      <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
        <ImagePreview :src="form.image" />
        <form id="update-form" class="max-w-md " @submit.prevent="submit">
          <div class="flex">
            <FormInput label="Name" v-model="form.name" :error="form.errors.name" />
            <FormSelect label="Brand" v-model="form.brand_id" :error="form.errors.brand_id">
              <option value="">Select a brand</option>
              <option v-for="brand in brands" :value="brand.id">{{ brand.name }}</option>
            </FormSelect>
          </div>
          <div class="flex">
            <FormInputImage @selected="handleSelectedMedia" label="Image" v-model="form.image"
              :error="form.errors.image" />
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
      <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
        <DeviceRepairsTable :device="device" />
      </div>
    </div>
  </div>

</template>
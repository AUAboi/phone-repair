
<script setup>
import { Head, useForm } from '@inertiajs/inertia-vue3';
import PageHeader from '@/Components/PageHeader.vue';
import FormInput from "@/Components/FormInput.vue"
import PrimaryButton from '@/Components/PrimaryButton.vue';
import useSweetAlert from '@/Composables/useSweetAlert.js'
import ImagePreview from '@/Components/ImagePreview.vue';

const props = defineProps({
  brand: {
    required: true,
    type: Object
  }
})

const form = useForm({
  '_method': 'put',
  name: props.brand.name,
})

const submit = () => {
  form.post(route('brands.update', props.brand.slug))
}

const { alertConfirm } = useSweetAlert()

const destroy = () => {
  alertConfirm(
    result => {
      if (result.isConfirmed) {
        form.delete(route('brands.destroy', props.brand.slug))
      }
    },
    { title: `Deleting ${props.brand.name} will delete all the devices for the brand. Proceed?` }
  )
}

</script>
<template>

  <Head title="Create Brand" />
  <PageHeader>Create Brand</PageHeader>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <ImagePreview :src="brand.image" />
      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg mx-2 md:mx-0 px-4 py-2">
        <form class="max-w-md mt-10" id="update-form" @submit.prevent="submit">
          <div class="flex">
            <FormInput label="Name" v-model="form.name" :error="form.errors.name" />
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
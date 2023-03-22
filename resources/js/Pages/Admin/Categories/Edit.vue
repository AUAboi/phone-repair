
<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import PageHeader from '@/Components/PageHeader.vue';
import FormInput from "@/Components/FormInput.vue"
import PrimaryButton from '@/Components/PrimaryButton.vue';
import useSweetAlert from '@/Composables/useSweetAlert.js'
import ImagePreview from '@/Components/ImagePreview.vue';
import FormInputImage from '@/Components/FormInputImage.vue';
import { urlToImageFile } from '@/utils.js'
import { onMounted } from 'vue';

const props = defineProps({
  category: {
    required: true,
    type: Object
  }
})

const form = useForm({
  '_method': 'put',
  name: props.category.name,
})


const handleSelectedMedia = (files) => {
  form.image = files
}
const setFormValues = async () => {
  form.image = await urlToImageFile(props.category.image)
}
onMounted(setFormValues)

const submit = () => {
  form.post(route('categories.update', props.category.slug))
}

const { alertConfirm } = useSweetAlert()

const destroy = () => {
  alertConfirm(
    result => {
      if (result.isConfirmed) {
        form.delete(route('categories.destroy', props.category.slug))
      }
    },
    { title: `Deleting ${props.category.name} will delete all the products for the category. Proceed?` }
  )
}

</script>
<template>
  <Head title="Edit Category" />
  <PageHeader>Edit Category</PageHeader>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg mx-2 md:mx-0 px-2 py-2 sm:px-4px-4 py-2">
        <form class="max-w-md mt-5" id="update-form" @submit.prevent="submit">
          <div class="flex">
            <FormInput label="Name" v-model="form.name" :error="form.errors.name" />
          </div>
          <div class="flex justify-between">
            <PrimaryButton form="update-form" class="mb-4 px-10" type="submit">
              Update
            </PrimaryButton>
            <form @submit.prevent="destroy" id="delete-form" class="m-0">
              <button form="delete-form" :disabled="form.processing" type="submit" class="hover:underline text-red-600 ">
                Delete
              </button>
            </form>
          </div>
        </form>

      </div>
    </div>
  </div>
</template>
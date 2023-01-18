<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import PageHeader from '@/Components/PageHeader.vue';
import FormInput from "@/Components/FormInput.vue"
import FormSelect from "@/Components/FormSelect.vue"
import PrimaryButton from '@/Components/PrimaryButton.vue';
import FormInputImage from '@/Components/FormInputImage.vue';
import ImagePreview from '@/Components/ImagePreview.vue';

const props = defineProps({
  brands: {
    required: true
  }
})

const form = useForm({
  name: "",
  brand_id: "",
  image: ""
})

const handleSelectedMedia = (files) => {
  form.image = files
}

const submit = () => {
  form.post(route('devices.store'))
}

</script>
<template>

  <Head title="Create Device" />
  <PageHeader>Create Device</PageHeader>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="mx-2 md:mx-0 max-w-md">
        <ImagePreview :src="form.image" />
      </div>
      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg mx-2 md:mx-0 px-2 py-2 sm:px-4">
        <form class="max-w-md mt-5" @submit.prevent="submit">
          <div class="flex">
            <FormInput label="Name" v-model="form.name" :error="form.errors.name" />
            <FormSelect label="Brand" v-model="form.brand_id" :error="form.errors.brand_id">
              <option value="">Select a brand</option>
              <option v-for="brand in brands" :value="brand.id">{{ brand.name }}</option>
            </FormSelect>
          </div>
          <div class="flex">
            <FormInputImage label="Image" @selected="handleSelectedMedia" :error="form.errors.image" />
          </div>
          <PrimaryButton class="mb-4 px-10" type="submit">
            Add
          </PrimaryButton>
        </form>
      </div>
    </div>
  </div>
</template>
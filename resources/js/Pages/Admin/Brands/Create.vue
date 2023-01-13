<script setup>
import { Head, useForm } from '@inertiajs/inertia-vue3';
import PageHeader from '@/Components/PageHeader.vue';
import FormInput from "@/Components/FormInput.vue"
import PrimaryButton from '@/Components/PrimaryButton.vue';
import FormInputImage from '@/Components/FormInputImage.vue';

const form = useForm({
  name: "",
  image: ""
})

const handleSelectedMedia = (files) => {
  form.image = files
}

const submit = () => {
  form.post(route('brands.store'))
}
</script>
<template>

  <Head title="Create Brand" />
  <PageHeader>Create Brand</PageHeader>
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mx-2 md:mx-0">
        <form enctype="multipart/form-data" class="max-w-md mx-auto mt-10" @submit.prevent="submit">
          <div class="flex">
            <FormInput label="Name" v-model="form.name" :error="form.errors.name" />
          </div>
          <div class="flex ">
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
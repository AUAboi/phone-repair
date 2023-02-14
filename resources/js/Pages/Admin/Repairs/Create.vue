<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import PageHeader from '@/Components/PageHeader.vue';
import FormInput from "@/Components/FormInput.vue"
import PrimaryButton from '@/Components/PrimaryButton.vue';
import FormInputImage from '@/Components/FormInputImage.vue';

const form = useForm({
  title: "",
  image: "",
})

const handleSelectedMedia = (files) => {
  form.image = files
}

const submit = () => {
  form.post(route('repairs.store'))
}

</script>
<template>

  <Head title="Add Repair" />
  <PageHeader>Add Repair </PageHeader>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg mx-2 md:mx-0 px-2 py-2 sm:px-4">
        <form class="max-w-md mt-5" @submit.prevent="submit">
          <div class="flex">
            <FormInput label="Title" v-model="form.title" :error="form.errors.title" />
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
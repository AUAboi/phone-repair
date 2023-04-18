<script setup>
import { Head, useForm } from "@inertiajs/vue3";
import PageHeader from "@/Components/PageHeader.vue";
import FormInput from "@/Components/FormInput.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import FormInputImage from "@/Components/FormInputImage.vue";
import ImagePreview from "@/Components/ImagePreview.vue";
import Checkbox from "@/Components/Checkbox.vue";

const form = useForm({
  name: "",
  image: "",
  mobile: false,
  tablet: false,
  laptop: false,
});

const handleSelectedMedia = (files) => {
  form.image = files;
};

const submit = () => {
  form.post(route("brands.store"));
};
</script>
<template>
  <Head title="Create Brand" />
  <PageHeader>Create Brand</PageHeader>
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="mx-2 md:mx-0 max-w-md">
        <ImagePreview :src="form.image" />
      </div>
      <div
        class="bg-white dark:text-white text-gray-900 dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg mx-2 md:mx-0 px-2 py-2 sm:px-4"
      >
        <form
          enctype="multipart/form-data"
          class="max-w-md mt-5"
          @submit.prevent="submit"
        >
          <div class="flex">
            <FormInput
              label="Name"
              v-model="form.name"
              :error="form.errors.name"
            />
          </div>
          <div class="flex">
            <FormInputImage
              label="Image"
              @selected="handleSelectedMedia"
              :error="form.errors.image"
            />
          </div>
          <div class="my-4 max-w-fit">
            <h2 class="text-xl">Choose Category</h2>
            <div class="flex items-center gap-4 mt-6">
              <div class="space-x-4 flex justify-between items-center">
                <label for="mobile">Smartphone</label>
                <Checkbox v-model:checked="form.mobile" id="mobile" />
              </div>
              <div class="space-x-4 flex justify-between items-center">
                <label for="laptop">Laptop</label>
                <Checkbox v-model:checked="form.laptop" id="laptop" />
              </div>
              <div class="space-x-4 flex justify-between items-center">
                <label for="tablet">Tablets</label>
                <Checkbox v-model:checked="form.tablet" id="tablet" />
              </div>
            </div>
          </div>

          <PrimaryButton class="mb-4 px-10" type="submit"> Add </PrimaryButton>
        </form>
      </div>
    </div>
  </div>
</template>

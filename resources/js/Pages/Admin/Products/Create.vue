<script setup>
import { Head, useForm } from "@inertiajs/vue3";
import PageHeader from "@/Components/PageHeader.vue";
import FormInput from "@/Components/FormInput.vue";
import FormSelect from "@/Components/FormSelect.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import FormInputImage from "@/Components/FormInputImage.vue";
import ImagePreview from "@/Components/ImagePreview.vue";
import WYSISWYGEditor from "@/Components/WYSISWYGEditor.vue";

const props = defineProps({
  categories: {
    required: true,
  },
});

const form = useForm({
  name: "",
  price: "",
  category_id: "",
  image: "",
  body: "",
});

const handleSelectedMedia = (files) => {
  form.image = files;
};

const submit = () => {
  form.post(route("products.store"));
};
</script>
<template>
  <Head title="Create Product" />
  <PageHeader>Create Product</PageHeader>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="mx-2 md:mx-0 max-w-md">
        <ImagePreview :src="form.image" />
      </div>
      <div
        class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg mx-2 md:mx-0 px-2 py-2 sm:px-4"
      >
        <form class="max-w-md mt-5" @submit.prevent="submit">
          <div class="flex">
            <FormInput
              label="Name"
              v-model="form.name"
              :error="form.errors.name"
            />
            <FormSelect
              label="Category"
              v-model="form.category_id"
              :error="form.errors.category_id"
            >
              <option value="">Select a Category</option>
              <option v-for="category in categories" :value="category.id">
                {{ category.name }}
              </option>
            </FormSelect>
          </div>
          <div class="flex">
            <FormInput
              label="Price"
              v-model="form.price"
              :error="form.errors.price"
            />
          </div>
          <div class="flex">
            <FormInputImage
              label="Image"
              @selected="handleSelectedMedia"
              :error="form.errors.image"
            />
          </div>
          <PrimaryButton class="mb-4 px-10" type="submit"> Add </PrimaryButton>
        </form>
      </div>
    </div>
  </div>
  <div>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
        Body text
      </h2>

      <WYSISWYGEditor v-model="form.body" />
      <div v-if="form.errors.body" class="text-red-700 mt-2 text-sm">
        {{ form.errors.body }}
      </div>
    </div>
  </div>
</template>

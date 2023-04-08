<script setup>
import { Head, useForm } from "@inertiajs/vue3";
import PageHeader from "@/Components/PageHeader.vue";
import FormInput from "@/Components/FormInput.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import useSweetAlert from "@/Composables/useSweetAlert.js";
import ImagePreview from "@/Components/ImagePreview.vue";
import FormInputImage from "@/Components/FormInputImage.vue";
import { urlToImageFile } from "@/utils.js";
import { onMounted } from "vue";
import Checkbox from "@/Components/Checkbox.vue";

const props = defineProps({
  brand: {
    required: true,
    type: Object,
  },
});

const form = useForm({
  _method: "put",
  name: props.brand.name,
  image: props.brand.image,
  mobile: props.brand.mobile,
  laptop: props.brand.laptop,
  tablet: props.brand.tablet,
});

const handleSelectedMedia = (files) => {
  form.image = files;
};
const setFormValues = async () => {
  form.image = await urlToImageFile(props.brand.image);
};
onMounted(setFormValues);

const submit = () => {
  form.post(route("brands.update", props.brand.slug));
};

const { alertConfirm } = useSweetAlert();

const destroy = () => {
  alertConfirm(
    (result) => {
      if (result.isConfirmed) {
        form.delete(route("brands.destroy", props.brand.slug));
      }
    },
    {
      title: `Deleting ${props.brand.name} will delete all the devices for the brand. Proceed?`,
    }
  );
};
</script>
<template>
  <Head title="Edit Brand" />
  <PageHeader>Edit Brand</PageHeader>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="mx-2 md:mx-0 max-w-md">
        <ImagePreview :src="form.image" />
      </div>
      <div
        class="bg-white dark:text-white text-gray-900 dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg mx-2 md:mx-0 px-2 py-2 sm:px-4px-4 py-2"
      >
        <form class="max-w-md mt-5" id="update-form" @submit.prevent="submit">
          <div class="flex">
            <FormInput
              label="Name"
              v-model="form.name"
              :error="form.errors.name"
            />
          </div>
          <div class="flex">
            <FormInputImage
              @selected="handleSelectedMedia"
              label="Image"
              v-model="form.image"
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
          <div class="flex justify-between">
            <PrimaryButton form="update-form" class="mb-4 px-10" type="submit">
              Update
            </PrimaryButton>
            <form @submit.prevent="destroy" id="delete-form" class="m-0">
              <button
                form="delete-form"
                :disabled="form.processing"
                type="submit"
                class="hover:underline text-red-600"
              >
                Delete
              </button>
            </form>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

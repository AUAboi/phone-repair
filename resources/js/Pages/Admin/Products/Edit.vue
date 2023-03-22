<script setup>
import { Head, useForm } from "@inertiajs/vue3";
import PageHeader from "@/Components/PageHeader.vue";
import FormInput from "@/Components/FormInput.vue";
import FormSelect from "@/Components/FormSelect.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import useSweetAlert from "@/Composables/useSweetAlert";
import ImagePreview from "@/Components/ImagePreview.vue";
import { onMounted } from "vue";
import { urlToImageFile } from "@/utils";
import FormInputImage from "@/Components/FormInputImage.vue";
import { component as CKEditor } from "@ckeditor/ckeditor5-vue";
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";

const props = defineProps({
  product: {
    required: true,
  },
  categories: {
    required: true,
  },
});

const form = useForm({
  _method: "put",
  name: props.product.name,
  category_id: props.product.category.id,
  image: props.product.image,
  price: props.product.price,
  body: props.product.body,
});

const handleSelectedMedia = (files) => {
  form.image = files;
};

const setFormValues = async () => {
  form.image = await urlToImageFile(props.product.image);
};

onMounted(setFormValues);

const submit = () => {
  form.post(route("products.update", props.product.id));
};

const { alertConfirm } = useSweetAlert();

const destroy = () => {
  alertConfirm(
    (result) => {
      if (result.isConfirmed) {
        form.delete(route("products.destroy", props.product.id));
      }
    },
    {
      title: `Deleting ${props.product.name}. Proceed?`,
    }
  );
};
</script>
<template>
  <Head title="Update product" />
  <PageHeader>Update product</PageHeader>
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
      <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
        <div class="mx-2 md:mx-0 max-w-md">
          <ImagePreview :src="form.image" />
        </div>
        <form id="update-form" class="max-w-md" @submit.prevent="submit">
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
              <option value="">Select a category</option>
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
              @selected="handleSelectedMedia"
              label="Image"
              v-model="form.image"
              :error="form.errors.image"
            />
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
  <div>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
        Body text
      </h2>

      <CKEditor :editor="ClassicEditor" v-model="form.body"></CKEditor>
      <div v-if="form.errors.body" class="text-red-700 mt-2 text-sm">
        {{ form.errors.body }}
      </div>
    </div>
  </div>
</template>

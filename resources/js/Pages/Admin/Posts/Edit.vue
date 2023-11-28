<script setup>
import { Head, useForm } from "@inertiajs/vue3";
import PageHeader from "@/Components/PageHeader.vue";
import FormInput from "@/Components/FormInput.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import FormInputImage from "@/Components/FormInputImage.vue";
import ImagePreview from "@/Components/ImagePreview.vue";
import { onMounted } from "vue";
import useSweetAlert from "@/Composables/useSweetAlert";
import { urlToImageFile } from "@/utils";
import WYSISWYGEditor from "@/Components/WYSISWYGEditor.vue";

const props = defineProps({
  post: {
    required: true,
  },
});

const form = useForm({
  _method: "put",
  author: props.post.author,
  body: props.post.body,
  title: props.post.title,
  status: props.post.status,
  image: props.post.image,
});

const handleSelectedMedia = (files) => {
  form.image = files;
};

const submit = () => {
  form.post(route("posts.update", props.post.slug));
};

const setFormValues = async () => {
  form.image = await urlToImageFile(props.post.image);
};

onMounted(setFormValues);

const { alertConfirm } = useSweetAlert();

const destroy = () => {
  alertConfirm(
    (result) => {
      if (result.isConfirmed) {
        form.delete(route("posts.destroy", props.post.slug));
      }
    },
    {
      title: `Deleting ${props.post.title}. Proceed?`,
    }
  );
};
</script>
<template>
  <Head title="Edit Post" />
  <PageHeader>Edit Post</PageHeader>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="mx-2 md:mx-0 w-full blog-preview">
        <ImagePreview :src="form.image" />
      </div>
      <div
        class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg mx-2 md:mx-0 px-2 py-2 sm:px-4"
      >
        <form id="update-form" class="mt-5" @submit.prevent="submit">
          <div class="flex">
            <FormInputImage
              label="Image"
              @selected="handleSelectedMedia"
              :error="form.errors.image"
            />
          </div>
          <div class="flex">
            <FormInput
              label="Title"
              v-model="form.title"
              :error="form.errors.title"
            />
          </div>
          <div class="flex">
            <FormInput
              label="Author Name"
              v-model="form.author"
              :error="form.errors.author"
            />
          </div>

          <div>
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
              Body text
            </h2>
            <WYSISWYGEditor v-model="form.body" />
            <div v-if="form.errors.body" class="text-red-700 mt-2 text-sm">
              {{ form.errors.body }}
            </div>
          </div>
          <div class="mt-6 space-x-4">
            <div class="flex items-center gap-5 mb-4">
              <PrimaryButton class="px-10" type="submit">
                Publish
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

            <div
              class="flex items-center gap-4 text-gray-900 dark:text-gray-100"
            >
              <input
                id="status"
                type="checkbox"
                v-model="form.status"
                true-value="draft"
                false-value="published"
              />
              <label for="status"> Save as draft instead </label>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<style>
.blog-preview img {
  width: 1280px;
}
</style>

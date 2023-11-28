<script setup>
import { Head, useForm, usePage } from "@inertiajs/vue3";
import PageHeader from "@/Components/PageHeader.vue";
import FormInput from "@/Components/FormInput.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import FormInputImage from "@/Components/FormInputImage.vue";
import ImagePreview from "@/Components/ImagePreview.vue";
import WYSISWYGEditor from "@/Components/WYSISWYGEditor.vue";

const form = useForm({
  author: usePage().props.auth.user.full_name,
  body: "",
  title: "",
  status: "published",
  image: "",
});

const handleSelectedMedia = (files) => {
  form.image = files;
};

const submit = () => {
  form.post(route("posts.store"));
};
</script>

<template>
  <Head title="Create Post" />
  <PageHeader>Create Post</PageHeader>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="mx-2 md:mx-0 w-full blog-preview">
        <ImagePreview :src="form.image" />
      </div>
      <div
        class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg mx-2 md:mx-0 px-2 py-2 sm:px-4"
      >
        <form class="mt-5" @submit.prevent="submit">
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
            <PrimaryButton class="mb-4 px-10" type="submit">
              Publish
            </PrimaryButton>
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
  <div></div>
</template>

<style>
.blog-preview img {
  width: 1280px;
}

.ck-editor__editable_inline {
  min-height: 400px;
}

.dark {
  --ck-spacing-standard: 1rem;
}
</style>

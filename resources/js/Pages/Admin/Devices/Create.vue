<script setup>
import { Head, useForm } from '@inertiajs/inertia-vue3';
import PageHeader from '@/Components/PageHeader.vue';
import FormInput from "@/Components/FormInput.vue"
import FormSelect from "@/Components/FormSelect.vue"
import PrimaryButton from '@/Components/PrimaryButton.vue';

const props = defineProps({
  brands: {
    required: true
  }
})

const form = useForm({
  name: "",
  brand_id: ""
})

const submit = () => {
  form.post(route('devices.store'))
}

</script>
<template>

  <Head title="Create Device" />
  <PageHeader>Create Device</PageHeader>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mx-2 md:mx-0">
        <form class="max-w-md mx-auto mt-10" @submit.prevent="submit">
          <div class="flex">
            <FormInput label="Name" v-model="form.name" :error="form.errors.name" />
            <FormSelect label="Brand" v-model="form.brand_id" :error="form.errors.brand_id">
              <option value="">Select a brand</option>
              <option v-for="brand in brands" :value="brand.id">{{ brand.name }}</option>
            </FormSelect>
          </div>
          <PrimaryButton class="mb-4 px-10" type="submit">
            Add
          </PrimaryButton>
        </form>
      </div>
    </div>
  </div>
</template>
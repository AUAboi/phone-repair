<script setup>
import { Head, useForm } from '@inertiajs/inertia-vue3';
import PageHeader from '@/Components/PageHeader.vue';
import FormInput from "@/Components/FormInput.vue"
import FormSelect from "@/Components/FormSelect.vue"
import PrimaryButton from '@/Components/PrimaryButton.vue';

const props = defineProps({
  device: {
    required: true
  },
  repairs: {
    required: true
  }
})

const form = useForm({
  title: "",
  repair_id: "",
  price: "",
  body: ""
})

const submit = () => {
  form.post(route('device.repair.store', props.device.slug))
}

</script>
<template>

  <Head title="Add Repair" />
  <PageHeader>Add Repair for {{ device.name }}</PageHeader>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
        <form class="max-w-md mr-auto " @submit.prevent="submit">
          <div class="flex">
            <FormInput label="Title" v-model="form.title" :error="form.errors.title" />
          </div>
          <div class="flex">
            <FormInput step=".01" label="Price" type="number" v-model="form.price" :error="form.errors.price" />
            <FormSelect label="Repair Type" v-model="form.repair_id" :error="form.errors.repair_id">
              <option value="">Select a repair type</option>
              <option v-for="repair in repairs" :value="repair.id">{{ repair.title }}</option>
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
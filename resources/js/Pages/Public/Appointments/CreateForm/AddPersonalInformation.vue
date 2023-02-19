<script setup>
import { useStepFormStore } from '@/store/stepForm';
import IconArrowForward from "~icons/mdi/arrow-right"
import StepFormInput from "@/Components/StepFormInput.vue"

const stepForm = useStepFormStore()
</script>

<template>
  <div class="max-w-5xl mx-auto">
    <div class="text-center my-12">
      <h2 class="text-4xl text-pink-600 ">Almost There</h2>
      <h2 class="text-5xl text-pink-600 font-semibold ">Add Your Personal Information</h2>
    </div>

    <div class="flex flex-col md:flex-row justify-between   gap-6">
      <div class="flex flex-wrap flex-grow">
        <div class="p-2 w-1/2">
          <div class="relative">
            <StepFormInput label="First Name" v-model="stepForm.form.first_name"
              :error="stepForm.form.errors.first_name" />
          </div>
        </div>
        <div class="p-2 w-1/2">
          <div class="relative">
            <StepFormInput label="Last Name" v-model="stepForm.form.last_name" :error="stepForm.form.errors.last_name" />
          </div>
        </div>
        <div class="p-2 w-1/2">
          <div class="relative">
            <StepFormInput label="Email" v-model="stepForm.form.email" :error="stepForm.form.errors.email" />
          </div>
        </div>
        <div class="p-2 w-1/2">
          <div class="relative">
            <StepFormInput label="Phone" v-model="stepForm.form.phone" :error="stepForm.form.errors.phone" />
          </div>
        </div>
        <div class="p-2 w-full">
          <div class="relative">
            <label for="message" class="leading-7 text-sm text-gray-600">Message</label>
            <textarea v-model="stepForm.form.message" id="message" name="message"
              class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out"></textarea>
          </div>
        </div>
      </div>
      <div class="flex flex-col bg-white shadow-lg rounded-md px-4 py-2 max-w-fit md:max-w-none mx-auto">
        <div class="p-2">
          <div class="relative">
            <StepFormInput label="Address" v-model="stepForm.form.address" :error="stepForm.form.errors.address" />
          </div>
        </div>
        <div class="p-2">
          <div class="relative">
            <StepFormInput label="City" v-model="stepForm.form.city" :error="stepForm.form.errors.city" />

          </div>
        </div>
        <div class="p-2">
          <div class="relative">
            <StepFormInput label="Zip Code" v-model="stepForm.form.zip_code" :error="stepForm.form.errors.zip_code" />
          </div>
        </div>
      </div>
    </div>
    <div class="mt-8">
      <button class="btn--cta mx-auto md:mx-0 px-9 py-1 flex-grow flex items-center" @click.prevent="stepForm.submit">Book
        <IconArrowForward />
      </button>
    </div>
  </div>
</template>
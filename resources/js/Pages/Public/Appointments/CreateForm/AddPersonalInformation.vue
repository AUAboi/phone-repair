<script setup>
import { useStepFormStore } from '@/store/stepForm';
import IconArrowForward from "~icons/mdi/arrow-right"

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
            <label for="name" class="leading-7 text-sm text-gray-600">First Name</label>
            <input type="text" v-model="stepForm.form.first_name"
              class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-pink-500 focus:bg-white focus:ring-2 focus:ring-pink-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
          </div>
        </div>
        <div class="p-2 w-1/2">
          <div class="relative">
            <label for="name" class="leading-7 text-sm text-gray-600">Last Name</label>
            <input type="text" v-model="stepForm.form.last_name"
              class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-pink-500 focus:bg-white focus:ring-2 focus:ring-pink-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
          </div>
        </div>
        <div class="p-2 w-1/2">
          <div class="relative">
            <label for="email" class="leading-7 text-sm text-gray-600">Email</label>
            <input type="email" v-model="stepForm.form.email"
              class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-pink-500 focus:bg-white focus:ring-2 focus:ring-pink-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
          </div>
        </div>
        <div class="p-2 w-1/2">
          <div class="relative">
            <label for="phone" class="leading-7 text-sm text-gray-600">Phone</label>
            <input type="text" v-model="stepForm.form.phone"
              class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-pink-500 focus:bg-white focus:ring-2 focus:ring-pink-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
          </div>
        </div>
        <div class="p-2 w-full">
          <div class="relative">
            <label for="message" class="leading-7 text-sm text-gray-600">Message</label>
            <textarea id="message" name="message"
              class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out"></textarea>
          </div>
        </div>
      </div>
      <div class="flex flex-col bg-white shadow-lg rounded-md px-4 py-2 max-w-fit md:max-w-none mx-auto">
        <div class="p-2">
          <div class="relative">
            <label for="address" class="leading-7 text-sm text-gray-600">Address</label>
            <input type="text" v-model="stepForm.form.address"
              class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-pink-500 focus:bg-white focus:ring-2 focus:ring-pink-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
          </div>
        </div>
        <div class="p-2">
          <div class="relative">
            <label for="city" class="leading-7 text-sm text-gray-600">City</label>
            <input type="text" v-model="stepForm.form.city"
              class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-pink-500 focus:bg-white focus:ring-2 focus:ring-pink-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
          </div>
        </div>
        <div class="p-2">
          <div class="relative">
            <label for="city" class="leading-7 text-sm text-gray-600">Zip Code</label>
            <input type="text" v-model="stepForm.form.zip"
              class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-pink-500 focus:bg-white focus:ring-2 focus:ring-pink-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
          </div>
        </div>

      </div>

    </div>
    <div class="mt-8">
      <button class="btn--cta mx-auto md:mx-0 px-9 py-1 flex-grow flex items-center" @click.prevent="">Book
        <IconArrowForward />
      </button>
    </div>
  </div>
</template>
<script setup>
import StepFormInput from "@/Components/StepFormInput.vue";
import { Head, useForm, usePage } from "@inertiajs/vue3";
import { onMounted, ref } from "vue";
import IconArrowForward from "~icons/mdi/arrow-right";
import Datepicker from "@vuepic/vue-datepicker";
import "@vuepic/vue-datepicker/dist/main.css";
const props = defineProps(["product"]);

const form = useForm({
  appointment_date: null,
  appointment_time: null,
  first_name: null,
  last_name: null,
  email: null,
  city: null,
  phone: null,
  zip_code: null,
  address: null,
  message: null,
});

let now = new Date();
// const minDate = new Date(Date.now() + (3600 * 1000 * 24))
const minDate = new Date();

const startTime = ref({ hours: now.getHours(), minutes: 0 });

const submit = () => {
  form.post(route("public.appointments.product.create", props.product.id), {
    preserveState: true,
  });
};

const page = usePage();
onMounted(() => {
  if (page.props.auth.user) {
    let user = page.props.auth.user;
    form.first_name = user.first_name;
    form.last_name = user.last_name;
    form.email = user.email;
  }
});
</script>
<template>
  <Head :title="`Book ${props.product.name}`" />
  <section class="pt-12">
    <div v-if="form.hasErrors" class="ml-6 text-red-600 md:max-w-sm md:mx-auto">
      <h4 class="text-lg">There are some errors:</h4>
      <ul class="list-disc ml-8">
        <li v-for="error in form.errors">{{ error }}</li>
      </ul>
    </div>

    <form class="py-8 px-2 flex items-center">
      <div class="max-w-5xl mx-auto">
        <div>
          <div class="text-center my-12">
            <h2 class="text-5xl text-red-600 font-semibold py-4">
              Choose Appointment Time
            </h2>
            <p class="text-xl font-semibold tracking-wide">Visit us in store</p>
          </div>
          <div
            class="grid grid-cols-1 sm:grid-cols-2 gap-8 sm:gap-0 justify-items-center max-w-4xl mx-auto justify-center"
          >
            <Datepicker
              required
              inline
              v-model="form.appointment_date"
              auto-apply
              :min-date="minDate"
              :enable-time-picker="false"
              :month-change-on-scroll="false"
            />
            <Datepicker
              required
              inline
              v-model="form.appointment_time"
              auto-apply
              :is24="false"
              time-picker
              no-minutes-overlay
              :minutes-increment="30"
              :start-time="startTime"
            >
              <template #am-pm-button="{ toggle, value }">
                <button @click.prevent="toggle">{{ value }}</button>
              </template>
            </Datepicker>
          </div>
        </div>
        <div class="text-center my-12">
          <h2 class="text-5xl text-red-600 font-semibold">
            Add Your Personal Information
          </h2>
        </div>

        <div class="flex flex-col md:flex-row justify-between gap-6">
          <div class="flex flex-wrap flex-grow">
            <div class="p-2 w-1/2">
              <div class="relative">
                <StepFormInput
                  label="First Name"
                  v-model="form.first_name"
                  :error="form.errors.first_name"
                />
              </div>
            </div>
            <div class="p-2 w-1/2">
              <div class="relative">
                <StepFormInput
                  label="Last Name"
                  v-model="form.last_name"
                  :error="form.errors.last_name"
                />
              </div>
            </div>
            <div class="p-2 w-1/2">
              <div class="relative">
                <StepFormInput
                  label="Email"
                  v-model="form.email"
                  :error="form.errors.email"
                />
              </div>
            </div>
            <div class="p-2 w-1/2">
              <div class="relative">
                <StepFormInput
                  label="Phone"
                  v-model="form.phone"
                  :error="form.errors.phone"
                />
              </div>
            </div>
            <div class="p-2 w-full">
              <div class="relative">
                <label for="message" class="leading-7 text-sm text-gray-600"
                  >Message</label
                >
                <textarea
                  v-model="form.message"
                  :error="form.errors.address"
                  class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-red-600 focus:bg-white focus:ring-2 focus:ring-red-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out"
                ></textarea>
              </div>
            </div>
          </div>
          <div
            class="flex flex-col bg-white shadow-lg rounded-md px-4 py-2 max-w-fit md:max-w-none mx-auto"
          >
            <div class="p-2">
              <div class="relative">
                <StepFormInput
                  label="Address"
                  v-model="form.address"
                  :error="form.errors.address"
                />
              </div>
            </div>
            <div class="p-2">
              <div class="relative">
                <StepFormInput
                  label="City"
                  v-model="form.city"
                  :error="form.errors.city"
                />
              </div>
            </div>
            <div class="p-2">
              <div class="relative">
                <StepFormInput
                  label="Post Code"
                  v-model="form.zip_code"
                  :error="form.errors.zip_code"
                />
              </div>
            </div>
          </div>
        </div>
        <div class="mt-8 text-center">
          <button
            class="btn-action mx-auto md:mx-0 px-9 py-1 flex-grow flex items-center bg-red-600 text-white before:bg-black text-xl font-bold"
            @click.prevent="submit"
          >
            Book
            <IconArrowForward />
          </button>
        </div>
      </div>
    </form>
  </section>
</template>

<style scoped></style>

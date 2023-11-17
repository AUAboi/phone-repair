<script setup>
import StepFormInput from "@/Components/StepFormInput.vue";
import { Head, useForm, usePage } from "@inertiajs/vue3";
import CartCheckout from "@/Pages/Public/Cart/Partials/CartCheckout.vue";

const page = usePage();
const form = useForm({
  first_name: page.props.auth.user?.first_name,
  last_name: page.props.auth.user?.last_name,
  phone: page.props.auth.user?.phone,
  email: page.props.auth.user?.email,
  zip_code: null,
  address: null,
  message: null,
  city: null,
  card: "",
});

const props = defineProps(["cart", "quantity", "total"]);

const submit = () => {
  form.post(route("order.store"));
};
</script>

<template>
  <Head title="Checkout" />
  <div class="container mx-auto mb-16 pt-36">
    <div class="flex justify-evenly flex-wrap-reverse gap-14 sm:gap-6 md:gap-0">
      <div class="flex-grow">
        {{ form }}
        <h2 class="text-3xl text-center font-bold">Complete your purchase</h2>
        <form
          class="max-w-xs sm:max-w-4xl mx-4 sm:mx-auto mt-8"
          @submit.prevent="submit"
        >
          <h3 class="text-2xl font-bold">Personal info</h3>
          <div class="flex flex-wrap flex-grow">
            <div class="p-2 w-full md:w-1/2">
              <div class="relative">
                <StepFormInput
                  label="First Name"
                  v-model="form.first_name"
                  :error="form.errors.first_name"
                />
              </div>
            </div>
            <div class="p-2 w-full md:w-1/2">
              <div class="relative">
                <StepFormInput
                  label="Last Name"
                  v-model="form.last_name"
                  :error="form.errors.last_name"
                />
              </div>
            </div>
            <div class="p-2 w-full md:w-1/2">
              <div class="relative">
                <StepFormInput
                  label="Email"
                  v-model="form.email"
                  :error="form.errors.email"
                />
              </div>
            </div>
            <div class="p-2 w-full md:w-1/2">
              <div class="relative">
                <StepFormInput
                  label="Phone"
                  v-model="form.phone"
                  :error="form.errors.phone"
                />
              </div>
            </div>
          </div>
          <div
            class="flex flex-col bg-white rounded-md py-2 max-w-fit md:max-w-none mx-auto"
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
            <div class="p-2 flex flex-wrap">
              <div class="relative w-full md:w-1/2">
                <StepFormInput
                  label="City"
                  v-model="form.city"
                  :error="form.errors.city"
                />
              </div>
              <div class="relative w-full md:w-1/2">
                <StepFormInput
                  label="Zip Code"
                  v-model="form.zip_code"
                  :error="form.errors.zip_code"
                />
              </div>
            </div>
          </div>
          <h3 class="text-2xl font-bold">Payment info</h3>
          <div class="mt-6">
            <p class="text-red-500" v-if="form.card.error">
              {{ form.card.error.message }}
            </p>

            <CartCheckout v-model="form.card" />
          </div>

          <div class="mt-8">
            <button
              :disabled="form.processing || !form.card.token"
              class="flex mx-auto hover:bg-blue-600 bg-blue-500 disabled:bg-gray-400 disabled:cursor-not-allowed text-white px-8 py-1 rounded-sm"
            >
              Pay Now
            </button>
          </div>
        </form>
      </div>

      <div
        id="summary"
        class="px-8 py-10 flex-grow border border-gray-300 bg-gray-200 flex flex-col"
      >
        <h1 class="font-semibold text-2xl border-b pb-8">Order Summary</h1>
        <div class="flex justify-between mt-10 mb-5 gap-4">
          <span v-for="item in cart.content" class="text-sm">
            x{{ item.quantity }} {{ item.name }}</span
          >
          <span class="font-semibold text-sm">{{ cart.total }}</span>
        </div>

        <div class="border-t mt-auto">
          <div
            class="flex font-semibold justify-between py-6 text-sm uppercase"
          >
            <span>Total cost</span>
            <span>{{ cart.total }}</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

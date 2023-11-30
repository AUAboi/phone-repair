<script setup>
import FormInput from "@/Components/FormInput.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";

const form = useForm({
  tracking_number: "",
});
</script>

<template>
  <Head title="Track your order" />
  <section class="pb-24 pt-52">
    <div class="text-center">
      <h2 class="text-5xl">Track your order</h2>
      <p>Enter order number (without #)</p>
      <div class="w-fit mx-auto mt-4">
        <FormInput class="pb-0 pr-0 mb-4" v-model="form.tracking_number" />
      </div>
      <Link
        :href="route('order.show', form.tracking_number)"
        class="py-2 px-6 bg-red-500 text-white"
        >Search</Link
      >
    </div>
  </section>
</template>

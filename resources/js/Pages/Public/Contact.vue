<script setup>
import MapMarkerOutline from "~icons/mdi/map-marker-outline";
import PhoneInTalkOutline from "~icons/mdi/phone-in-talk-outline";
import EmailOutline from "~icons/mdi/email-outline";
import { Head, useForm } from "@inertiajs/vue3";

const form = useForm({
  name: "",
  email: "",
  subject: "",
  message: "",
});

const submit = () => {
  form.post(route("contact.send"), {
    preserveScroll: true,
    preserveState: false,
  });
};
</script>
<template>
  <Head title="Contact Us" />
  <section
    style="background-image: url('images/contact-banner.webp')"
    class="bg-cover bg-center bg-no-repeat py-96 px-6"
  ></section>
  <section class="text-gray-600 body-font">
    <div style="height: 50vh">
      <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1881891.6869183437!2d0.5950476238939963!3d49.35176509216799!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4875ac419aa2315b%3A0xb94ad6f3462e8815!2sFONE%20MART!5e0!3m2!1sen!2s!4v1679419445823!5m2!1sen!2s"
        width="100%"
        height="100%"
        style="border: 0"
        allowfullscreen=""
        loading="lazy"
        referrerpolicy="no-referrer-when-downgrade"
      ></iframe>
    </div>
  </section>
  <section class="py-24">
    <div class="container flex flex-col md:flex-row gap-12 mx-auto">
      <div class="p-4">
        <h2 class="font-bold text-3xl pb-6">Get in Touch</h2>
        <p class="text-2xl">
          If you are interested in working with us, please get in touch.
        </p>
        <div class="text-2xl space-y-2 mt-6">
          <div class="flex items-center gap-4">
            <div class="text-red-600 text-5xl">
              <MapMarkerOutline />
            </div>
            <p class="text-lg">16 The Arcade, Bognor Regis</p>
          </div>
          <div class="flex items-center gap-4">
            <div class="text-red-600 text-5xl">
              <PhoneInTalkOutline />
            </div>
            <p class="text-lg">+44 1243 862501</p>
          </div>
          <div class="flex items-center gap-4">
            <div class="text-red-600 text-5xl">
              <EmailOutline />
            </div>
            <p class="text-lg">info@fonemart.com</p>
          </div>
        </div>
      </div>
      <div class="flex-grow p-4">
        <h2 class="font-bold text-3xl pb-6">Feedback</h2>
        <div class="mb-5" v-if="form.hasErrors">
          <div class="text-red-500" v-for="error in form.errors">
            {{ error }}
          </div>
        </div>
        <div class="space-y-8">
          <div class="flex flex-col sm:flex-row gap-8">
            <input
              class="border-gray-300 bg-gray-100 h-14 w-full focus:border-none focus:ring-red-500"
              type="text"
              placeholder="Your Name"
              v-model="form.name"
            />

            <input
              class="border-gray-300 bg-gray-100 h-14 w-full focus:border-none focus:ring-red-500"
              type="email"
              placeholder="Your Email"
              v-model="form.email"
            />
          </div>
          <div>
            <input
              class="border-gray-300 bg-gray-100 h-14 w-full focus:border-none focus:ring-red-500"
              type="text"
              placeholder="Subject"
              v-model="form.subject"
            />
          </div>
          <div>
            <textarea
              placeholder="Your Message"
              v-model="form.message"
              class="border-gray-300 bg-gray-100 h-14 w-full focus:border-none focus:ring-red-500 min-h-[130px]"
            ></textarea>
          </div>
          <button
            @click.prevent="submit"
            class="btn-action text-xl text-white py-4 px-10 bg-red-600 before:bg-black"
          >
            Submit
          </button>
        </div>
      </div>
    </div>
  </section>
</template>

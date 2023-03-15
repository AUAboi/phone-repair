<script setup>
import MapMarkerOutline from "~icons/mdi/map-marker-outline";
import PhoneInTalkOutline from "~icons/mdi/phone-in-talk-outline";
import EmailOutline from "~icons/mdi/email-outline"

</script>
<template>
  <section style="background-image: url('images/contact-banner.jpg');" class="bg-cover bg-center bg-no-repeat py-96 px-6">

  </section>
  <section class="text-gray-600 body-font">
    <div style="height: 50vh;">
      <iframe width="100%" height="100%" frameborder="0" marginheight="0" marginwidth="0" title="map" scrolling="no"
        src="https://maps.google.com/maps?width=100%&amp;height=600&amp;hl=en&amp;q=%C4%B0zmir+(My%20Business%20Name)&amp;ie=UTF8&amp;t=&amp;z=14&amp;iwloc=B&amp;output=embed"></iframe>
    </div>
  </section>
  <section class="py-24">
    <div class="container flex flex-col md:flex-row gap-12 mx-auto">
      <div class="p-4">
        <h2 class="font-bold text-3xl pb-6">Get in Touch</h2>
        <p class="text-2xl">
          If you are interested in working with us, please get in touch.
        </p>
        <div class="text-2xl space-y-8">
          <div class="flex items-center gap-4">
            <div class="text-red-600 text-5xl">
              <MapMarkerOutline />
            </div>
            <p>This is address location</p>
          </div>
          <div class="flex items-center gap-4">
            <div class="text-red-600 text-5xl">
              <PhoneInTalkOutline />
            </div>
            <p>8 800 567.890.11 - Central Office</p>
          </div>
          <div class="flex items-center gap-4">
            <div class="text-red-600 text-5xl">
              <EmailOutline />
            </div>
            <p>This is address location</p>
          </div>
        </div>
      </div>
      <div class="flex-grow p-4">
        <h2 class="font-bold text-3xl pb-6">Feedback</h2>
        <form class="space-y-8">
          <div class="flex flex-col sm:flex-row gap-8">
            <input class="border-gray-300 bg-gray-100 h-14 w-full focus:border-none focus:ring-red-500" type="text"
              placeholder="Your Name">
            <input class="border-gray-300 bg-gray-100 h-14 w-full focus:border-none focus:ring-red-500" type="text"
              placeholder="Your Email">
          </div>
          <div>
            <input class="border-gray-300 bg-gray-100 h-14 w-full focus:border-none focus:ring-red-500" type="text"
              placeholder="Subject">
          </div>
          <div>
            <textarea placeholder="Your Message"
              class="border-gray-300 bg-gray-100 h-14 w-full focus:border-none focus:ring-red-500 min-h-[130px]"></textarea>
          </div>
          <button class="btn-action text-xl text-white py-4 px-10 bg-red-600 before:bg-black">
            Submit
          </button>
        </form>
      </div>
    </div>
  </section>
</template>
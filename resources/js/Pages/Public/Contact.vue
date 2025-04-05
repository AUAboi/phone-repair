<script setup>
import bg from "@/assets/img/shortcode/breadcumb.jpg";

import bg2 from "@/assets/img/ttttt.jpg";
import { onMounted, ref } from "vue";
import Aos from "aos";
import { Head, Link, useForm } from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";
import mobile from "@/assets/img/svg/contact.svg";

onMounted(() => {
  Aos.init();
});

const form = useForm({
  name: "",
  email: "",
  phone: "",
  subject: "",
  message: "",
});

const isOpen = ref(false);
const selectedOption = ref("Navana Furniture");

const options = [
  "Navana Furniture",
  "RFL Furniture",
  "Gazi Furniture",
  "Plastic Furniture",
  "Luxury Furniture",
];

const toggleDropdown = () => {
  isOpen.value = !isOpen.value;
};

const handleSelect = (option, event) => {
  event.stopPropagation();
  selectedOption.value = option;
  isOpen.value = false;
  form.subject = option;
};

const submit = () => {
  form.post(route("contact.send"), {
    preserveScroll: true,
    onSuccess: () => form.reset(),
  });
};
</script>
<template>
  <Head title="Contact Us" />
  <div
    class="flex items-center gap-4 flex-wrap bg-overlay p-14 sm:p-16 before:bg-title before:bg-opacity-70"
    :style="{ backgroundImage: 'url(' + bg + ')' }"
  >
    <div class="text-center w-full">
      <h2
        class="text-white text-8 md:text-[40px] font-normal leading-none text-center"
      >
        Contact Us
      </h2>
    </div>
  </div>

  <div class="s-pb-100 s-pt-100">
    <div class="container-fluid">
      <div class="max-w-[1720px] mx-auto flex justify-between gap-8">
        <div class="max-w-[894px] w-full hidden lg:block" data-aos="zoom-in">
          <img class="w-full" :src="bg2" alt="contct" />
        </div>
        <div class="max-w-[725px] w-full mx-auto lg:mx-0">
          <div data-aos="fade-up">
            <div class="max-w-14">
              <img :src="mobile" alt="" />
            </div>
            <h3 class="leading-none font-medium mt-3 md:mt-6 text-2xl">
              Get in Touch
            </h3>
            <p class="max-w-[474px] mt-3 md:mt-4 font-medium">
              We're here to address your inquiries, feedback, and partnership
              opportunities promptly and effectively.
            </p>
          </div>
          <div class="mt-8" data-aos="fade-up" data-aos-delay="100">
            <div>
              <div
                class="grid sm:grid-cols-2 lg:grid-cols-1 xl:grid-cols-2 gap-5 sm:gap-6"
              >
                <div>
                  <label
                    class="text-base md:text-lg text-title dark:text-white leading-none mb-2.5 block"
                    >Full Name</label
                  >
                  <input
                    class="w-full h-12 mb-2 md:h-14 bg-snow dark:bg-dark-secondary border border-[#E3E5E6] text-title dark:text-white focus:border-primary p-4 outline-none duration-300"
                    type="text"
                    v-model="form.name"
                    placeholder="Enter your full name"
                  />
                  <InputError :message="form.errors.name" />
                </div>
                <div>
                  <label
                    class="text-base md:text-lg text-title dark:text-white leading-none mb-2.5 block"
                    >Email</label
                  >
                  <input
                    class="w-full h-12 mb-2 md:h-14 bg-snow dark:bg-dark-secondary border border-[#E3E5E6] text-title dark:text-white focus:border-primary p-4 outline-none duration-300"
                    type="email"
                    v-model="form.email"
                    placeholder="Enter your email address"
                  />
                  <InputError :message="form.errors.email" />
                </div>
                <div>
                  <label
                    class="text-base md:text-lg text-title dark:text-white leading-none mb-2.5 block"
                    >Phone No.</label
                  >
                  <input
                    class="w-full h-12 mb-2 md:h-14 bg-snow dark:bg-dark-secondary border border-[#E3E5E6] text-title dark:text-white focus:border-primary p-4 outline-none duration-300"
                    type="number"
                    v-model="form.phone"
                    placeholder="Type your phone number"
                  />
                  <InputError :message="form.errors.phone" />
                </div>
                <div>
                  <label
                    class="text-base md:text-lg text-title dark:text-white leading-none mb-2.5 block"
                    >Subject</label
                  >
                  <input
                    class="w-full h-12 mb-2 md:h-14 bg-snow dark:bg-dark-secondary border border-[#E3E5E6] text-title dark:text-white focus:border-primary p-4 outline-none duration-300"
                    type="text"
                    v-model="form.subject"
                    placeholder="Subject"
                  />
                  <InputError :message="form.errors.subject" />
                </div>
              </div>
              <div class="mt-5 sm:gap-6">
                <label
                  class="text-base md:text-lg text-title dark:text-white leading-none mb-2.5 block"
                  >Your Message</label
                >
                <textarea
                  class="w-full h-28 md:h-[170px] bg-snow dark:bg-dark-secondary border border-[#E3E5E6] text-title dark:text-white focus:border-primary p-4 outline-none duration-300"
                  name="Message"
                  v-model="form.message"
                  placeholder="Type your message"
                ></textarea>
                <InputError :message="form.errors.message" />
              </div>
              <div class="mt-5">
                <button
                  @click="submit"
                  class="btn btn-solid"
                  data-text="Submit"
                >
                  <span>Submit</span>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="s-pb-100" data-aos="fade-up">
    <div class="container-fluid">
      <div class="max-w-[1720px] mx-auto">
        <iframe
          class="w-full h-[400px] md:h-[600px]"
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1881891.6869183437!2d0.5950476238939963!3d49.35176509216799!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4875ac419aa2315b%3A0xb94ad6f3462e8815!2sFONE%20MART!5e0!3m2!1sen!2s!4v1679419445823!5m2!1sen!2s"
          style="border: 0"
        ></iframe>
      </div>
    </div>
  </div>
</template>

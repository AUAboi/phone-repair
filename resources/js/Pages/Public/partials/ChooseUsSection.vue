<script setup>
import bg from "@/assets/img/home-v1/choose-us-bg.jpg";
import shape1 from "@/assets/img/home-v1/shape-01.png";
import like from "@/assets/img/svg/like.svg";
import fea1 from "@/assets/img/svg/fea-1.svg";
import fea2 from "@/assets/img/svg/fea-2.svg";
import fea3 from "@/assets/img/svg/fea-3.svg";
import fea4 from "@/assets/img/svg/fea-4.svg";
import fea5 from "@/assets/img/svg/fea-5.svg";

const features = [
  {
    id: 1,
    image: fea1,
    title: "Free Shipping",
    desc: "Enjoy free shipping on all orders, making your shopping experience even more convenient. Get your favorite products delivered.",
  },
  {
    id: 2,
    image: fea2,
    title: "Easy to Return",
    desc: `Experience hassle-free returns with our easy-to-use return policy. If you're not satisfied, simply return your product for a quick.`,
  },
  {
    id: 3,
    image: fea3,
    title: "Secure Payment",
    desc: `Shop with confidence using our secure payment options, ensuring your personal information stays protected. We prioritize your safety.`,
  },
  {
    id: 4,
    image: fea4,
    title: `Customer Support`,
    desc: `Our dedicated customer support team is here to assist you every step of the way. Reach out to us anytime for prompt, friendly help.`,
  },
];
</script>

<template>
  <div
    class="s-py-100 bg-overlay dark:before:bg-title dark:before:bg-opacity-80"
    :style="{ backgroundImage: 'url(' + bg + ')' }"
  >
    <img
      class="absolute top-0 right-0 w-[20%] z-[-1]"
      :src="shape1"
      alt="shape"
    />
    <div class="container-fluid">
      <div class="max-w-[1720px] mx-auto">
        <div class="max-w-[1186px] ml-auto">
          <div class="max-w-xl mb-8 md:mb-12" data-aos="fade-up">
            <div>
              <img :src="like" class="w-14 sm:w-24" alt="" />
            </div>
            <h3 class="leading-none mt-4 md:mt-6 text-2xl md:text-3xl">
              Why you Choose Us
            </h3>
            <p class="mt-3">
              Choose us for unparalleled quality, exceptional service, and a
              commitment to your satisfaction. Join countless others who rely on
              us for reliability.
            </p>
          </div>
          <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5 md:gap-[30px]">
            <div
              v-for="(item, index) in features"
              :key="index"
              class="why-choose-card p-6 rounded-[10px]"
              data-aos="fade-up"
              :ata-aos-delay="item.delay"
            >
              <img :src="item.image" class="size-12" alt="" />
              <h4
                class="font-semibold leading-none mt-5 sm:mt-7 text-xl md:text-2xl"
              >
                {{ item.title }}
              </h4>
              <p class="mt-[15px]">{{ item.desc }}</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

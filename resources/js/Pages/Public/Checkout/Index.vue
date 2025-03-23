<script setup>
import { Head, Link } from "@inertiajs/vue3";
import CartCheckout from "@/Pages/Public/Cart/Partials/CartCheckout.vue";
import bg from "@/assets/img/shortcode/breadcumb.jpg";
import { useCheckoutStore } from "@/store/checkoutStore";
import { storeToRefs } from "pinia";
import { ref } from "vue";
import InputError from "@/Components/InputError.vue";

const checkoutStore = useCheckoutStore();

const { form } = storeToRefs(checkoutStore);

const props = defineProps([
  "cartContents",
  "quantity",
  "total",
  "clientSecret",
  "stripeKey",
]);

const open = ref(false);
</script>

<template>
  <Head title="Checkout" />
  <div
    class="flex items-center gap-4 flex-wrap bg-overlay p-14 sm:p-16 before:bg-title before:bg-opacity-70"
    :style="{ backgroundImage: 'url(' + bg + ')' }"
  >
    <div class="text-center w-full">
      <h2
        class="text-white text-8 md:text-[40px] font-normal leading-none text-center"
      >
        Checkout
      </h2>
      <ul
        class="flex items-center justify-center gap-[10px] text-base md:text-lg leading-none font-normal text-white mt-3 md:mt-4 flex-wrap"
      >
        <li><Link :href="route('public.home')">Home</Link></li>
        <li>/</li>
        <li class="text-primary">Checkout</li>
      </ul>
    </div>
  </div>

  <div class="s-py-100">
    <div class="container">
      <div
        class="max-w-[1220px] mx-auto grid lg:grid-cols-2 gap-[30px] lg:gap-[70px]"
      >
        <div
          class="bg-[#FAFAFA] dark:bg-dark-secondary p-[30px] md:p-[40px] lg:p-[50px] border border-[#17243026] border-opacity-15 rounded-xl"
          data-aos="fade-up"
        >
          <p
            class="mb-5 w-full bg-white dark:bg-dark-secondary border border-[#E3E5E6] text-title dark:text-white focus:border-primary p-4 outline-none duration-300 whitespace-normal"
          >
            Are you missing your coupon code ?
            <button
              @click="open = !open"
              class="ml-1 add-coupon-code underline text-[#209A60]"
            >
              Click here to add
            </button>
          </p>

          <div v-if="open" class="coupon-wrapper gap-3 md:flex mb-[30px]">
            <input
              class="max-w-[220px] w-full h-12 md:h-14 bg-white dark:bg-dark-secondary border border-[#E3E5E6] text-title dark:text-white focus:border-primary p-4 outline-none duration-300"
              type="text"
              placeholder="Coupon code"
            />
            <span
              to="#"
              class="btn btn-sm-px btn-theme-solid"
              data-text="Apply coupon"
            >
              <span>Apply coupon</span>
            </span>
          </div>

          <h4
            class="font-semibold leading-none text-xl md:text-2xl mb-6 md:mb-[30px]"
          >
            Billing Information
          </h4>
          <div class="grid md:grid-cols-2 gap-5 md:gap-6 mb-5">
            <div>
              <label
                class="text-base md:text-lg text-title dark:text-white leading-none mb-2 sm:mb-3 block"
                >First Name</label
              >
              <input
                class="w-full h-12 md:h-14 bg-white dark:bg-dark-secondary border border-[#E3E5E6] text-title dark:text-white focus:border-primary p-4 outline-none duration-300"
                type="text"
                v-model="form.first_name"
                placeholder="Enter your first name"
              />
              <InputError :message="form.errors.first_name" />
            </div>
            <div>
              <label
                class="text-base md:text-lg text-title dark:text-white leading-none mb-2 sm:mb-3 block"
                >Last Name</label
              >
              <input
                class="w-full h-12 md:h-14 bg-white dark:bg-dark-secondary border border-[#E3E5E6] text-title dark:text-white focus:border-primary p-4 outline-none duration-300"
                type="text"
                v-model="form.last_name"
                placeholder="Enter your last name"
              />
              <InputError :message="form.errors.last_name" />
            </div>
          </div>

          <div class="grid gap-5 md:gap-6">
            <div>
              <label
                class="text-base md:text-lg text-title dark:text-white leading-none mb-2 sm:mb-3 block"
                >Email</label
              >
              <input
                class="w-full h-12 md:h-14 bg-white dark:bg-dark-secondary border border-[#E3E5E6] text-title dark:text-white focus:border-primary p-4 outline-none duration-300"
                type="text"
                v-model="form.email"
                placeholder="Enter your email address"
              />
              <InputError :message="form.errors.email" />
            </div>

            <div>
              <label
                class="text-base md:text-lg text-title dark:text-white leading-none mb-2 sm:mb-3 block"
                >Phone No.</label
              >
              <input
                class="w-full h-12 md:h-14 bg-white dark:bg-dark-secondary border border-[#E3E5E6] text-title dark:text-white focus:border-primary p-4 outline-none duration-300"
                type="number"
                placeholder="Type your phone number"
                v-model="form.phone"
              />
            </div>
          </div>

          <div class="grid md:grid-cols-2 gap-5 md:gap-6">
            <div class="mt-5">
              <label
                class="text-base md:text-lg text-title dark:text-white leading-none mb-2 sm:mb-3 block"
                >City</label
              >
              <input
                class="w-full h-12 md:h-14 bg-white dark:bg-dark-secondary border border-[#E3E5E6] text-title dark:text-white focus:border-primary p-4 outline-none duration-300"
                type="text"
                placeholder="City"
                v-model="form.city"
              />
              <InputError :message="form.errors.city" />
            </div>

            <div class="mt-5">
              <label
                class="text-base md:text-lg text-title dark:text-white leading-none mb-2 sm:mb-3 block"
                >Post Code</label
              >
              <input
                class="w-full h-12 md:h-14 bg-white dark:bg-dark-secondary border border-[#E3E5E6] text-title dark:text-white focus:border-primary p-4 outline-none duration-300"
                type="text"
                placeholder="1217"
                v-model="form.zip_code"
              />
              <InputError :message="form.errors.zip_code" />
            </div>
          </div>
          <div class="mt-5">
            <label
              class="text-base md:text-lg text-title dark:text-white leading-none mb-2 sm:mb-3 block"
              >Address
            </label>
            <input
              class="w-full h-12 md:h-14 bg-white dark:bg-dark-secondary border border-[#E3E5E6] text-title dark:text-white focus:border-primary p-4 outline-none duration-300"
              type="text"
              v-model="form.address"
              placeholder="Your full address"
            />
            <InputError :message="form.errors.address" />
          </div>
          <div class="mt-5">
            <label
              class="text-base md:text-lg text-title dark:text-white leading-none mb-2 sm:mb-3 block"
            >
              Additional Text
            </label>
            <textarea
              class="w-full h-[120px] bg-white dark:bg-dark-secondary border border-[#E3E5E6] text-title dark:text-white focus:border-primary p-4 outline-none duration-300"
              name="Message"
              placeholder="Type your message"
              v-model="form.message"
            ></textarea>
            <InputError :message="form.errors.message" />
          </div>
        </div>

        <div data-aos="fade-up" data-aos-delay="{200}">
          <div
            class="bg-[#FAFAFA] dark:bg-dark-secondary pt-[30px] md:pt-[40px] lg:pt-[50px] px-[30px] md:px-[40px] lg:px-[50px] pb-[30px] border border-[#17243026] border-opacity-15 rounded-xl"
          >
            <h4
              class="font-semibold leading-none text-xl md:text-2xl mb-6 md:mb-10"
            >
              Product Information
            </h4>
            <div class="grid gap-5 mg:gap-6">
              <div
                v-for="item in cartContents.content"
                class="flex items-center justify-between gap-5"
              >
                <div
                  class="flex items-center gap-3 md:gap-4 lg:gap-6 cart-product flex-wrap"
                >
                  <div class="w-16 sm:w-[70px] flex-none">
                    <img :src="item.associatedModel.image" alt="product" />
                  </div>
                  <div class="flex-1">
                    <h6 class="leading-none font-medium">
                      {{ item.associatedModel.category }}
                    </h6>
                    <h5 class="font-semibold leading-none mt-2">
                      <Link :href="route('public.product.show', item.id)">{{
                        item.name
                      }}</Link>
                    </h5>
                  </div>
                </div>

                <h6 class="leading-none">
                  {{ item.quantity }}&nbsp;x&nbsp;{{ item.price }}
                </h6>
              </div>
            </div>
            <div
              class="mt-6 pt-6 border-t border-bdr-clr dark:border-bdr-clr-drk text-right flex justify-end flex-col w-full ml-auto mr-0"
            >
              <div
                class="flex justify-between flex-wrap text-base sm:text-lg text-title dark:text-white font-medium"
              >
                <span>Sub Total:</span>
                <span>{{ cartContents.total }}</span>
              </div>
              <div
                class="flex justify-between flex-wrap text-base sm:text-lg text-title dark:text-white font-medium mt-3"
              >
                <span>Coupon Discount:</span>
                <span>0</span>
              </div>
              <div
                class="flex justify-between flex-wrap text-base sm:text-lg text-title dark:text-white font-medium mt-3"
              >
                <span>VAT:</span>
                <span> 0</span>
              </div>
            </div>

            <div
              class="mt-6 pt-6 border-t border-bdr-clr dark:border-bdr-clr-drk"
            >
              <div
                class="flex justify-between flex-wrap font-semibold leading-none text-2xl md:text-3xl"
              >
                <span>Total:</span>
                <span>&nbsp;{{ cartContents.total }}</span>
              </div>
            </div>
          </div>
          <div class="mt-7 md:mt-12">
            <h4
              class="font-semibold leading-none text-xl md:text-2xl mb-6 md:mb-10"
            >
              Payment Method
            </h4>
            <div class="flex gap-5 sm:gap-8 md:gap-12 flex-wrap">
              <div>
                <label class="flex items-center gap-[10px] categoryies-iteem">
                  <input
                    class="appearance-none hidden"
                    type="radio"
                    checked
                    name="item-type"
                  />
                  <span
                    class="w-4 h-4 rounded-full border border-title dark:border-white flex items-center justify-center duration-300"
                  >
                    <svg
                      class="duration-300 opacity-0"
                      width="8"
                      height="8"
                      viewBox="0 0 10 10"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <rect width="10" height="10" rx="5" fill="#BB976D" />
                    </svg>
                  </span>
                  <span
                    class="sm:text-lg text-title dark:text-white block sm:leading-none transform translate-y-[3px] select-none"
                    >Debit / Credit Card</span
                  >
                </label>
                <p class="ml-6 text-[15px] leading-none mt-2">
                  Time ( 07 - 10 ) Days
                </p>
              </div>
            </div>
            <div class="mt-6">
              <CartCheckout
                :client-secret="clientSecret"
                :stripe-key="stripeKey"
                :form="form"
              />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

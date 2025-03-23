<script setup lang="ts">
import { ref, defineProps, useTemplateRef, onMounted, watchEffect } from "vue";
import { Link } from "@inertiajs/vue3";
import { StripeElements, StripeElement } from "vue-stripe-js";
import { useCheckoutStore } from "@/store/checkoutStore";
import { loadStripe, Stripe } from "@stripe/stripe-js";
import { storeToRefs } from "pinia";
import useSweetAlert from "@/Composables/useSweetAlert";

const props = defineProps<{
  clientSecret: string;
  stripeKey: string;
}>();

const { alertError } = useSweetAlert();

const checkoutStore = useCheckoutStore();

const { form } = storeToRefs(checkoutStore);

const stripeInstance = ref<Stripe | null>(null);

const stripeLoaded = ref(false);
const elementsComponent = useTemplateRef("elementsComponent");

const elementsOptions = ref({
  clientSecret: null,
  appearance: { theme: "flat" },
  paymentMethodCreation: "manual",
});

const stripeOptions = ref({});
const paymentElementOptions = ref({});

onMounted(async () => {
  stripeInstance.value = await loadStripe(props.stripeKey);

  elementsOptions.value.clientSecret = props.clientSecret;
  stripeLoaded.value = true;
});

const terms = ref();

async function handleSubmit() {
  if (!terms.value) {
    alertError({ title: "Terms and conditions not agreed" });
    return;
  }
  if (!elementsComponent.value) return;

  const { instance } = elementsComponent.value;
  if (!instance) return;

  elementsComponent.value.elements.submit();

  const { error, paymentMethod } = await instance.createPaymentMethod({
    elements: elementsComponent.value.elements,
  });

  const { paymentIntent } = await stripeInstance.value.retrievePaymentIntent(
    props.clientSecret
  );

  if (error) {
    console.error(error);
    return;
  }

  form.value.paymentMethodId = paymentMethod.id;
  form.value.paymentIntentId = paymentIntent.id;

  form.value.post(route("order.store"));
}
</script>

<template>
  <form v-if="stripeLoaded && clientSecret">
    <StripeElements
      :stripe-key="props.stripeKey"
      :instance-options="stripeOptions"
      :elements-options="elementsOptions"
      v-slot="{ elements, instance }"
      ref="elementsComponent"
      class="pb-4"
    >
      <StripeElement
        type="payment"
        :options="paymentElementOptions"
        :elements="elements"
        ref="paymentComponent"
      />
    </StripeElements>
  </form>

  <div class="mt-6 sm:mt-8 md:mt-10">
    <label class="flex items-center gap-2 iam-agree">
      <input
        class="appearance-none hidden"
        type="checkbox"
        name="terms"
        v-model="terms"
      />
      <span
        class="w-6 h-6 rounded-[5px] border-2 border-title dark:border-white flex items-center justify-center duration-300"
      >
        <svg
          class="duration-300 opacity-0 text-title dark:text-white fill-current"
          width="15"
          height="12"
          viewBox="0 0 20 15"
          fill="none"
          xmlns="http://www.w3.org/2000/svg"
        >
          <path
            d="M18.3819 0.742676L6.10461 11.8998L2.25731 8.06381L0.763672 9.55745L6.20645 15.0002L20 2.32686L18.3819 0.742676Z"
          />
        </svg>
      </span>
      <span
        class="text-base sm:text-lg text-title dark:text-white leading-none sm:leading-none select-none inline-block transform translate-y-[3px]"
        >I Agree all
        <Link class="underline cursor-pointer" :href="route('public.terms')"
          >terms & conditions</Link
        >
      </span>
    </label>
  </div>
  <div class="mt-4 md:mt-6 flex flex-wrap gap-3">
    <Link
      :href="route('cart.index')"
      as="button"
      class="btn btn-outline"
      data-text="Back to Cart"
      ><span>Back to Cart</span></Link
    >
    <button
      @click.prevent="handleSubmit"
      class="btn btn-theme-solid"
      data-text="Place to Order"
      :disabled="form.processing"
    >
      <span>Place to Order</span>
    </button>
  </div>
</template>

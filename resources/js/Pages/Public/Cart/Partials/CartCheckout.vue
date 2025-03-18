<template>
  <form
    v-if="stripeLoaded && clientSecret != null"
    @submit.prevent="handleSubmit"
  >
    <StripeElements
      :stripe-key="stripeKey"
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

    <button
      type="submit"
      class="focus:outline-none text-white bg-indigo-700 hover:bg-indigo-800 focus:ring-4 focus:ring-indigo-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-900"
    >
      Submit
    </button>
  </form>
</template>

<script setup lang="ts">
import { loadStripe } from "@stripe/stripe-js";

/**
 * DEFERRED PAYMENT
 * This Payment Element example is based on
 * https://docs.stripe.com/payments/accept-a-payment-deferred?type=payment
 */
import { onBeforeMount, ref, useTemplateRef } from "vue";
import { StripeElements, StripeElement } from "vue-stripe-js";

const stripeKey =
  "pk_test_51R3y6r2LkFthmFnkaQnX4fbsr9dUKL8hX6k4FUBFD6rLPodNrORYCf3tlr7KL0UWXKR5ndR9KPR1zMNSRNGuJkw200ThcIXJpP";
const stripeOptions = ref({
  // https://stripe.com/docs/js/initializing#init_stripe_js-options
});
const clientSecret = ref(null);

const elementsOptions = ref({
  // https://stripe.com/docs/js/elements_object/create#stripe_elements-options
  clientSecret: clientSecret.value,
  appearance: {
    theme: "flat",
  },
});
const paymentElementOptions = ref({
  // https://docs.stripe.com/js/elements_object/create_payment_element#payment_element_create-options
});
const stripeLoaded = ref(false);

// Vue 3.5 and newer, for older vue versions use ref()
const elementsComponent = useTemplateRef("elementsComponent");
const paymentComponent = useTemplateRef("paymentComponent");

onBeforeMount(async () => {
  loadStripe(stripeKey).then(async () => {
    stripeLoaded.value = true;

    const response = await fetch("/api/payment-intent", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ amount: 1099, currency: "eur" }),
    });

    const { client_secret } = await response.json();
    clientSecret.value = client_secret;

    elementsOptions.value.clientSecret = client_secret;
  });
});

async function handleSubmit() {
  // Confirm the PaymentIntent using the details collected by the Payment Element
  const stripeInstance = elementsComponent.value?.instance;
  const elements = elementsComponent.value?.elements;

  if (stripeInstance) {
    const { error } = await stripeInstance.confirmPayment({
      elements,
      confirmParams: {
        return_url: route("public.order.tracking"),
      },
    });

    if (error) {
      // This point is only reached if there's an immediate error when
      // confirming the payment. Show the error to your customer (for example, payment details incomplete)
      console.log(error);
    } else {
      // Your customer is redirected to your `return_url`. For some payment
      // methods like iDEAL, your customer is redirected to an intermediate
      // site first to authorize the payment, then redirected to the `return_url`.
    }
  }
}
</script>

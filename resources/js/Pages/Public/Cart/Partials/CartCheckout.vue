<script setup>
import { StripeElements, StripeElement } from "vue-stripe-js";
import { loadStripe } from "@stripe/stripe-js";
import { ref, onBeforeMount } from "vue";

const stripeKey = ref(import.meta.env.VITE_STRIPE_PUBLIC_KEY); // test key

const stripeLoaded = ref(false);
const card = ref();
const elms = ref();

onBeforeMount(() => {
  const stripePromise = loadStripe(stripeKey.value);
  stripePromise.then(() => {
    stripeLoaded.value = true;
  });
});

const props = defineProps({
  modelValue: {
    type: [String, Number],
    default: "",
  },
});

const emit = defineEmits(["update:modelValue"]);
const pay = () => {
  const cardElement = card.value.stripeElement;

  elms.value.instance.createToken(cardElement).then((result) => {
    emit("update:modelValue", result);
  });
};
</script>

<template>
  <StripeElements
    v-if="stripeLoaded"
    v-slot="{ elements, instance }"
    ref="elms"
    :stripe-key="stripeKey"
  >
    <StripeElement
      class="border border-gray-300 shadow-sm p-2 rounded-md"
      ref="card"
      :elements="elements"
      :options="{ hidePostalCode: true }"
      @change="pay"
    />
  </StripeElements>
</template>

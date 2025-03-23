import { defineStore } from "pinia";
import { ref } from "vue";
import { loadStripe, Stripe } from "@stripe/stripe-js";
import { useForm, usePage } from "@inertiajs/vue3";

export const useCheckoutStore = defineStore("checkout", () => {
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
    paymentIntentId: "",
    paymentMethodId: "",
  });

  return {
    form,
  }
});

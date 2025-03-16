<script setup>
import { useForm, usePage } from "@inertiajs/vue3";
import { computed } from "vue";

const form = useForm({
  id: null,
});

const props = defineProps(["item"]);

const increment = () => {
  addToCart(props.item.id);
};

const decrement = () => {
  removeFromCart(props.item.id);
};

const addToCart = (id) => {
  form.id = id;
  form.post(route("cart.add"), {
    preserveScroll: true,
    preserveState: true,
  });
};

const removeFromCart = (id) => {
  form.id = id;
  form.post(route("cart.remove"), {
    preserveScroll: true,
    preserveState: true,
  });
};

const cart = computed(() => usePage().props.cart);

const cartItem = computed(() => {
  return (
    Object.values(cart.value.content).find(
      (item) => item.id === props.item.id
    ) || null
  );
});
</script>

<template>
  <div class="inc-dec flex items-center gap-2" v-if="cartItem">
    <button
      @click="decrement"
      class="dec w-8 h-8 bg-[#E8E9EA] dark:bg-dark-secondary flex items-center justify-center"
    >
      <svg
        class="fill-current text-title dark:text-white"
        width="14"
        height="2"
        viewBox="0 0 14 2"
        fill="none"
        xmlns="http://www.w3.org/2000/svg"
      >
        <path
          d="M10.4361 0.203613H12.0736L7.81774 0.203615H13.8729V1.80309H7.81774L3.50809 1.80309H1.87053L6.18017 1.80309H0.125V0.203615H6.18017L10.4361 0.203613Z"
        />
      </svg>
    </button>
    <input
      class="w-6 h-auto outline-none bg-transparent text-base mg:text-lg leading-none text-title dark:text-white text-center"
      type="text"
      :value="cartItem.quantity"
    />
    <button
      @click="increment"
      class="inc w-8 h-8 bg-[#E8E9EA] dark:bg-dark-secondary flex items-center justify-center"
    >
      <svg
        class="fill-current text-title dark:text-white"
        width="14"
        height="14"
        viewBox="0 0 14 14"
        fill="none"
        xmlns="http://www.w3.org/2000/svg"
      >
        <path
          d="M6.18017 0.110352H7.81774V6.16553H13.8729V7.76501H7.81774V13.8963H6.18017V7.76501H0.125V6.16553H6.18017V0.110352Z"
        />
      </svg>
    </button>
  </div>
</template>

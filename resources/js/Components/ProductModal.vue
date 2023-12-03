<script setup>
import Modal from "@/Components/Modal.vue";
import CloseCircle from "~icons/mdi/close-circle";
import ActionButton from "./ActionButton.vue";
import { useForm, usePage } from "@inertiajs/vue3";
import { computed } from "vue";

const props = defineProps({
  modalToggle: {
    required: true,
    type: Boolean,
    default: false,
  },
  product: {
    required: true,
  },
});

const emit = defineEmits(["close"]);

const form = useForm({
  id: null,
});

const cart = computed(() => {
  return usePage().props.cart;
});

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

const isCartProduct = computed(() => {
  return Object.keys(cart.value.content).find((element) => {
    return cart.value.content[element].id === props.product.id;
  });
});
</script>
<template>
  <Modal max-width="5xl" :show="modalToggle" @close="$emit('close')">
    <section class="text-gray-600 body-font overflow-hidden">
      <div class="container px-5 py-24 mx-auto">
        <div class="lg:w-4/5 mx-auto flex flex-wrap">
          <img
            alt="ecommerce"
            class="lg:w-1/2 w-full lg:h-auto h-64 object-cover object-center rounded"
            :src="product.image"
          />
          <div class="lg:w-1/2 w-full lg:pl-10 lg:py-6 mt-6 lg:mt-0">
            <h2 class="text-sm title-font text-gray-500 tracking-widest">
              {{ product.category.name }}
            </h2>
            <h1 class="text-gray-900 text-3xl title-font font-medium mb-1">
              {{ product.name }}
            </h1>
            <div v-html="product.body" class="uncss"></div>
            <div
              class="flex mt-6 items-center pb-5 border-b-2 border-gray-100 mb-5"
            ></div>
            <div v-if="!isCartProduct" class="flex">
              <span class="title-font font-medium text-2xl text-gray-900"
                >{{ product.formatted_price }}
              </span>
              <button
                @click.prevent="addToCart(product.id)"
                :disabled="form.processing"
                class="btn-action ml-auto"
              >
                Add to Cart
              </button>
            </div>
            <div v-else class="flex justify-between">
              <span class="title-font font-medium text-2xl text-gray-900">{{
                product.formatted_price
              }}</span>
              <div class="flex justify-center w-1/5 items-center">
                <div class="cursor-pointer" @click="removeFromCart(product.id)">
                  <svg
                    class="fill-current text-gray-600 w-3"
                    viewBox="0 0 448 512"
                  >
                    <path
                      d="M416 208H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h384c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z"
                    />
                  </svg>
                </div>
                <span class="mx-2 border text-center w-8">{{
                  cart.content[isCartProduct].quantity
                }}</span>
                <div class="cursor-pointer" @click="addToCart(product.id)">
                  <svg
                    class="fill-current text-gray-600 w-3"
                    viewBox="0 0 448 512"
                  >
                    <path
                      d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z"
                    />
                  </svg>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div
        @click="$emit('close')"
        class="text-red-400 cursor-pointer hover:text-red-500 text-3xl absolute top-2 right-2"
      >
        <CloseCircle />
      </div>
    </section>
  </Modal>
</template>
<style scoped>
.btn-action {
  background-color: #e52929;
  z-index: 1;
  height: 45px;
  line-height: 1;
  color: #ffffff;
  font-size: 14px;
  font-weight: 700;
  padding: 10px 20px;
  position: relative;
  align-items: center;
  display: inline-flex;
  letter-spacing: 0.5px;
  justify-content: center;
  font-size: 1.3rem;
}

.btn-action:before {
  background: #2e2e2e;
}

.btn-action:hover:before {
  left: 0px;
  width: 100%;
  right: auto;
}

.btn-action:hover {
  color: #ffffff;
}

.btn-action:before {
  top: 0px;
  width: 0px;
  left: auto;
  right: 0px;
  z-index: -1;
  bottom: 0px;
  content: "";
  position: absolute;
  transition: all 0.3s ease-in-out;
}
</style>

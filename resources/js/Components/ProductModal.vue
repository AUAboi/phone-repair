<script setup>
import Modal from "@/Components/Modal.vue";
import CloseCircle from "~icons/mdi/close-circle";
import ActionButton from "./ActionButton.vue";
import { useForm } from "@inertiajs/vue3";

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

const addToCart = (id) => {
  form.id = id;
  form.post(route("cart.add"), {
    preserveScroll: true,
    preserveState: true,
  });
};
</script>
<template>
  <Modal max-width="7xl" :show="modalToggle" @close="$emit('close')">
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
            <div class="flex mb-4">
              <span class="flex items-center">
                <svg
                  fill="currentColor"
                  stroke="currentColor"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  class="w-4 h-4 text-red-500"
                  viewBox="0 0 24 24"
                >
                  <path
                    d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"
                  ></path>
                </svg>
                <svg
                  fill="currentColor"
                  stroke="currentColor"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  class="w-4 h-4 text-red-500"
                  viewBox="0 0 24 24"
                >
                  <path
                    d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"
                  ></path>
                </svg>
                <svg
                  fill="currentColor"
                  stroke="currentColor"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  class="w-4 h-4 text-red-500"
                  viewBox="0 0 24 24"
                >
                  <path
                    d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"
                  ></path>
                </svg>
                <svg
                  fill="currentColor"
                  stroke="currentColor"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  class="w-4 h-4 text-red-500"
                  viewBox="0 0 24 24"
                >
                  <path
                    d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"
                  ></path>
                </svg>
                <svg
                  :fill="Math.random() * 100 > 50 ? 'currentColor' : 'none'"
                  stroke="currentColor"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  class="w-4 h-4 text-red-500"
                  viewBox="0 0 24 24"
                >
                  <path
                    d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"
                  ></path>
                </svg>
                <span class="text-gray-600 ml-3"
                  >{{ Math.ceil(Math.random() * 100) }} Reviews</span
                >
              </span>
            </div>
            <div v-html="product.body" class="leading-relaxed"></div>
            <div
              class="flex mt-6 items-center pb-5 border-b-2 border-gray-100 mb-5"
            ></div>
            <div class="flex">
              <span class="title-font font-medium text-2xl text-gray-900">{{
                product.formatted_price
              }}</span>
              <button
                @click.prevent="addToCart(product.id)"
                :disabled="form.processing"
                class="btn-action ml-auto"
              >
                Add to Cart
              </button>
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

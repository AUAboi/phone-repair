<script setup>
import { onMounted, ref } from "vue";

const props = defineProps({
  type: {
    type: String,
    default: "text"
  },
  error: String,
  label: String,
  modelValue: {
    type: [String, Number],
    default: ""
  }
})

defineEmits(["update:modelValue"]);

const input = ref(null);

onMounted(() => {
  if (input.value.hasAttribute("autofocus")) {
    input.value.focus();
  }
});
</script>
<template>
  <div class="pr-6 pb-8 w-full" :class="$attrs.class">
    <label v-if="label" class="form-label ">{{ label }}:</label>
    <input v-bind="{ ...$attrs, class: null }"
      class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-pink-500 focus:bg-white focus:ring-2 focus:ring-pink-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
      :class="{ 'focus:ring focus:ring-red-200 border-red-500': error }" :type="type" :value="modelValue"
      @input="$emit('update:modelValue', $event.target.value)" ref="input" />
    <div v-if="error" class="form-error">{{ error }}</div>
  </div>
</template>


<style  scoped>
/* Chrome, Safari, Edge, Opera */
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
input[type="number"] {
  -moz-appearance: textfield;
}


.form-input.error {
  @apply border-red-500;
}

.form-error {
  @apply text-red-700 mt-2 text-sm;
}
</style>
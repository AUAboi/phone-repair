<script setup>
import { ref, onMounted } from "vue";
import { Loader } from "@googlemaps/js-api-loader";

const address = ref("");
const placeAutocompleteRef = ref(null);

const props = defineProps([]);

const loader = new Loader({
  apiKey: "AIzaSyBsrH5zLtvBNimarHhgttJqvAiG8XhARaI",
  libraries: ["places"],
  version: "beta",
  params: { v: "alpha" }, // Specify alpha channel
});

onMounted(async () => {
  await loader.importLibrary("places");

  //@ts-ignore
  const placeAutocomplete = new google.maps.places.PlaceAutocompleteElement({
    componentRestrictions: { country: ["uk"] },
  });

  // Append the element inside the input wrapper
  placeAutocompleteRef.value.appendChild(placeAutocomplete);

  // Listen for place selection
  //@ts-ignore
  placeAutocomplete.addEventListener("gmp-placeselect", async ({ place }) => {
    await place.fetchFields({
      fields: ["displayName", "formattedAddress"],
    });

    // Update the selected address
    address.value = place.formattedAddress;

    emit("update:modelValue", address.value);
  });
});

const emit = defineEmits(["update:modelValue"]);
</script>

<template>
  <p>Find</p>
  <div ref="placeAutocompleteRef" class="relative"></div>
</template>
<style>
.widget-container {
  font-size: 16px;
  padding: 12px;
  border-radius: 8px;
  border: 2px solid #4caf50; /* Green border */
  background-color: #f9f9f9;
  color: #333;
}
</style>

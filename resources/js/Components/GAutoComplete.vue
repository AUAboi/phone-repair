<script setup>
import { ref, onMounted } from "vue";
import { Loader } from "@googlemaps/js-api-loader";

const address = ref(""); // Store selected address
const placeAutocompleteRef = ref(null);

const loader = new Loader({
  apiKey: "AIzaSyBsrH5zLtvBNimarHhgttJqvAiG8XhARaI", // Replace with your API Key
  libraries: ["places"],
  version: "beta",
  params: { v: "alpha" }, // Specify alpha channel
});

onMounted(async () => {
  await loader.importLibrary("places"); // Ensure Google Maps API is loaded

  // Create the Google Places Autocomplete Element
  //@ts-ignore
  const placeAutocomplete = new google.maps.places.PlaceAutocompleteElement();

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
  });
});
</script>

<template>
  <div class="mt-5">
    <label
      class="text-base md:text-lg text-title dark:text-white leading-none mb-2 sm:mb-3 block"
    >
      Address
    </label>

    <!-- Wrapper where we will append the Google Places Autocomplete -->
    <div ref="placeAutocompleteRef" class="relative"></div>
  </div>
</template>

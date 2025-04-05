<script setup>
import { ref, onMounted } from "vue";
import { Loader } from "@googlemaps/js-api-loader";
import { storeToRefs } from "pinia";
import { useCheckoutStore } from "@/store/checkoutStore";

const address = ref({
  formattedAddress: "",
  city: "",
  postcode: "",
});

const placeAutocompleteRef = ref(null);

const loader = new Loader({
  apiKey: "AIzaSyBsrH5zLtvBNimarHhgttJqvAiG8XhARaI",
  libraries: ["places"],
  version: "beta",
  params: { v: "alpha" },
});

const checkoutStore = useCheckoutStore();

const { form } = storeToRefs(checkoutStore);

onMounted(async () => {
  await loader.importLibrary("places");

  const placeAutocomplete = new google.maps.places.PlaceAutocompleteElement({
    includedRegionCodes: ["GB"],
  });

  placeAutocompleteRef.value.appendChild(placeAutocomplete);

  placeAutocomplete.addEventListener("gmp-select", async (event) => {
    const place = await event.placePrediction.toPlace();

    await place.fetchFields({
      fields: ["displayName", "formattedAddress", "addressComponents"],
    });

    const city = place.addressComponents.find((component) =>
      component.types.includes("postal_town")
    )?.longText;

    const postcode = place.addressComponents.find((component) =>
      component.types.includes("postal_code")
    )?.longText;

    address.value = {
      formattedAddress: place.formattedAddress,
      city: city || "",
      postcode: postcode || "",
    };

    form.value.address = address.value.formattedAddress;
    form.value.city = address.value.city;
    form.value.zip_code = address.value.postcode;
  });
});
</script>

<template>
  <p>Find:</p>
  <div ref="placeAutocompleteRef" class="relative"></div>
</template>

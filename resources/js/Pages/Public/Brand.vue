<script setup>
import ActionButton from "@/Components/ActionButton.vue";
import LayoutOne from "@/Components/template/layout-one.vue";
import { Head, Link } from "@inertiajs/vue3";

const props = defineProps({
  brand: {
    required: true,
    type: Object,
  },
});
</script>

<template>
  <Head :title="`${brand.name} Repairs`" />
  <section class="bg-blue-50 pb-9 pt-36">
    <div
      class="flex flex-col-reverse sm:grid sm:grid-cols-2 items-center px-4 max-w-4xl mx-auto"
    >
      <div>
        <h3
          class="text-red-600 font-semibold text-4xl sm:text-5xl text-center sm:text-left"
        >
          {{ brand.name }} Repairs
        </h3>
      </div>
      <div class="mx-auto">
        <img :src="brand.image" :alt="brand.name" />
      </div>
    </div>
  </section>

  <section v-if="brand.devices.length" class="px-2 py-4 container mx-auto">
    <h4
      class="text-red-600 font-semibold text-4xl sm:text-6xl text-center my-8"
    >
      Choose your device
    </h4>
    <div
      :classList="'max-w-[1720px] mx-auto grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5 sm:gap-8 pt-8 md:pt-[50px]'"
    >
      <div v-for="(item, index) in brand.devices" :key="index" class="group">
        <div class="relative">
          <Link
            :href="route('public.appointments.create', { device: item.slug })"
          >
            <img
              class="w-full transform group-hover:scale-110 duration-300"
              :src="item.image"
              alt="shop"
            />
          </Link>
        </div>
        <div
          class="md:px-2 lg:px-4 xl:px-6 lg:pt-6 pt-5 flex gap-4 md:gap-5 flex-col"
        >
          <div>
            <h5 class="font-normal dark:text-white text-xl leading-[1.5]">
              <Link
                :href="
                  route('public.appointments.create', { device: item.slug })
                "
                class="text-underline"
              >
                {{ item.name }}
              </Link>
            </h5>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section v-else>
    <h4 class="text-red-600 font-semibold text-lg sm:text-xl text-center my-8">
      No device available
    </h4>
  </section>
</template>

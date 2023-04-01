<script setup>
import { Head, Link } from "@inertiajs/vue3";
import ProductsSection from "./partials/ProductsSection.vue";

const props = defineProps(["categories"]);
</script>

<template>
  <Head title="Products" />
  <section>
    <Link :href="route('public.repairs')" class="banner block"> </Link>
  </section>

  <ProductsSection :categories="categories" />
</template>

<style scoped>
.banner {
  background-image: url("/images/cover-web-02.jpg");
  background-size: cover;
  background-repeat: no-repeat;
  padding: 16rem 2rem;
}

@media screen and (max-width: 1380px) {
  .banner {
    padding: 10rem 2rem;
  }
}

@media screen and (max-width: 860px) {
  .banner {
    background-image: url("/images/cover-web-02.jpg");
    height: 400px;
    background-position: 50% 50%;
    padding: 0;
    background-size: cover;
  }
}
</style>

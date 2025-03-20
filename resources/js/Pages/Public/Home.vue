<script setup>
import ActionButton from "@/Components/ActionButton.vue";
import { Head, Link } from "@inertiajs/vue3";
import BannerSlideshow from "./partials/BannerSlideshow.vue";
import ProductsSection from "./partials/ProductsSection.vue";
import PostSection from "@/Components/PostSection.vue";
import ProductCategorySection from "./partials/ProductCategorySection.vue";
import DeviceSection from "./partials/DeviceSection.vue";
import ChooseUsSection from "./partials/ChooseUsSection.vue";
import PartnersSections from "./partials/PartnersSections.vue";

const props = defineProps(["brands", "categories", "posts", "products"]);
</script>

<template>
  <Head title="Welcome" />
  <BannerSlideshow />
  <ProductCategorySection :categories="categories" />
  <DeviceSection :brands="brands" />
  <div class="text-center mb-7 md:mb-12">
    <Link
      :href="route('public.repairs')"
      class="btn btn-outline"
      data-text="All Brands"
    >
      <span>All Brands</span>
    </Link>
  </div>
  <ChooseUsSection />
  <ProductsSection :products="products" />
  <div v-if="posts.length">
    <h4 class="text-6xl text-center font-bold">Check out our blogs</h4>
    <Link
      as="p"
      :href="route('post.search')"
      class="text-center mx-auto underline cursor-pointer text-blue-400 text-xl"
      >Check out all</Link
    >
    <PostSection :posts="posts" />
  </div>
  <PartnersSections />
</template>

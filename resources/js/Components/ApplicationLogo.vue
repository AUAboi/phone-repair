<script setup>
import { useLogoStore } from "@/store/logoStore";

const logoStore = useLogoStore();
</script>
<template>
  <img :src="`/images/${logoStore.logo}`" alt="" />
</template>

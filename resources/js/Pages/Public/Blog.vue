<script setup>
import SearchBlog from "@/Components/SearchBlog.vue";
import { Head, Link, usePage } from "@inertiajs/vue3";
import CalenderIcon from "~icons/mdi/calendar-month";

const props = defineProps(["post", "related_posts"]);

const is_admin = usePage().props?.auth?.user?.is_admin;
</script>
<template>
  <Head :title="post.title" />
  <section class="py-24">
    <div class="mt-32 relative container mx-auto px-4">
      <div
        class="text-lg py-4 px-2 bg-gray-300 rounded my-4 mx-4"
        v-if="is_admin"
      >
        Post status is: {{ post.status }}.
        <Link
          class="font-bold underline text-blue-500"
          :href="route('posts.edit', post.slug)"
          >Edit</Link
        >
      </div>
      <div class="flex flex-col md:flex-row gap-5">
        <div class="max-w-5xl w-full mx-auto">
          <div>
            <img class="object-cover w-full" :src="post.image" alt="" />
          </div>
          <div>
            <h2 class="text-3xl sm:text-5xl md:text-7xl mt-6">
              {{ post.title }}
            </h2>
            <div class="border-b-2 pb-6 pr-4 mb-5 w-fit border-b-red-300">
              <p class="mt-3">
                <span class="font-bold"> Author: </span>
                {{ post.author }}
              </p>
              <p>
                <span class="font-bold"> Published: </span>
                {{ post.formatted_date }}
              </p>
            </div>
          </div>
          <div class="uncss">
            <div v-html="post.body"></div>
          </div>
        </div>
        <div class="max-w-xs space-y-20">
          <SearchBlog />
          <div class="space-y-10">
            <Link
              v-for="p in related_posts"
              as="div"
              :href="route('post.show', p.slug)"
              class="cursor-pointer border pb-4"
            >
              <img :src="p.image" alt="" />
              <h5 class="text-lg px-4">{{ p.title }}</h5>
              <p class="flex items-center px-4 mt-2">
                <CalenderIcon /> {{ p.created_at }}
              </p>
            </Link>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

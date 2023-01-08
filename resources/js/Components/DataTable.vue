<script setup>
import { Link } from "@inertiajs/inertia-vue3";
import IconChevronRight from "~icons/mdi/chevron-right"

const props = defineProps({
  resourceRoute: {
    type: String,
    required: false,
  },
  labels: {
    type: Array,
    required: true,
  },
  tableData: {
    type: Array,
    required: true,
  },
});
</script>

<template>
  <div>
    <table class="w-full whitespace-nowrap">
      <tr class="text-left font-bold">
        <th v-for="(label, index) in labels" :key="index" class="px-6 pt-6 pb-4">
          {{ label.value }}
        </th>
      </tr>
      <tr v-for="(data, index) in tableData" :key="index"
        class="hover:bg-gray-100 dark:hover:bg-gray-900 focus-within::bg-gray-100 dark:focus-within:bg-gray-900 capitalize">
        <td v-for="(label, index) in labels" :key="index" class="border-t dark:border-gray-600">
          <Link v-if="resourceRoute" class="px-6 py-4 flex items-center "
            :href="route(resourceRoute, data.slug ? data.slug : data.id)">
          {{ data[label.key] }}
          </Link>

          <span v-else`` class="px-6 py-4 flex items-center ">
            {{ data[label.key] }}
          </span>
        </td>
        <td class="border-t dark:border-gray-600 w-px">
          <Link v-if="resourceRoute" class="px-4 flex items-center"
            :href="route(resourceRoute, data.slug ? data.slug : data.id)" tabindex="-1">
          <IconChevronRight class="text-gray-600 text-3xl" />
          </Link>
        </td>
      </tr>
      <tr v-if="tableData.length === 0">
        <td class="border-t px-6 py-4" :colspan="labels.length">No entry found.</td>
      </tr>
    </table>
  </div>
</template>


<script setup>
import PageHeader from '@/Components/PageHeader.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';
</script>

<template>

    <Head title="Dashboard" />


    <PageHeader>
        Dashboard
    </PageHeader>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mx-2 md:mx-0">
                <div class="p-6 text-gray-900 dark:text-gray-100">You're logged in!</div>
            </div>
        </div>
    </div>
</template>

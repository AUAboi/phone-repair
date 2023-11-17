<script setup>
import { Link, useForm } from "@inertiajs/vue3";
import { computed } from "@vue/reactivity";
const props = defineProps({
    cartProduct: Object,
});

const form = useForm({
    id: null,
});

const addToCart = (id) => {
    form.id = id;
    form.post(route("cart.add"), {
        preserveScroll: true,
        preserveState: true,
    });
};

const removeFromCart = (id) => {
    form.id = id;
    form.post(route("cart.remove"), {
        preserveScroll: true,
        preserveState: true,
    });
};

const removeItem = (id) => {
    form.id = id;
    form.post(route("cart.removeitem"), {
        preserveScroll: true,
        preserveState: true,
    });
};
</script>

<template>
    <div class="flex items-center hover:bg-gray-100 py-5">
        <div class="flex sm:w-2/5">
            <div class="flex flex-col justify-between flex-grow">
                <span class="font-bold text-sm">{{ cartProduct.name }}</span>

                <span
                    @click="removeItem(cartProduct.id)"
                    class="font-semibold hover:text-red-500 text-gray-500 text-xs cursor-pointer"
                    >Remove</span
                >
            </div>
        </div>
        <div class="flex justify-center w-1/5 items-center">
            <div class="cursor-pointer" @click="removeFromCart(cartProduct.id)">
                <svg
                    class="fill-current text-gray-600 w-3"
                    viewBox="0 0 448 512"
                >
                    <path
                        d="M416 208H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h384c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z"
                    />
                </svg>
            </div>

            <span class="mx-2 border text-center w-8">{{
                cartProduct.quantity
            }}</span>
            <div class="cursor-pointer" @click="addToCart(cartProduct.id)">
                <svg
                    class="fill-current text-gray-600 w-3"
                    viewBox="0 0 448 512"
                >
                    <path
                        d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z"
                    />
                </svg>
            </div>
        </div>
        <span class="text-center w-1/5 font-semibold text-sm">{{
            cartProduct.price
        }}</span>
        <span class="text-center w-1/5 font-semibold text-sm">{{
            cartProduct.total_price
        }}</span>
    </div>
</template>

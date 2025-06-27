<script setup>
import { router } from "@inertiajs/vue3";
const props = defineProps({
    users: Object,
});
const getDate = (date) =>
    new Date(date).toLocaleDateString("en-us", {
        month: "short",
        day: "numeric",
        year: "numeric",
    });

    
</script>

<template>
    <div class="mx-auto max-w-xl px-5">
        <div>
            <div>
                <h1 class="text-2xl text-center font-semibold py-3">
                    Admin Dashboard
                </h1>
            </div>
            <div class="border border-gray-500 py-3 mx-4 px-2">
                <h1 class="text-xl font-semibold py-3">Current Tenants</h1>
                <h1 v-for="user in users" :key="user.id">{{ user.name }}</h1>
            </div>
        </div>
    </div>
</template>

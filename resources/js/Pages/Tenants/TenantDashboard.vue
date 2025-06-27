<script setup>
const props = defineProps({
    bills: Object,
});
const getDate = (date) =>
    new Date(date).toLocaleDateString("en-us", {
        month: "short",
        day: "numeric",
        year: "numeric",
    });
</script>

<template>
    <div>
        <div>
            <div>
                <h1 class="text-2xl text-center font-semibold py-3">
                    Tenant Dashboard
                </h1>
            </div>
            <div class="border border-gray-500 py-3 mx-4 px-2">
                <h1 class="text-xl font-semibold py-3">Current Bill</h1>
                <h1 v-for="bill in bills" :key="bill.id">
                    ₱{{ bill.totalBill }}
                </h1>
            </div>
        </div>
    </div>
</template>

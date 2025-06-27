<script setup>
import { router } from "@inertiajs/vue3";
const props = defineProps({
    house: Object,
    tenant: Object,
});

const deleteButton = (house, tenant) => {
    if (confirm("Are You Sure?")) {
        router.delete(
            route("houses.tenants.destroy", { house: house, tenant: tenant })
        );
    }
};
</script>

<template>
    <div>
        <Link
            :href="route('houses.show', { house: props.house })"
            class="primary-btn absolute mt-2 ms-2"
        >
            Back
        </Link>
        <div class="py-12 px-5">
                <h1 class="text-2xl text-center font-semibold py-3">
                    Tenant Information
                </h1>
                <div>
                    <h2><strong>Full Name:</strong> {{ tenant.fullName }}</h2>
                    <h2><strong>Members:</strong> {{ tenant.members }}</h2>
                    <h2>
                        <strong>Contact Number:</strong>
                        {{ tenant.contactNumber }}
                    </h2>
                </div>
            </div>
            <!-- <div>
            <div>
                <h1 class="text-2xl text-center font-semibold py-3">
                    Manage Tenants
                </h1>
                <h1
                    class="bg-red-500 ms-1 p-1 max-w-24 rounded-lg"
                    v-if="props.tenants.length === house.roomCount"
                >
                    Tenants Full
                </h1>
                <Link
                    v-else
                    :href="
                        route('houses.tenants.create', { house: props.house })
                    "
                    class="primary-btn mx-2"
                >
                    Add New Tenants
                </Link>
            </div>
            <div
                v-if="props.tenants.length !== 0"
                class="mt-3 bg-slate-400 p-2 flex justify-between items-center flex-wrap gap-x-1 gap-y-2"
            >
                <div
                    v-for="tenant in props.tenants"
                    :key="tenant.id"
                    class="py-3 px-2 bg-slate-200 rounded-lg max-w-44"
                >
                    <div><Icons class="w-10" name="tenants" /></div>
                    <div>
                        <h2><strong>Name:</strong> {{ tenant.fullName }}</h2>
                        <h2><strong>Members:</strong> {{ tenant.members }}</h2>
                        <h2>
                            <strong>Contact:</strong> {{ tenant.contactNumber }}
                        </h2>
                    </div>
                    <div
                        class="flex items-center justify-between mt-1 bg-slate-500 rounded-lg p-1"
                    >
                        <Link
                            :href="
                                route('houses.tenants.show', {
                                    house: house,
                                    tenant: tenant,
                                })
                            "
                            class="bg-blue-500 px-3 py-2 rounded-lg"
                        >
                            <i class="fa-solid fa-eye"></i>
                        </Link>
                        <Link
                            :href="
                                route('houses.tenants.edit', {
                                    house: house.id,
                                    tenant: tenant.id,
                                })
                            "
                            class="bg-green-500 px-3 py-2 rounded-lg"
                        >
                            <i class="fa-solid fa-pen"></i>
                        </Link>
                        <button
                            @click="deleteButton(props.house, tenant.id)"
                            class="bg-red-500 px-3 py-2 rounded-lg"
                        >
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div v-else>
                <h1 class="text-center text-2xl font-bold py-10">
                    No Tenant Information
                </h1>
            </div>
        </div> -->
        </div>
</template>

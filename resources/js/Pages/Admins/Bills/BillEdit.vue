<script setup>
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
    tenant: Object,
    house: Object,
});
const form = useForm({
    fullName: props.tenant.fullName,
    members: props.tenant.members,
    contactNumber: props.tenant.contactNumber,
});
const submit = () => {
    form.put(
        route("houses.tenants.update", {
            tenant: props.tenant,
            house: props.house,
        })
    );
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
            <h1 class="text-center font-bold text-2xl">Update Tenant</h1>
            <form @submit.prevent="submit">
                <div class="mt-10 px-10">
                    <div class="max-w-md">
                        <label
                            for="first-name"
                            class="block text-lg font-semibold text-gray-900"
                            >Full Name</label
                        >
                        <div class="mt-1 mb-2">
                            <input
                                v-model="form.fullName"
                                type="text"
                                class="block w-full rounded-md bg-white px-3 border border-black py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                            />
                            <small
                                v-if="form.errors.fullName"
                                class="text-red-500"
                                >{{ form.errors.fullName }}</small
                            >
                        </div>
                    </div>
                    <div class="max-w-md">
                        <label
                            for="first-name"
                            class="block text-lg font-semibold text-gray-900"
                            >How many Tenant Members?</label
                        >
                        <div class="mt-1 mb-2">
                            <input
                                v-model="form.members"
                                type="number"
                                class="block w-full rounded-md bg-white px-3 border border-black py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                            />
                            <small
                                v-if="form.errors.members"
                                class="text-red-500"
                                >{{ form.errors.members }}</small
                            >
                        </div>
                    </div>
                    <div class="max-w-md">
                        <label
                            for="first-name"
                            class="block text-lg font-semibold text-gray-900"
                            >Contact Number</label
                        >
                        <div class="mt-1 mb-2">
                            <input
                                v-model="form.contactNumber"
                                type="tel"
                                class="block w-full rounded-md bg-white px-3 border border-black py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                            />
                            <small
                                v-if="form.errors.contactNumber"
                                class="text-red-500"
                                >{{ form.errors.contactNumber }}</small
                            >
                        </div>
                        <button
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 my-4 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                        >
                            Update Tenant
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

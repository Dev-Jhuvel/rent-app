<script setup>
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
    house: Object,
});

const form = useForm({
    name: props.house.name,
    description: props.house.description,
    isAvailable: props.house.isAvailable,
    roomCount: props.house.roomCount,
    houseRent: props.house.houseRent,
    waterRate: props.house.waterRate,
    electricRate: props.house.electricRate,
});
const submit = () => {
    form.put(route("houses.update", { id: props.house.id }));
};
</script>

<template>
    <div class="py-5 px-5 mx-auto max-w-lg">
        <h1 class="text-center font-bold text-2xl">Update {{ house.name }}</h1>
        <form @submit.prevent="submit">
            <div class="mt-3 px-10">
                <div class="max-w-md">
                    <label class="block text-lg font-semibold text-gray-900"
                        >House Name</label
                    >
                    <div class="mb-1">
                        <input
                            v-model="form.name"
                            type="text"
                            class="block w-full rounded-md bg-white px-3 border border-black py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                        />
                        <small v-if="form.errors.name" class="text-red-500">{{
                            form.errors.name
                        }}</small>
                    </div>
                </div>
                <div class="max-w-md">
                    <label
                        for="first-name"
                        class="block text-lg font-semibold text-gray-900"
                        >Description</label
                    >
                    <div class="mb-1">
                        <textarea
                            v-model="form.description"
                            rows="2"
                            class="block w-full rounded-md bg-white px-3 border border-black py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                        ></textarea>
                        <small
                            v-if="form.errors.description"
                            class="text-red-500"
                            >{{ form.errors.description }}</small
                        >
                    </div>
                </div>
                <div class="max-w-md">
                    <label
                        for="first-name"
                        class="block text-lg font-semibold text-gray-900"
                        >Status</label
                    >
                    <div class="mb-1">
                        <select
                            v-model="form.isAvailable"
                            type="tel"
                            class="block w-full rounded-md bg-white px-3 border border-black py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                        >
                            <option value="1">Available</option>
                            <option value="0">Not Available</option>
                        </select>
                        <small
                            v-if="form.errors.isAvailable"
                            class="text-red-500"
                            >{{ form.errors.isAvailable }}</small
                        >
                    </div>
                </div>
                <div class="max-w-md">
                    <label class="block text-lg font-semibold text-gray-900"
                        >Number of Rooms</label
                    >
                    <div class="mb-1">
                        <input
                            v-model="form.roomCount"
                            type="number"
                            class="block w-full rounded-md bg-white px-3 border border-black py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                        />
                        <small
                            v-if="form.errors.roomCount"
                            class="text-red-500"
                            >{{ form.errors.roomCount }}</small
                        >
                    </div>
                </div>
                <div class="max-w-md">
                    <label class="block text-lg font-semibold text-gray-900"
                        >House Rent</label
                    >
                    <div class="mb-1">
                        <input
                            v-model="form.houseRent"
                            type="text"
                            class="block w-full rounded-md bg-white px-3 border border-black py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                        />
                        <small
                            v-if="form.errors.houseRent"
                            class="text-red-500"
                            >{{ form.errors.houseRent }}</small
                        >
                    </div>
                </div>
                <div class="max-w-md">
                    <label class="block text-lg font-semibold text-gray-900"
                        >Water Rate per Head</label
                    >
                    <div class="mb-1">
                        <input
                            v-model="form.waterRate"
                            type="text"
                            class="block w-full rounded-md bg-white px-3 border border-black py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                        />
                        <small
                            v-if="form.errors.waterRate"
                            class="text-red-500"
                            >{{ form.errors.waterRate }}</small
                        >
                    </div>
                </div>
                <div class="max-w-md">
                    <label class="block text-lg font-semibold text-gray-900"
                        >Electric Rate</label
                    >
                    <div class="mb-1">
                        <input
                            v-model="form.electricRate"
                            type="text"
                            class="block w-full rounded-md bg-white px-3 border border-black py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                        />
                        <small
                            v-if="form.errors.electricRate"
                            class="text-red-500"
                            >{{ form.errors.electricRate }}</small
                        >
                    </div>
                </div>
                <button
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 my-4 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                >
                    Update House
                </button>
            </div>
        </form>
    </div>
</template>

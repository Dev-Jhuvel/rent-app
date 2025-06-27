<script setup>
import { router } from "@inertiajs/vue3";
defineProps({
    houses: Object,
});

const deleteButton = (id) => {
    if (confirm("Are You Sure?")) {
        router.delete(route("houses.destroy", { id: id }));
    }
};
// TODO:
</script>

<template>
    <div class="mx-auto max-w-md md:max-w-2xl">
        <div>
            <h1 class="text-3xl text-center font-semibold py-3 mb-5">
                Manage Houses
            </h1>
            <Link
                :href="route('houses.create')"
                class="primary-btn text-lg mx-2 gap-3"
            >
                <i class="fa-solid fa-add"></i> Create
            </Link>
        </div>
        <div
            v-if="houses.length !== 0"
            class="md:hidden overflow-y-auto mt- p-2 flex items-start flex-wrap gap-x-1 gap-y-2"
        >
            <Link
                :href="route('houses.show', { id: house.id })"
                v-for="house in houses"
                :key="house.id"
                class="py-3 px-2 w-full border border-t-2 rounded-lg max-w-44 shadow-2xl"
            >
                <div class="flex justify-between">
                    <Icons class="w-[4rem]" name="house" />
                    <div
                        class="flex items-center justify-between mt-1 rounded-lg p-1"
                    >
                        <Link
                            :href="route('houses.edit', { id: house.id })"
                            class="p-2 text-green-500 hover:text-green-300"
                        >
                            <i class="fa-solid fa-pen"></i>
                        </Link>
                        <button
                            @click.prevent="deleteButton(house.id)"
                            class="p-2 text-red-500 hover:text-red-300"
                        >
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </div>
                </div>
                <div class="px-2">
                    <h2 class="font-bold text-lg">{{ house.name }}</h2>
                    <h2>
                        {{
                            house.roomCount === 1
                                ? `${house.roomCount} Room only`
                                : `${house.roomCount} Rooms`
                        }}
                    </h2>
                    <h2 v-if="house.users_count">
                        {{
                            house.users_count === 1
                                ? `${house.users_count} Tenant`
                                : `${house.users_count} Tenants`
                        }}
                    </h2>
                    <h2 v-else>No Tenant</h2>
                    <h2>
                        {{ house.isAvailable ? "Available" : "Not Available" }}
                    </h2>
                </div>
            </Link>
        </div>
        <div v-if="houses.length !== 0" class="hidden md:inline">
            <div class="mt-5 relative overflow-x-auto shadow-md sm:rounded-lg">
                <table
                    class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400"
                >
                    <thead
                        class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
                    >
                        <tr>
                            <th scope="col" class="px-6 py-3">House Name</th>
                            <th scope="col" class="px-6 py-3">Status</th>
                            <th scope="col" class="px-6 py-3">Rooms</th>
                            <th scope="col" class="px-6 py-3">Tenant</th>
                            <th scope="col" class="px-6 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="house in houses"
                            :key="house.id"
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600"
                        >
                            <td class="px-6 py-4">{{ house.name }}</td>
                            <td class="px-6 py-4">
                                {{
                                    house.isAvailable
                                        ? "Available"
                                        : "Not Available"
                                }}
                            </td>
                            <td class="px-6 py-4">{{ house.roomCount }}</td>
                            <td class="px-6 py-4">{{ house.users_count }}</td>
                            <td class="px-6 py-4">
                                <Link
                                    :href="
                                        route('houses.show', { id: house.id })
                                    "
                                    class="p-2 text-blue-500 hover:text-green-300"
                                >
                                    <i class="fa-solid fa-eye"></i> </Link
                                ><Link
                                    :href="
                                        route('houses.edit', { id: house.id })
                                    "
                                    class="p-2 text-green-500 hover:text-green-300"
                                >
                                    <i class="fa-solid fa-pen"></i>
                                </Link>
                                <button
                                    @click.prevent="deleteButton(house.id)"
                                    class="p-2 text-red-500 hover:text-red-300"
                                >
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div v-else>
            <h1 class="text-center text-2xl font-bold py-10">
                No House Information
            </h1>
        </div>
    </div>
</template>

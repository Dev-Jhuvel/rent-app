<script setup>
import { router } from "@inertiajs/vue3";
const props = defineProps({
    house: Object,
    users: Object,
});

const deleteButton = (house, user) => {
    if (confirm("Are You Sure?")) {
        router.delete(
            route("houses.users.destroy", { house: house, user: user })
        );
    }
};
</script>

<template>
    <div class="mx-auto max-w-lg">
        <div
            class="md:max-w-2xl md:py-4 shadow-2xl border-2 max-w-xs mx-auto mt-5 px-4 py-2 rounded-lg"
        >
            <h1 class="text-2xl text-center font-semibold">
                House Information
            </h1>
            <hr />
            <div>
                <h2><strong>Name:</strong> {{ house.name }}</h2>
                <h2><strong>Description:</strong> {{ house.description }}</h2>
                <h2>
                    <strong>Status:</strong>
                    {{ house.isAvailable ? "Available" : "Not Available" }}
                </h2>
                <h2>
                    <strong>Rooms:</strong>
                    {{
                        house.roomCount === 1
                            ? `${house.roomCount} Room only`
                            : `${house.roomCount} Rooms`
                    }}
                </h2>
                <h2><strong>House Rent:</strong> {{ house.houseRent }}</h2>
                <h2>
                    <strong>Water Rate per head:</strong> {{ house.waterRate }}
                </h2>
                <h2>
                    <strong>Electric Rate:</strong> {{ house.electricRate }}
                </h2>
            </div>
        </div>
        <div>
            <div>
                <h1 class="text-2xl text-center font-semibold py-3 mt-4">
                    Manage tenants
                </h1>
                <div>
                    <h1
                        class="bg-red-500 text-center mx-10 py-1 text-white rounded-lg"
                        v-if="props.users.length === house.roomCount"
                    >
                        Tenants Full
                    </h1>
                    <Link
                        v-else
                        :href="
                            route('houses.users.create', { house: props.house })
                        "
                        class="primary-btn mx-2"
                    >
                        Add New Tenants
                    </Link>
                </div>
            </div>
            <div
                v-if="props.users.length !== 0"
                class="mt-3 p-2 flex items-start flex-wrap gap-x-1 gap-y-2"
            >
                <Link
                    :href="
                        route('houses.users.show', {
                            house: house,
                            user: user.id,
                        })
                    "
                    v-for="user in props.users"
                    :key="user.id"
                    class="py-3 px-2 w-full border border-t-2 rounded-lg max-w-44 shadow-2xl"
                >
                    <div class="flex justify-between">
                        <Icons class="w-[4rem]" name="tenants" />
                        <div
                            class="flex items-center justify-between mt-1 rounded-lg p-1"
                        >
                            <Link
                                :href="
                                    route('houses.users.edit', {
                                        house: house.id,
                                        user: user.id,
                                    })
                                "
                                class="p-2 text-green-500 hover:text-green-300"
                            >
                                <i class="fa-solid fa-pen"></i>
                            </Link>
                            <button
                                @click.prevent="
                                    deleteButton(props.house, user.id)
                                "
                                class="p-2 text-red-500 hover:text-red-300"
                            >
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </div>
                    </div>
                    <div>
                        <h2 class="font-bold text-lg">{{ user.name }}</h2>
                        <h2 class="text-lg">
                            {{ user.members }} Family Member
                        </h2>
                    </div>
                </Link>
            </div>

            <div v-else>
                <h1 class="text-center text-2xl font-bold py-10">
                    No Tenant Information
                </h1>
            </div>
        </div>
    </div>
</template>

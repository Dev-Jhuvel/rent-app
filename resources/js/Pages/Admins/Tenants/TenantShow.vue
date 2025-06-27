<script setup>
import { router } from "@inertiajs/vue3";
import { ref } from "vue";
const props = defineProps({
    house: Object,
    user: Object,
    bills: Object,
});
let isPublished = ref(false);
const getDate = (date) =>
    new Date(date).toLocaleDateString("en-us", {
        month: "numeric",
        day: "numeric",
        year: "numeric",
    });

const deleteButton = (house, user, bill) => {
    if (confirm("Are You Sure?")) {
        router.delete(
            route("houses.users.bills.destroy", {
                house: house,
                user: user,
                bill: bill,
            })
        );
    }
};
const publishToggle = (house, user, bill) => {
    isPublished.value = !isPublished.value;
    console.log(isPublished.value);
    if (confirm("Are You Sure?")) {
        router.put(
            route("publish", {
                house: house,
                user: user,
                bill: bill,
                isPublished: isPublished.value,
            })
        );
    }
};
</script>

<template>
    <div>
        <Link
            :href="
                route('houses.show', {
                    house: props.house.id,
                })
            "
            class="primary-btn mt-10 ms-2"
        >
            Back
        </Link>
        <div
            class="shadow-2xl border-2 max-w-xs mx-auto mt-5 px-4 py-2 rounded-lg"
        >
            <h1 class="text-2xl text-center font-semibold py-3">
                Tenant Information
            </h1>
            <div>
                <h2><strong>Full Name:</strong> {{ user.name }}</h2>
                <h2><strong>Email:</strong> {{ user.email }}</h2>
                <h2>
                    <strong>Contact Number:</strong>
                    {{ user.contact }}
                </h2>
                <h2><strong>Members:</strong> {{ user.members }}</h2>
            </div>
        </div>

        <div>
            <div>
                <h1 class="text-2xl text-center font-semibold py-3">
                    Manage Bills
                </h1>
                <Link
                    :href="
                        route('houses.users.bills.create', {
                            house: props.house,
                            user: props.user,
                        })
                    "
                    class="primary-btn mx-2"
                >
                    Add New Bill
                </Link>
            </div>
            <div class="relative shadow-md rounded-lg mt-5 mx-auto max-w-xs md:max-w-2xl">
                <table
                    v-if="props.bills.length !== 0"
                    class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 mx-2"
                >
                    <thead
                        class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
                    >
                        <tr>
                            <th scope="col" class="px-2 py-3">Date</th>
                            <th scope="col" class="px-2 py-3">Status</th>
                            <th scope="col" class="px-2 py-3">Bill</th>
                            <th scope="col" class="px-6 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="bill in bills"
                            :key="bill.id"
                            class="text-black border border-b-2"
                            :class="{
                                'bg-yellow-200': bill.isPublished === true,
                            }"
                        >
                            <td scope="col" class="px-2 py-3">
                                {{ getDate(bill.created_at) }}
                            </td>
                            <td scope="col" class="px-2 py-3">
                                {{ bill.isPublished ? "Published" : " Draft" }}
                            </td>
                            <td scope="col" class="px-2 py-3">
                                ₱{{ bill.totalBill }}
                            </td>
                            <td
                                scope="col"
                                class="px-6 py-3 flex justify-between"
                            >
                                <Link class="text-blue-500">
                                    <i class="fa-solid fa-eye"></i>
                                </Link>
                                <button
                                    class="text-green-500"
                                    @click="
                                        publishToggle(
                                            props.house.id,
                                            props.user.id,
                                            bill.id
                                        )
                                    "
                                >
                                    <i class="fa-solid fa-pen"></i>
                                </button>
                                <button
                                    class="text-red-500"
                                    @click="
                                        deleteButton(
                                            props.house.id,
                                            props.user.id,
                                            bill.id
                                        )
                                    "
                                >
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div v-else>
                    <h1 class="text-center text-2xl font-bold py-10">
                        No Tenant Information
                    </h1>
                </div>
            </div>
        </div>
    </div>
</template>

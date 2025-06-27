<script setup>
import { useForm } from "@inertiajs/vue3";
import { ref, computed } from "vue";

const props = defineProps({
    house: Object,
    user: Object,
});

const meter = ref({
    newMeter: "",
    oldMeter: "",
});

const totalMeter = computed(() => {
    return meter.value.newMeter - meter.value.oldMeter;
});

const computedElectricBill = computed(() => {
    return totalMeter.value * props.house.electricRate;
});
const computedWaterBill = computed(() => {
    return props.house.waterRate * props.user.members;
});

const computedTotalBill = computed(() => {
    return (
        computedElectricBill.value +
        computedWaterBill.value +
        props.house.houseRent
    );
});
const form = useForm({
    billOwner: props.user.name,
    waterBill: computedWaterBill,
    electricBill: computedElectricBill,
    houseRentBill: props.house.houseRent,
    totalBill: computedTotalBill,
});
const submit = () => {
    form.post(
        route("houses.users.bills.store", {
            house: props.house,
            user: props.user,
        })
    );
};
</script>

<template>
    <div>
        <Link
            :href="
                route('houses.users.show', {
                    house: props.house,
                    user: props.user,
                })
            "
            class="primary-btn absolute mt-2 ms-2"
        >
            Back
        </Link>

        <div class="py-12 px-5">
            <h1 class="text-center font-bold text-2xl">Create new Bill</h1>
            <div class="mx-3 flex gap-2 mb-5">
                <div>
                    <input
                        v-model="meter.newMeter"
                        type="number"
                        class="block w-full rounded-md bg-white px-3 border border-black py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                        placeholder="New Meter"
                    />
                </div>
                <div>
                    <input
                        v-model="meter.oldMeter"
                        type="number"
                        class="block w-full rounded-md bg-white px-3 border border-black py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                        placeholder="Old Meter"
                    />
                </div>
            </div>
            <form @submit.prevent="submit">
                <div class="relative overflow-x-auto shadow-md rounded-lg">
                    <table
                        class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400"
                    >
                        <thead
                            class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
                        >
                            <tr>
                                <th scope="col" class="px-6 py-3">House</th>
                                <th scope="col" class="px-6 py-3">Tenant</th>
                                <th scope="col" class="px-6 py-3">Bill</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200"
                            >
                                <th
                                    scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                                >
                                    Rent
                                </th>
                                <td class="px-6 py-4">
                                    ₱{{ props.house.houseRent }}
                                </td>
                                <td class="px-6 py-4">
                                    ₱{{ props.house.houseRent }}
                                </td>
                            </tr>
                            <tr
                                class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200"
                            >
                                <th
                                    scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                                >
                                    Water Bill
                                </th>
                                <td class="px-6 py-4">
                                    {{
                                        props.house.waterRate +
                                        " × " +
                                        props.user.members
                                    }}
                                </td>
                                <td class="px-6 py-4">
                                    ₱<input
                                        v-model="form.waterBill"
                                        disabled
                                        class="w-10 bg-transparent"
                                        type="text"
                                    />
                                </td>
                            </tr>
                            <tr
                                class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200"
                            >
                                <th
                                    scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                                >
                                    Electrical Bill
                                </th>
                                <td class="px-6 py-4">
                                    {{
                                        totalMeter +
                                        " × " +
                                        props.house.electricRate
                                    }}
                                </td>
                                <td class="px-6 py-4 flex">
                                    ₱<input
                                        v-model="form.electricBill"
                                        disabled
                                        class="w-10 bg-transparent"
                                        type="text"
                                    />
                                </td>
                            </tr>
                            <tr
                                class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200"
                            >
                                <th
                                    scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                                ></th>
                                <td class="px-6 py-4">
                                    {{
                                        props.user.name.split(" ")[0] +
                                        "'s Bill"
                                    }}
                                </td>
                                <td class="px-6 py-4">
                                    ₱<input
                                        v-model="form.totalBill"
                                        disabled
                                        class="w-10 bg-transparent"
                                        type="text"
                                    />
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <button
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 my-4 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 disabled:bg-slate-500"
                    :disabled="meter.newMeter === '' && meter.oldMeter === ''"
                >
                    Submit Bill
                </button>
            </form>
        </div>
    </div>
</template>

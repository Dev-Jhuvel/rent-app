<script setup>
import { useForm } from "@inertiajs/vue3";
import Guest from "../../Layouts/Guest.vue";
defineOptions({
    layout: Guest,
});

const form = useForm({
    email: "",
    password: "",
});
const submit = () => {
    form.post(route("login"));
};
</script>

<template>
    <div class="mx-auto px-5 md:max-w-lg">
        <Icons class="max-w-52 mx-auto" name="houses" />
        <h1 class="text-center font-bold text-2xl">Login to your account</h1>
        <form @submit.prevent="submit">
            <div class="mt-10 px-10">
                <div class="max-w-md">
                    <div class="">
                        <input
                            v-model="form.email"
                            type="email"
                            class="text-center block w-full rounded-md px-3 py-1.5 text-base text-gray-900 outline-1 bg-slate-100 -outline-offset-1 outline-gray-300 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-gray-600 sm:text-sm/6"
                            placeholder="Email"
                        />
                        <small v-if="form.errors.email" class="text-red-500">{{
                            form.errors.email
                        }}</small>
                    </div>
                </div>
                <div class="max-w-md">
                    <div class="mt-2">
                        <input
                            v-model="form.password"
                            type="password"
                            class="text-center block w-full rounded-md px-3 py-1.5 text-base text-gray-900 outline-1 bg-slate-100 -outline-offset-1 outline-gray-300 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-gray-600 sm:text-sm/6"
                            placeholder="Password"
                        />
                        <small
                            v-if="form.errors.password"
                            class="text-red-500"
                            >{{ form.errors.password }}</small
                        >
                    </div>
                    <button
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 w-full focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 my-4 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                    >
                        Login
                    </button>
                </div>
            </div>
        </form>
    </div>
</template>

<script setup>
const props = defineProps({
    user: Object,
});
</script>

<template>
    <div>
        <Link
            class=" self-end px-3 py-1 text-lg text-black bg-slate-300 text-center hover:bg-slate-500 rounded-lg"
            :href="route('logout')"
            type="button"
            method="post"
        >
            Logout
        </Link>
        <div>
            <h1 class="text-2xl text-center font-semibold py-3">Profile</h1>
        </div>
        <div>
            <h1 class="text-xl text-center font-semibold py-3">
                {{ user.name }}
            </h1>
            <h1 class="text-xl text-center font-semibold py-3">
                {{ user.email }}
            </h1>
            <h1 class="text-xl text-center font-semibold py-3">
                {{ user.contact }}
            </h1>
        </div>
    </div>
</template>

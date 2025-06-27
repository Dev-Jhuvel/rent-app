<script setup>
import { Link } from "@inertiajs/vue3";
</script>

<template>
    <div class="m-0 p-0">
        <div class="bg-red-500 py-2 px-2">
            <header>
                <div class="flex items-center justify-between">
                    <Link
                        :href="
                            $page.props.auth.user.is_admin
                                ? route('admins.dashboard')
                                : route('tenants.dashboard')
                        "
                        class="flex items-center py-1"
                    >
                        <Icons name="house" class="nav-icons" />
                        <h1 class="text-2xl px-2 font-bold">Rent App</h1>
                    </Link>
                    <div>
                        <Link
                            class="px-3 py-1 text-lg text-white hover:bg-slate-500 rounded-lg"
                            :href="route('logout')"
                            type="button"
                            method="post"
                        >
                            Logout
                        </Link>
                    </div>
                </div>
                <nav
                    class="flex items-center justify-around border border-black"
                >
                    <Link
                        v-if="$page.props.auth.user.is_admin === 1"
                        :href="route('houses.index')"
                        class=""
                        ><Icons name="houses" class="nav-icons"
                    /></Link>

                    <Link
                        :href="
                            route('profile', {
                                user: $page.props.auth.user.id,
                            })
                        "
                        class=""
                        ><Icons name="user" class="nav-icons"
                    /></Link>
                </nav>
            </header>
        </div>
        <main>
            <p
                v-if="$page.props.flash.message"
                class="bg-green-200 p-4 text-center"
            >
                {{ $page.props.flash.message }}
            </p>
            <slot />
        </main>
    </div>
</template>

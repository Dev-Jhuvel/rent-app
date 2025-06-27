<script setup>
import { Link } from "@inertiajs/vue3";
</script>

<template>
    <div>
        <main class="h-screen mt-5">
            <div class="hidden md:inline bg-blue-500 bottom-0 w-full">
                <header>
                    <nav
                        class="text-3xl text-slate-500 flex justify-evenly items-center"
                    >
                        <Link
                            :href="
                                $page.props.auth.user.is_admin
                                    ? route('admins.dashboard')
                                    : route('tenants.dashboard')
                            "
                            class="flex flex-col text-center justify-center gap-2 px-2"
                            :class="{
                                'text-black': $page.component.includes(
                                    'Dashboard',
                                    0
                                ),
                            }"
                        >
                            <i class="fa-solid fa-chart-line"></i>
                            <p class="text-sm text-center">Dashboard</p></Link
                        >
                        <Link
                            v-if="$page.props.auth.user.is_admin === 1"
                            :href="route('houses.index')"
                            class="flex flex-col text-center justify-center gap-2 px-2"
                            :class="{
                                'text-black': $page.component.includes(
                                    'Houses',
                                    0
                                ),
                            }"
                        >
                            <i class="fa-solid fa-house"></i>
                            <p class="text-sm">Houses</p></Link
                        >
                        <Link
                            :href="
                                route('profile', {
                                    user: $page.props.auth.user.id,
                                })
                            "
                            class="flex flex-col text-center justify-center gap-2 px-2"
                            :class="{
                                'text-black': $page.component.includes(
                                    'Profile',
                                    0
                                ),
                            }"
                        >
                            <i class="fa-solid fa-user"></i>
                            <p class="text-sm">Profile</p></Link
                        >
                    </nav>
                    <hr class="border border-b-8" />
                </header>
            </div>
            <p
                v-if="$page.props.flash.message"
                class="bg-green-200 p-4 text-center"
            >
                {{ $page.props.flash.message }}
            </p>
            <slot />
            <div
                class="md:hidden fixed backdrop-blur-2xl pt-8 pb-12 bottom-0 w-full"
            >
                <header>
                    <nav
                        class="text-3xl text-slate-500 flex justify-evenly items-center"
                    >
                        <Link
                            :href="
                                $page.props.auth.user.is_admin
                                    ? route('admins.dashboard')
                                    : route('tenants.dashboard')
                            "
                            class="flex flex-col text-center justify-center gap-2 px-2"
                            :class="{
                                'text-black': $page.component.includes(
                                    'Dashboard',
                                    0
                                ),
                            }"
                        >
                            <i class="fa-solid fa-chart-line"></i>
                            <p class="text-sm text-center">Dashboard</p></Link
                        >
                        <Link
                            v-if="$page.props.auth.user.is_admin === 1"
                            :href="route('houses.index')"
                            class="flex flex-col text-center justify-center gap-2 px-2"
                            :class="{
                                'text-black': $page.component.includes(
                                    'Houses',
                                    0
                                ),
                            }"
                        >
                            <i class="fa-solid fa-house"></i>
                            <p class="text-sm">Houses</p></Link
                        >
                        <Link
                            :href="
                                route('profile', {
                                    user: $page.props.auth.user.id,
                                })
                            "
                            class="flex flex-col text-center justify-center gap-2 px-2"
                            :class="{
                                'text-black': $page.component.includes(
                                    'Profile',
                                    0
                                ),
                            }"
                        >
                            <i class="fa-solid fa-user"></i>
                            <p class="text-sm">Profile</p></Link
                        >
                    </nav>
                </header>
            </div>
            <!-- <div class="absolute bottom-0 bg-red-500 py-2 px-2">
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
            </div> -->
        </main>
    </div>
</template>

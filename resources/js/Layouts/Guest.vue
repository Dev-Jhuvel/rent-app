<script></script>

<template>
    <div class="bg-slate-500 py-1">
        <header class="flex items-center justify-between px-5 my-3">
            <div>
                <Link :href="route('login')">
                    <img
                        style="width: 10rem"
                        src="../../images/Rent at Pam.svg"
                        alt=""
                    />
                </Link>
            </div>
            <nav>
                <Link class="px-3 py-2 bg-blue-500 rounded-lg">Login</Link>
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
</template>

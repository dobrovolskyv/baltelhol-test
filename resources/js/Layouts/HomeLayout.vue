<template>
    <section class="bg-white w-full">
        <header class="p-4 flex justify-between bg-teal-200">
            <h1>HOME PAGE</h1>
            <div class="flex items-center gap-3 ">
<!--                <Link :href="route('')" class="hover:hover:text-cyan-600">Админ панель</Link>-->
                <Link class="hover:hover:text-cyan-600">Вход</Link>
            </div>
        </header>
    </section>
    <section class="w-full">
        <div class="flex items-start justify-center">
            <div class="w-3/4 bg-gray-50 p-4 h-full">
                <article>
                    <slot />
                </article>
            </div>
        </div>
    </section>
</template>

<script>
import { Link } from "@inertiajs/vue3";

export default {
    name: "HomeLayout",
    components: {
        Link
    }
}

</script>

<style scoped></style>

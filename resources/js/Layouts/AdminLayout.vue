<template>
    <section class="bg-white w-full">
        <header class="p-4 flex justify-between bg-teal-200">
            <h1>ADMIN PAGE</h1>
            <div class="flex items-center gap-3 ">
                <Link :href="route('home')" class="hover:hover:text-cyan-600">Главный экран</Link>
                <button @click="logout" class="hover:hover:text-cyan-600">Выход</button>
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

<script setup>
import {Link, router} from "@inertiajs/vue3";
import axios from "axios";




const logout = async () => {
    try {
        await axios.post('/logout');
        localStorage.removeItem('admin_token');
        delete axios.defaults.headers.common['Authorization'];
        router.visit(route('home')); //
    } catch (e) {
        console.error(e);
    }
};


</script>

<style scoped></style>
